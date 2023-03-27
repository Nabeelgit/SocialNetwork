<?php 
if(isset($_POST['email'])){
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred';
        exit();
    }
    $table = $conn->selectCollection('TheSocialNetwork', 'users');
    $match = $table->findOne(['email'=>$_POST['email']]);
    echo $match !== null;
}
?>