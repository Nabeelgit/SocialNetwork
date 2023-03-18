<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    function notLoggedIn(){
        header('Location: ./register');
    }
    $email = $_POST['email'] ?? $_COOKIE['email'] ?? notLoggedIn();
    ?>
    <title>The Social Network</title>
</head>
<body>
    
</body>
</html>