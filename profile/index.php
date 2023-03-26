<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/profile.css">
    <style>
        body {
            overflow-y: scroll;
        }
        .fill-available {
            width: -webkit-fill-available;
            width: -moz-fill-available;
        }
        .container {
            display: block;
            padding: 0.5rem;
        }
        header {
            width: initial;
        }
        .logo {
            max-width: 202px;
            height: 4rem;
            border-radius: 0.5rem 0 0 0.2rem;
        }
        .below {
            display: flex;
            justify-content: initial;
        }
        .forms {
            margin-top: 0.5rem;
        }
        .welcome {
            margin-left: 27px;
        }
        .welcome_header {
            display: flex;
            justify-content: space-between;
        }
        #search-inp {
            border: 1px solid gray;
            border-radius: 0;
            outline: 0;
        }
    </style>
    <?php
        include '../vendor/autoload.php';
        $conn = new MongoDB\Client('mongodb://localhost:27017');
        $table = $conn->selectCollection('TheSocialNetwork', 'users');
        $does_not_exist = false;
        $email = $user = $name = '';
        if(isset($_GET['email'])){
            $email = $_GET['email'];
            $user = $table->findOne(['email'=>$email]);
            $does_not_exist = $user === null;
            if(!$does_not_exist) {
                $name = ucfirst($user['name']);
            } else {
                $name = 'Does not exist';
            }
        } else {
            $does_not_exist = true;
        }
        $does_exist = !$does_not_exist;
        session_start();
        $my_email = $_SESSION['email'] ?? $_COOKIE['email'] ?? null;
        $is_my_acc = $my_email === $email;
    ?>
    <title><?php echo $name?> - The Social Network</title>
</head>
<body>
    <div class="container fill-available">
        <header>
            <img class="logo fill-available" src="../resources/logo.png">
            <div class="top fill-available">
                <h2>The Social Network</h2>
                <div class="links">
                    <a>home</a>
                    <a href="../search">search</a>
                    <a>browse</a>
                    <a>invite</a>
                    <a>help</a>
                    <a>logout</a>
                </div>
            </div>
        </header>
        <div class="below fill-available">
                <div class="forms">
                    <input type="search" placeholder="Search" id="search-inp">
                    <div class="my_links" style="margin-top: 1rem">
                        <div class="action_div">
                            <a><span>My Profile</span>
                                <?php 
                                if($is_my_acc){
                                    ?>
                                    <span id="editable">edit</span>
                                    <?php
                                }?>
                            </a>
                        </div>
                        <div class="action_div">
                            <a>My Friends</a>
                        </div>
                        <div class="action_div">
                            <a>My Photos</a>
                        </div>
                        <div class="action_div">
                            <a>My Notes</a>
                        </div>
                        <div class="action_div">
                            <a>My Groups</a>
                        </div>
                        <div class="action_div">
                            <a>My Events</a>
                        </div>
                        <div class="action_div">
                            <a>My Messages</a>
                        </div>
                        <div class="action_div">
                            <a>My Account</a>
                        </div>
                        <div class="action_div">
                            <a>My Privacy</a>
                        </div>
                    </div>
                </div>
                <div class="other fill-available">
                    <?php
                    include './profile.php';
                    if($does_not_exist){
                        createProfile(['name' => 'User does not exist', 'email' => 'None', 'status' => 'This profile might have been deleted', 'location'=>'Somewhere', 'rls'=>'Hmmm...', 'birthday'=>'Someday', 'hometown'=>'Maybe here or maybe there', 'activites' => 'Not existing', 'interests'=>'Being nonexistent', 'books' => 'How to be nonexistent', 'quotes'=>'if you\'re nonexistent... stay nonexistent', 'about'=>'A person that does not exist', 'education'=>'Nonexistent high', 'company' => 'unspecified']);
                    } else {
                        createProfile($user);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>