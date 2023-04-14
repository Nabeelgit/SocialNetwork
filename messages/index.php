<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - The Social Network</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/messages.css"> 
    <style>
        .fill-available {
            width: -webkit-fill-available;
            width: -moz-fill-available;
        }
        .fill-available-height {
            height: -webkit-fill-available;
            height: -moz-fill-available;
        }
        .my_links .action_div {
            max-width: 13rem;
            padding-left: 0.2rem;
        }
        .welcome {
            margin-left: 34px;
        }
        .about {
            padding: 0;
            height: 41rem;
        }
        .activity_circle {
            background-color: #20bf20;
        }
    </style>
</head> 
<body>
    <?php
    session_start();
    $email = $_SESSION['email'] ?? $_COOKIE['email'] ?? null;
    if($email === null){
        header('Location: ../login');
    }
    include '../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo '<h3 style="font-weight: normal">Couldn\'t connect to database...</h3>';
        exit();
    }
    $db = $conn->selectDatabase('TheSocialNetwork');
    $messages_table = $db->selectCollection('messages');
    $users_table = $db->selectCollection('users');
    $match = $users_table->findOne(['email' => $email], ['projection'=>['name'=>1]]);
    if($match === null){
        header('Location: ../login');
    }
    $my_name = $match['name'];
    ?>
    <input type="hidden" id="my_email" value="<?php echo $email ?>">
    <input type="hidden" id="my_name" value="<?php echo $my_name ?>">
    <div class="container fill-available" style="display: block;">
        <header style="width: initial">
            <img class="logo fill-available" src="../resources/logo.png" style="max-width: 16rem">
            <div class="top fill-available">
                <h2>The Social Network</h2>
                <div class="links">
                    <a href="../">home</a>
                    <a href="./">search</a>
                    <a href="../help/invite.php">invite</a>
                    <a href="../help/help.php">help</a>
                    <a href="../login/">logout</a>
                </div>
            </div>
        </header>
        <div class="below fill-available" style="margin: 0">
            <div class="forms fill-available" style="max-width: 16rem">
                <div class="my_links" style="margin-top: 1rem">
                    <div class="action_div">
                        <a href="../profile/?email=<?php echo urlencode($email)?>">My Profile</a>
                    </div>
                    <div class="action_div">
                        <a href="../friends/">My Friends</a>
                    </div>
                    <div class="action_div">
                        <a href="../notes/">My Notes</a>
                    </div>
                    <div class="action_div">
                        <a href="./">My Messages</a>
                    </div>
                    <div class="action_div">
                        <a href="../help/privacy.php">My Privacy</a>
                    </div>
                </div>
            </div>
            <div class="other fill-available">
                <div class="welcome fill-available" style="margin-left: 0">
                    <div class="welcome_header fill-available">
                        My Messages
                    </div>
                </div>
                <div class="about">
                    <div class="messages_container fill-available-height">
                        <div class="people fill-available-height">
                            <?php
                                $messengers_table = $db->selectCollection('messengers');
                                $filter = ['$or' => [
                                    ['sender' => $email],
                                    ['recipient' => $email]
                                ]];
                                $values = $messengers_table->find($filter);
                                foreach($values as $person){
                                    $person_email = '';
                                    $person_name = '';
                                    if($person['sender'] === $email){
                                        $person_email = $person['recipient'];
                                        $person_name = $person['recipient_name'];                                        
                                    } else if($person['recipient'] === $email){
                                        $person_email = $person['sender'];
                                        $person_name = $person['sender_name'];
                                    }
                                    ?>
                                    <div class="person">
                                        <img src="../resources/default.png" class="person_pic">
                                        <div class="person_info">
                                            <span class="blue-text person_name"><?php echo ucfirst($person_name)?></span>
                                            <span class="person_email"><?php echo $person_email?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                $newMessage = [];
                                if(isset($_GET['newMessage']) && isset($_GET['name']) && isset($_GET['status'])){
                                    $newMessage = ['email' => $_GET['newMessage'], 'name' => $_GET['name'], 'status' => $_GET['status']];
                                }
                            ?>

                        </div>  
                        <div class="message_box fill-available <?php if ($newMessage === []) echo 'invisible'?>">
                            <div class="message_header fill-available">
                                <img src="../resources/default.png" class="person_pic">
                                <div style="margin-top: 0.5rem" id="header_info">
                                    <?php
                                        if($newMessage !== []){
                                            $color = $newMessage['status'] === 'online' ? '#20bf20' : '#f31919'; 
                                            ?>
                                            <input type="hidden" id="recipient_email" value="<?php echo $newMessage['email']?>">
                                            <span class="blue-text person_name"><?php echo $newMessage['name']?></span>
                                            <span class="activity_circle" style="background-color: <?php echo $color?>"></span> 
                                            <?php
                                        } else {
                                            ?>
                                            <span class="blue-text person_name"></span>
                                            <span class="activity_circle"></span>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="messages fill-available-height">

                            </div>
                            <div class="message_form fill-available fill-available-height">
                                <form class="message_sender">
                                    <input type="text" class="message_input" placeholder="Write a message...">
                                    <button class="classic-btn" style="height: 1.7rem; width: 4rem">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../resources/status_updater.js"></script>
    <script src="./scripts/script.js"></script>
    <?php
    session_write_close();
    ?>
</body>
</html>