<?php
if(isset($_POST['email'])){
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'offline';
        exit();
    }
    $email = $_POST['email'];
    $table = $conn->selectCollection('TheSocialNetwork', 'users');
    $match = $table->findOne(['email'=>$email], ['projection'=>['activity_status'=>1]]);
    if($match !== null){
        echo $match['activity_status'];
    } else {
        echo 'offline';
    }
}
?>