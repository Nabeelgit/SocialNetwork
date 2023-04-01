<?php
if(isset($_POST['like'])){
    $count = $_POST['like'];
    $id  = $_POST['post_id'];
    $likers = $_POST['likers'];
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred';
        exit();
    }
    $table = $conn->selectCollection('TheSocialNetwork', 'posts');
    $table->updateOne(['post_id'=>$id], ['$set' => ['like_count' => intval($count) + 1, 'likers'=>$likers]]);
    echo 1;
}
?>