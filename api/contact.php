<?php
include("db.php");

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if(
    !isset($data['name']) ||
    !isset($data['email']) ||
    !isset($data['message'])
){
    echo json_encode(["status"=>"error","message"=>"Invalid input"]);
    exit();
}

$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$message = $conn->real_escape_string($data['message']);

$sql = "INSERT INTO contacts (name,email,message) 
        VALUES ('$name','$email','$message')";


if($conn->query($sql)){
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"error","message"=>$conn->error]);
}
?>
