<?php
if(isset($_POST['email']) && isset($_POST['password'])){
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $table = $conn->selectCollection('TheSocialNetwork', 'users');
    $match = $table->findOne(['email'=> $_POST['email'], 'password'=>$_POST['password']]);
    if($match === null){
        echo 1;
    } else {
        session_start();
        $_SESSION['email'] = $_POST['email'];
        session_write_close();
    }
}
?>