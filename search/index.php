<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - The Social Network</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/search.css">
    <style>
        .fill-available {
            width: -webkit-fill-available;
            width: -moz-fill-available;
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
                <form class="search-form" method="get" action="./">
                    <input type="search" placeholder="Type a name or email" class="search-inp" name="q" required>
                    <button class="classic-btn">Search</button>
                </form>
                <?php
                if($is_logged_in){
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
                            <a href="../messages/">My Messages</a>
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
                        Search
                    </div>
                </div>
                <?php
                $search = null;
                $get_isset = isset($_GET['q']);
                $results = [];
                if($get_isset){
                    $search = trim($_GET['q']);
                    include '../vendor/autoload.php';
                    $conn = new MongoDB\Client('mongodb://localhost:27017');
                    try {
                        $dbs = $conn->listDatabases();
                    } catch(Exception $e){
                        echo '<h3 style="font-weight: normal">An error occurred</h3>';
                        exit();
                    }
                    $table = $conn->selectCollection('TheSocialNetwork', 'users');
                    $filter = ['$or' => [
                        ['email' => $search],
                        ['name' => ['$regex' => $search]]
                    ]];
                    $matches = $table->find($filter, ['projection' => ['name' => 1, 'email'=> 1, 'status'=> 1]]);
                    if(!$matches->isDead()) $results = $matches;
                }
                ?>
                <div class="about">
                    <?php
                    if(!$get_isset){
                        echo '<h3 style="font-weight: normal">Results will show up here when you click search</h3>';
                    } else if(empty($results)) {
                        echo '<h3>No results found</h3>';
                    } else {
                        // display
                        ?>
                        <div class="results">
                        <?php
                        foreach($results as $result){
                            ?>
                            <div class="result">
                                <img src="../resources/default.png" class="profile-picture">
                                <div class="info">
                                    <h3 class="name"><a href="../profile/?email=<?php echo urlencode($result['email'])?>"><?php echo htmlspecialchars($result['name'])?></a></h3>
                                    <h4 class="email"><?php echo htmlspecialchars($result['email'])?></h4>
                                    <h4 class="status" style="margin-bottom: 0"><?php echo htmlspecialchars($result['status'])?></h4>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>
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