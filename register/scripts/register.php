<?php
include '../../vendor/autoload.php';
$conn = new MongoDB\Client('mongodb://localhost:27017');
$table = $conn->selectCollection('TheSocialNetwork', 'users');
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $password = $_POST['password'];
    $table->insertOne(['name'=>$name, 'email'=>$email, 'status'=>$status, 'password'=>$password]);
    echo true;
}
?>