<?php
include '../../vendor/autoload.php';
$conn = new MongoDB\Client('mongodb://localhost:27017');
$table = $conn->selectCollection('TheSocialNetwork', 'notes');
try {
    $dbs = $conn->listDatabases();
} catch(Exception $e){
    echo 'An error occurred';
    exit();
}
if(isset($_POST['add'])){
    $text = $_POST['note'];
    $email = $_POST['email'];
    $table->insertOne(['text'=>$text, 'email'=>$email]);
} else if(isset($_POST['remove'])){
    $text = $_POST['note'];
    $email = $_POST['email'];
    $table->deleteOne(['text'=>$text, 'email'=>$email]);
}
echo 1;
?>