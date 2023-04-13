<?php
if(isset($_POST['email']) && isset($_POST['recipient'])){
    $me = $_POST['email'];
    $recipient = $_POST['recipient'];
    include '../../vendor/autoload.php';
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    try {
        $dbs = $conn->listDatabases();
    } catch(Exception $e){
        echo 'An error occurred.';
        exit();
    }
    $table = $conn->selectCollection('TheSocialNetwork', 'messages');
    $match = $table->find(['$or' => [
        ['sender' => $me, 'recipient'=>$recipient],
        ['recipient' => $me, 'sender' => $recipient]
    ]]);
    foreach($match as $message){
        $sender = $message['sender'] === $me ? 'You' : $message['sender_name'];
        $time = $message['time'];
        $text = $message['text'];
        ?>
            <div class="message <?php if($sender === 'You') echo 'my_message'?>">
                <span><span class="blue-text person_name"><?php echo ucfirst($sender)?></span> <span class="message_time">at <?php echo $time?></span></span>
                <span class="message_text"><?php echo htmlspecialchars($text)?></span>
            </div>
        <?php
    }
}
?>