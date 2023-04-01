<?php
function getRandomString(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $random_string .= $characters[$index];
    }
    return $random_string;
}
if(isset($_POST['text'])){
    $text = $_POST['text'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $email  = $_POST['email'];
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred';
        exit();
    }
    $table = $conn->selectCollection('TheSocialNetwork', 'posts');
    do {
        $rand = getRandomString();
    } while($table->findOne(['post_id'=>$rand]) !== null);
    $table->insertOne(['text' => $text, 'date'=>$date, 'name'=>$name, 'email'=>$email, 'post_id' => $rand, 'like_count' => 0, 'likers'=>'']);
    echo 1;
}
?>