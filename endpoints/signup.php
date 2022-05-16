<?php

use Utility\Database;

require_once '../utility/Database.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$con = null;

$database = new Database();
$con = $database->getConnection();
try{
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
} 

$table = 'users';

$query = "INSERT INTO " . $table . " (username,email,password) VALUES(:username, :email, :password)";

$stmt = $con->prepare($query);

$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt->bindParam(':password', $password_hash);

if($stmt->execute()){

    http_response_code(200);
    echo json_encode(array("message" => "User was successfully registered."));
}
else{
    http_response_code(400);

    echo json_encode(array("message" => "Unable to register the user."));
}
}catch(PDOException $e){
    $error = "Error: " . $e->getMessage();
    echo '  alert("'.$error.'");';
}
