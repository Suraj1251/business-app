<?php
include("db.php");

// Set header for JSON
header("Content-Type: application/json");

// Get JSON data safely
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if(
    !isset($data['name']) || 
    !isset($data['email']) || 
    !isset($data['password'])
){
    echo json_encode(["status"=>"error", "message"=>"Invalid input"]);
    exit();
}

$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

// Check if email already exists
$check = $conn->query("SELECT * FROM users WHERE email='$email'");
if($check && $check->num_rows > 0){
    echo json_encode(["status"=>"error", "message"=>"Email already exists"]);
    exit();
}

// Insert user
$sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";

if($conn->query($sql)){
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"error", "message"=>$conn->error]);
}
?>
