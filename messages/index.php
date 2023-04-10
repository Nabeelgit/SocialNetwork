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
    </style>
</head> 
<body>
    <?php
    session_start();
    $email = $_SESSION['email'] ?? $_COOKIE['email'] ?? null;
    $is_logged_in = $email !== null;
    ?>
    <div class="container fill-available" style="display: block;">
        <header style="width: initial">
            <img class="logo fill-available" src="../resources/logo.png" style="max-width: 16rem">
            <div class="top fill-available">
                <h2>The Social Network</h2>
                <div class="links">
                    <a href="../">home</a>
                    <a href="./">search</a>
                    <a>invite</a>
                    <a>help</a>
                    <?php
                    if($is_logged_in){
                        ?>
                        <a href="../login/">logout</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </header>
        <div class="below fill-available" style="margin: 0">
            <div class="forms fill-available" style="max-width: 16rem">
                <?php
                if($email !== null){
                    ?>
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
                            <a>My Privacy</a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="other fill-available">
                <div class="welcome fill-available" style="margin-left: 0">
                    <div class="welcome_header fill-available">
                        My Messages
                    </div>
                </div>
                <?php
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
                $user_table = $db->selectCollection('users');
                function getStatus($email){
                    global $user_table;
                    $match = $user_table->findOne(['email'=>$email], ['projection'=>['activity_status'=>1]]);
                    if($match !== null){
                        return $match['activity_status'];
                    }   
                    return 'offline';
                }
                ?>
                <div class="about">
                    <div class="messages_container fill-available-height">
                        <div class="people fill-available-height">
                            <div class="person">
                                <img src="../resources/default.png" class="person_pic">
                                <div class="person_info">
                                    <span class="blue-text person_name">Nabeel Ahmed</span>
                                    <span>nabeel30march@gmail.com</span>
                                </div>
                            </div>
                        </div>  
                        <div class="message_box fill-available">
                            <div class="message_header fill-available">
                                <img src="../resources/default.png" class="person_pic">
                                <div style="margin-top: 0.5rem">
                                    <span class="blue-text person_name">Nabeel Ahmed <span class="activity_circle" style="<?php echo true ? '#20bf20' : '#f31919'?>"></span></span>
                                </div>
                            </div>
                            <div class="messages fill-available-height">
                                <div class="message other_message">
                                    <span><span class="blue-text person_name">Nabeel Ahmed</span> <span class="message_time">at 12:34 March 24th</span></span>
                                    <span class="message_text">Hey</span>
                                </div>
                                <div class="message my_message">
                                    <span><span class="blue-text person_name">You</span> <span class="message_time">at 12:35 March 24th</span></span>                                    
                                    <span class="message_text">Hello</span>
                                </div>
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
    <?php
    session_write_close();
    ?>
</body>
</html>