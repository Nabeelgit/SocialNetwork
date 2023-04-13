<?php
/*
Sender
Reciever
Sender_name
Reciever_name
text
time
*/
if(isset($_POST['message'])){
    $my_email = $_POST['my_email'];
    $recipient = $_POST['recipient'];
    $my_name = $_POST['my_name'];
    $recipient_name = $_POST['recipient_name'];
    $time = $_POST['time'];
    $text = $_POST['message'];
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred';
        exit();
    }
    $db = $conn->selectDatabase('TheSocialNetwork');
    $messages_table = $db->selectCollection('messages');
    $messengers_table = $db->selectCollection('messengers');
    $match = $messengers_table->findOne(['$or' => [
        ['sender' => $my_email, 'recipient'=>$recipient],
        ['recipient' => $my_email, 'sender' => $recipient]
    ]]);
    if($match !== null) {
        $messengers_table->deleteOne(['$or' => [
            ['sender' => $my_email, 'recipient' => $recipient],
            ['recipient' => $my_email, 'sender' => $recipient]
        ]]);
    }
    $messengers_table->insertOne(['sender' => $my_email, 'recipient' => $recipient, 'sender_name' => $my_name, 'recipient_name' => $recipient_name]);
    $messages_table->insertOne(['sender' => $my_email, 'sender_name' => $my_name, 'recipient_name' => $recipient_name, 'recipient' => $recipient, 'time' => $time, 'text' => $text]);
    echo 1;
}
?>