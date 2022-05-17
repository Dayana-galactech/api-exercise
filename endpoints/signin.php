<?php

include '../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Utility\Database;

require_once '../utility/Database.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();
$table = 'users';

if(isset($_POST['email']) && isset($_POST['password'])){
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
}


$query = "SELECT * FROM " . $table . " WHERE email = ?";
$stmt = $db->prepare( $query );
$stmt->bindParam(1, $email);
$stmt->execute();
$num = $stmt->rowCount();

if($num > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $password2 = $row['password'];

    if(password_verify($password, $password2))
    {
        $secret_key = "secretKey";
        $issuer_claim = "localhost";
        $audience_claim = "localhost";
        $issuedat_claim = time() + 1000;
        $notbefore_claim = $issuedat_claim + 10;
        $expire_claim = $issuedat_claim + 60; 
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "email" => $email
        ));

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key,'HS256');
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $email,
                "expireAt" => $expire_claim
            ));
    }
    else{

        http_response_code(401);
        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
}
else {
    http_response_code(401);
        echo json_encode(array("message" => "Login failed."));
}
?>


