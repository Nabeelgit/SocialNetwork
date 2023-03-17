<?php 
if(isset($_POST['name']) && isset($_POST['email'])){
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $table = $conn->selectCollection('TheSocialNetwork', 'users');
    $match = $table->findOne(['name'=>$_POST['name'], 'email'=>$_POST['email']]);
    return $match !== null;
}
?>