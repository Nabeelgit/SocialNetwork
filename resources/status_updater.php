<?php
if(isset($_POST['update'])){
    include '../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred';
        exit();
    }
    $table = $conn->selectCollection('TheSocialNetwork', 'users');
    session_start();
    if(isset($_SESSION['email'])){
        $table->updateOne(['email'=>$_SESSION['email']], ['$set' => ['activity_status'=>$_POST['update']]]);
    }
    session_write_close();
}
?>