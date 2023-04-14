<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - The Social Network</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
    <?php
    include '../resources/status_updater.php';
    updateStatus('offline');
    session_start();
    session_unset();
    session_write_close();
    ?>
    <div class="container">
        <header>
            <img class="logo" src="../resources/logo.png">
            <div class="top">
                <h2>The Social Network</h2>
                <div class="links">
                    <a href="./">login</a>
                    <a href="../register">register</a>
                    <a href="../help/help.php">help</a>
                </div>
            </div>
        </header>
        <div class="below">
            <div class="forms">
                <form method="post" action="../" class="inputs">
                    <label for="email">Email:</label>
                    <input class="email" name="email">
                    <label for="password">Password:</label>
                    <input class="password" name="password" type="password">
                    <p class="warning" style="font-size: 14px"></p>
                    <div style="display: flex; margin-top: 0.3rem">
                        <button class="classic-btn" style="width: 3rem">Login</button>
                    </div>
                </form>
            </div>
            <div class="other">
                <div class="welcome">
                    <div class="welcome_header">
                        Welcome to the social network!
                    </div>
                    <div class="about">
                        <p style="font-weight: bold;">The Social Network is an online directory that connects people through social networks.</p>
                        <p>The site is open to a lot of places, but not everywhere yet. We're working on it.</p>
                        <p>You can use The Social Network to: </p>
                        <ul>
                            <li>Look up people around you.</li>
                            <li>See how people know each other.</li>
                            <li>Make groups and events with your friends.</li>
                        </ul>
                    </div>
                </div>
                <footer>
                    <div class="footer-links">
                        <a href="../help/about.php">about</a>
                        <a href="../help/jobs.php">jobs</a>
                        <a href="../help/advertise.php">advertise</a>
                        <a href="../help/press.php">press</a>
                        <a href="../help/terms.php">terms</a>
                        <a href="../help/privacy.php">privacy</a>
                        <a href="../help/developers.php">developers</a>
                    </div>
                    <p>a (you know who) production</p>
                    <p>The Social Network &copy; <?php echo date('Y')?></p>
                </footer>
            </div>
        </div>
    </div>
    <script src="./scripts/login.js"></script>
</body>
</html>