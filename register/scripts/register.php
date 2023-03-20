<?php
include '../../vendor/autoload.php';
$conn = new MongoDB\Client('mongodb://localhost:27017');
$table = $conn->selectCollection('TheSocialNetwork', 'users');
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $password = $_POST['password'];
    $table->insertOne([
    'name'=>$name, 
    'email'=>$email, 
    'status'=>$status, 
    'password'=>$password, 
    'photo'=>'', 
    'location' => 'Unspecified',
    'sex'=>'Unspecified',
    'rls' => 'Unspecified',//relationship status
    'birthday' => 'Unspecified',
    'hometown' => 'Unspecified',
    'activities' => 'Unspecified',
    'interests' => 'Unspecified',
    'books' => 'Unspecified',
    'quotes' => 'Unspecified',
    'about' => 'Unspecified',
    'education' => 'Unspecified',
    'company' => 'Unspecified',
    'period' => 'Unspecified',
    'work_desc' => 'Unspecified'
    ]);
    session_start();
    $_SESSION['email'] = $email;
    session_write_close();
    echo true;
}
?>