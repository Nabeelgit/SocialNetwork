<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - The Social Network</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <style>
        div.form-grid {
            display: grid;
            grid-template-columns: auto auto;
            justify-content: space-around;
            justify-items: start;
            grid-row-gap: 0.3rem;
        }
        form label {
            color: gray;
            font-weight: bold;
        }
        #register-form .warning {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
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
                    <a href="../login/">login</a>
                    <a href="./">register</a>
                    <a href="../help/help.php">help</a>
                </div>
            </div>
        </header>
        <div class="below">
            <div class="forms">
                <form method="post" action="../" class="inputs">
                    <label for="email">Email:</label>
                    <input name="email" class="email">
                    <label for="password">Password:</label>
                    <input name="password" type="password" class="password">
                    <p class="warning" style="font-size: 14px"></p>
                    <div style="display: flex; margin-top: 0.3rem">
                        <button class="classic-btn" style="width: 3rem">Login</button>
                    </div>
                </form>
            </div>
            <div class="other">
                <div class="welcome">
                    <div class="welcome_header">
                        Registration
                    </div>
                    <div class="about">
                        <p>To register for the Social Network, just fill in the fields below. You will have a chance to enter additional information and submit a picture once you have registered.</p>
                        <form method="post" action="../" id="register-form">
                            <div class="form-grid">
                                <label>Name: </label>
                                <input name="name" id="name">
                                <label>Status:</label>
                                <select id="status">
                                    <option value="High school or below">High school or below</option>
                                    <option value="Undergrad">Undergrad</option>
                                    <option value="Graduate">Graduated</option>
                                    <option value="No degree">No degree</option>
                                </select>
                                <label>Email:</label>
                                <input name="email" id="email">
                            <p>You can choose any password. It should not be your school password.</p>
                            <span></span>
                                <label>Password:</label>
                                <input name="password" type="password" id="password">
                                <label>Retype Password:</label>
                                <input name="repassword" type="password" id="repassword">
                                <div style="display: flex">
                                    <input type="checkbox" style="margin: 0 0.5rem 0 0" id="termsCheck"> <span>I have read and understood the <a>Terms of use</a>, and I agreed to them</span>
                                </div>
                            </div>
                            <p class="warning"></p>
                            <div class="btns" style="margin-top: 1rem">
                                <button class="classic-btn" style="width: 5.3rem" class="register" id="register-btn">Register now!</button> 
                            </div>
                        </form>
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
    <script src="./scripts/register.js"></script>
    <script src="../login/scripts/login.js"></script>
</body>
</html>