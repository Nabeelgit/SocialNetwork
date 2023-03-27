<?php
if(isset($_POST['email'])){
    $email = $_POST['email'];
    // remove email from array
    array_shift($_POST);
    // store in db
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred';
        exit();
    }
    $table = $conn->selectCollection('TheSocialNetwork', 'users');
    $table->updateOne(['email'=>$email], ['$set' => $_POST]);
    echo 1;
}
?>