<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - The Social Network</title>
    <link rel="stylesheet" type="text/css" href="../styles/register.css">
</head>
<body>
    <div class="container">
        <header>
            <img class="logo" src="../resources/mountain.jpg">
            <div class="top">
                <h2>The Social Network</h2>
                <div class="links">
                    <a href="../login/">login</a>
                    <a href="./">register</a>
                    <a>help</a>
                </div>
            </div>
        </header>
        <div class="below">
            <div class="forms">
                <form method="post" action="../index.php" class="inputs">
                    <label for="email">Email:</label>
                    <input id="email" name="email" autocomplete="off">
                    <label for="password">Password:</label>
                    <input id="password" name="password" autocomplete="off">
                    <div style="display: flex; margin-top: 0.3rem">
                        <button class="classic-btn" style="width: 3rem">Login</button>
                        <button class="classic-btn" style="width: 3.5rem">Register</button> 
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
                        <div class="btns">
                            <button class="classic-btn" style="width: 3rem; margin-right: 0.4rem">Login</button>
                            <button class="classic-btn" style="width: 3.5rem">Register</button> 
                        </div>
                    </div>
                </div>
                <footer>
                    <div class="footer-links">
                        <a>about</a>
                        <a>jobs</a>
                        <a>advertise</a>
                        <a>press</a>
                        <a>terms</a>
                        <a>privacy</a>
                        <a>developers</a>
                    </div>
                    <p>a (you know who) Production</p>
                    <p>The Social Network &copy; 2023</p>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>