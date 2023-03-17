<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - The Social Network</title>
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
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
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img class="logo" src="../resources/logo.png">
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
                        <button class="classic-btn" style="width: 3.5rem" class="register">Register</button>
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
                        <form method="post" action="../index.php">
                            <div class="form-grid">
                                <label>Name: </label>
                                <input name="name">
                                <label>Status:</label>
                                <select>
                                    <option value="young">High school or below</option>
                                    <option value="undergrad">Undergrad</option>
                                    <option value="graduate">Graduated</option>
                                    <option value="nodegree">No degree</option>
                                </select>
                                <label>Email:</label>
                                <input name="email">
                            <p>You can choose any password. It should not be your school password.</p>
                            <span></span>
                                <label>Password:</label>
                                <input name="password" autocomplete="off">
                                <label>Retype Password:</label>
                                <input name="repassword" autocomplete="off">
                                <div style="display: flex">
                                    <input type="checkbox" style="margin: 0 0.5rem 0 0"> <span>I have read and understood the <a>Terms of use</a>, and I agreed to them</span>
                                </div>
                            </div>
                            <div class="btns" style="margin-top: 1rem">
                                <button class="classic-btn" style="width: 5.3rem" class="register">Register now!</button> 
                            </div>
                        </form>
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
                    <p>a (you know who) production</p>
                    <p>The Social Network &copy; 2023</p>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>