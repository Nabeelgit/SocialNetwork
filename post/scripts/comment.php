<?php
if(isset($_POST['comment'])){
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred';
        exit();
    }
    $table = $conn->selectCollection('TheSocialNetwork', 'comments');
    $table->insertOne(['text'=>$_POST['comment'], 'post_id'=>$_POST['post_id'], 'date'=>$_POST['date'], 'name'=>$_POST['name'], 'email' => $_POST['email']]);
    echo 1;
}
?>