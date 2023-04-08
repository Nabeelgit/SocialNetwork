<?php
include '../../vendor/autoload.php';
$conn = new MongoDB\Client('mongodb://localhost:27017');
try {
    $dbs = $conn->listDatabases();
} catch(Exception $e){
    echo 'An error occurred';
    exit();
}
$db = $conn->selectDatabase('TheSocialNetwork');
$table = $db->selectCollection('friends');
if(isset($_POST['add'])){
    $my_email = $_POST['email'];
    $friend_email = $_POST['friend_email'];
    $friend_name = $_POST['friend_name'];
    $table->insertOne(['friender'=>$my_email, 'friend_name'=>$friend_name, 'friend_email'=>$friend_email]);
    echo 1;
} else if(isset($_POST['remove'])){
    $my_email = $_POST['email'];
    $friend_email = $_POST['friend_email'];
    $table->deleteOne(['friender'=>$my_email, 'friend_email'=>$friend_email]);
    echo 1;
}
?>