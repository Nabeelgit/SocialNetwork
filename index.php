<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    function notLoggedIn(){
        header('Location: ./register');
        exit();
    }
    session_start();
    $email = $_POST['email'] ?? $_COOKIE['email'] ?? $_SESSION['email'] ?? notLoggedIn();
    // set just in case
    $_SESSION['email'] = $email;
    ?>
    <title>The Social Network</title>
</head>
<link rel="stylesheet" type="text/css" href="./styles/style.css">
<link rel="stylesheet" type="text/css" href="./styles/home.css">
<style>
        body {
            overflow-y: scroll;
        }
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
        .name a{
            text-transform: capitalize;
            font-size: 33px;
            margin-bottom: 1rem;
            color: #2f5ab2;
        }
    </style>
<body>
<?php
    include './vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo '<h3 style="font-weight: normal">An error occurred</h3>';
        exit();
    }
    $database = $conn->selectDatabase('TheSocialNetwork');
    $table = $database->selectCollection('users');
    $user = $table->findOne(['email' => $email], ['projection' => ['name' => 1]]);
    if($user === null){
        notLoggedIn();
    }
    $name = $user['name'];
?>
<div class="container fill-available" style="display: block;">
        <header style="width: initial">
            <img class="logo fill-available" src="./resources/logo.png" style="max-width: 16rem">
            <div class="top fill-available">
                <h2>The Social Network</h2>
                <div class="links">
                    <a href="./">home</a>
                    <a href="./search">search</a>
                    <a>invite</a>
                    <a>help</a>
                    <a href="./login/">logout</a>
                </div>
            </div>
        </header>
        <div class="below fill-available" style="margin: 0">
            <div class="forms fill-available" style="max-width: 16rem">
                <div class="me_display">
                    <img src="./resources/default.png" width="70" height="50">
                    <div class="named">
                        <span class="top_name blue-text"><?php echo str_replace(' ', '<br>', $name)?></span>
                    </div>
                </div>
                <div class="my_links" style="margin-top: 0.7rem">
                    <div class="action_div">
                        <a href="./profile/?email=<?php echo urlencode($email)?>">My Profile</a>
                    </div>
                    <div class="action_div">
                        <a href="./friends">My Friends</a>
                    </div>
                    <div class="action_div">
                        <a href="./notes">My Notes</a>
                    </div>
                    <div class="action_div">
                        <a href="./messages">My Messages</a>
                    </div>
                    <div class="action_div">
                        <a>My Privacy</a>
                    </div>
                </div>
            </div>
            <div class="other fill-available">
                <form class="post_form fill-available">
                    <textarea placeholder="What do you want to post?" class="post_input" rows="5" cols="70" maxlength="650"></textarea>
                    <input type="hidden" id="post_information_email" value="<?php echo $email?>">
                    <input type="hidden" id="post_information_name" value="<?php echo $name?>">
                    <button class="classic-btn post_btn">Post</button>
                </form>
                <div class="posts fill-available">
                    <?php
                    $posts_table = $database->selectCollection('posts');
                    $all = $posts_table->find([], ['limit'=>70]);
                    if($all->isDead()){
                        echo 'No posts';
                    } else {
                        $comments_table = $database->selectCollection('comments');
                        foreach($all as $post){
                            ?>
                            <div class="post" id="<?php echo $post['post_id']?>">
                                <div class="post_top">
                                    <img src="./resources/default.png" width="70" height="50" class="post_profile_pic">
                                    <div class="post_main">
                                        <span class="post_name blue-text"><a class="no_link" href="./profile/?email=<?php echo urlencode($post['email'])?>"><?php echo $post['name']?></a></span>
                                        <span><?php echo htmlspecialchars($post['text'])?></span>
                                        <div class="post_interaction">
                                            <?php
                                            $likers = explode(',', $post['likers']);
                                            ?>
                                            <span id="like_btn" class="light-blue-text interaction-btn" value="<?php echo $post['likers']?>"><span class="like_status"><?php echo in_array($email, $likers) ? 'Liked' : 'Like' ?></span> (<span class="like_count" id="<?php echo $post['post_id']?>"><?php echo $post['like_count']?></span>)</span>
                                            <span class="html_dot">&bull;</span>
                                            <span id="comment_btn" class="light-blue-text interaction-btn" value="<?php echo $post['post_id']?>">Comment</span>
                                            <span class="html_dot">&bull;</span>
                                            <span style="color: gray">at <?php echo $post['date']?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment_section">
                                    <div class="comment_writer invisible">
                                        <form class="comment_form">
                                            <input type="text" class="comment_text fill-available" placeholder="Write a comment..." maxlength="300">
                                            <button class="classic-btn commenter">Comment</button>
                                        </form>
                                    </div>
                                    <div class="comments">
                                        <?php
                                            $my_comms = $comments_table->find(['post_id'=>$post['post_id'], 'email'=>$email]);
                                            $all_comms = [];
                                            foreach($my_comms as $comment){
                                                $all_comms[] = $comment;
                                            }
                                            $other_comms = $comments_table->find(['post_id'=>$post['post_id'], 'email' => ['$ne' => $email]]);
                                            foreach($other_comms as $comment){
                                                $all_comms[] = $comment;
                                            }
                                            foreach($all_comms as $comment){
                                                ?>
                                                <div class="comment">
                                                    <img src="./resources/default.png" width="70" height="50" class="post_profile_pic">
                                                    <div class="comment_main">
                                                        <span class="comment_name blue-text"><a class="no_link" href="./profile/?email=<?php echo urlencode($comment['email'])?>"><?php echo $comment['name']?></a></span>
                                                        <span><?php echo htmlspecialchars($comment['text'])?></span>
                                                        <span class="comment_date">at <?php echo $comment['date']?></span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="./resources/status_updater.js"></script>
    <script src="./post/scripts/post.js"></script>
    <?php
    session_write_close();
    ?>
</body>
</html>