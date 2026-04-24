<?php
session_start();
include("db.php");

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if(!isset($data['email']) || !isset($data['password'])){
    echo json_encode(["status"=>"error","message"=>"Invalid input"]);
    exit();
}

$email = $conn->real_escape_string($data['email']);
$password = $data['password'];

// Check user
$result = $conn->query("SELECT * FROM users WHERE email='$email'");

if($result && $result->num_rows > 0){
    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){
        $_SESSION['user'] = $user['name'];

        echo json_encode([
            "status"=>"success",
            "name"=>$user['name']
        ]);
    } else {
        echo json_encode(["status"=>"error","message"=>"Wrong password"]);
    }
} else {
    echo json_encode(["status"=>"error","message"=>"User not found"]);
}
?>
