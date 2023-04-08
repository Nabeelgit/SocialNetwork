<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - The Social Network</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/notes.css">
    <style>
        .fill-available {
            width: -webkit-fill-available;
            width: -moz-fill-available;
        }
        .forms {
            margin-top: 0.72rem;
        }
        .my_links .action_div {
            max-width: 13rem;
            padding-left: 0.2rem;
        }
        .welcome {
            margin-left: 34px;
        }
    </style>
</head> 
<body>
    <?php
    session_start();
    $email = $_SESSION['email'] ?? $_COOKIE['email'] ?? null;
    ?>
    <input type="hidden" value="<?php echo $email?>" id="email">
    <div class="container fill-available" style="display: block;">
        <header style="width: initial">
            <img class="logo fill-available" src="../resources/logo.png" style="max-width: 16rem">
            <div class="top fill-available">
                <h2>The Social Network</h2>
                <div class="links">
                    <a href="../">home</a>
                    <a href="./">search</a>
                    <a>browse</a>
                    <a>invite</a>
                    <a>help</a>
                    <a>logout</a>
                </div>
            </div>
        </header>
        <div class="below fill-available" style="margin: 0">
            <div class="forms fill-available" style="max-width: 16rem">
                <?php
                if($email !== null){
                    ?>
                    <div class="my_links">
                        <div class="action_div">
                            <a href="../profile/?email=<?php echo urlencode($email)?>">My Profile</a>
                        </div>
                        <div class="action_div">
                            <a>My Friends</a>
                        </div>
                        <div class="action_div">
                            <a href="./">My Notes</a>
                        </div>
                        <div class="action_div">
                            <a>My Messages</a>
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
                        My Notes
                    </div>
                </div>
                <div class="about center" style="flex-direction: column">
                    <div class="notes_form fill-available center">
                        <form class="note_writer">
                            <input type="text" placeholder="Write a note..." id="note_input" autocomplete="off">
                            <button class="classic-btn note-submit">Submit</button>
                        </form>
                    </div>
                    <div class="notes fill-available">
                        <?php
                        include '../vendor/autoload.php';
                        $conn = new MongoDB\Client('mongodb://localhost:27017');
                        $table = $conn->selectCollection('TheSocialNetwork', 'notes');
                        $matches = $table->find(['email' => $email]);
                        foreach($matches as $note){
                            ?>  
                            <div class="note">
                                <?php echo $note['text']?>
                            </div>
                            <?php
                        }
                        ?>
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