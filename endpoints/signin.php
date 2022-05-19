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

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
}


$query = "SELECT * FROM " . $table . " WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $email);
$stmt->execute();
$num = $stmt->rowCount();

$query2 = "SELECT username FROM users WHERE email=?";
$stmt2 = $db->prepare($query2);
$stmt2->bindParam(1, $email);
$stmt2->execute();
$row = $stmt2->fetchAll();
foreach ($row as $name) {
    $username = htmlspecialchars($name->username);
}

if ($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $password2 = $row['password'];

    if (password_verify($password, $password2)) {
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
                "email" => $email,
                "password" => $password2,
                "username" => $username
            )
        );

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key, 'HS256');
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $email,
                "expireAt" => $expire_claim
            )
        );
        $q = "SELECT id FROM users WHERE email = ?";
        $stmt3 = $db->prepare($q);
        $stmt3->bindParam(1, $email);
        $stmt3->execute();
        $row2 = $stmt3->fetchAll();
        foreach ($row2 as $userid) {
            $id = htmlspecialchars($userid->id);
        }
        $tokens = 'tokens';
        $data = "INSERT INTO " . $tokens . " (id,token) VALUES(:id, :jwt )";
        $stmt2 = $db->prepare($data);
        $stmt2->bindParam(':id', $id);
        $stmt2->bindParam(':jwt', $jwt);
        if ($stmt2->execute()) {
            echo json_encode(array("message" => "token was successfully registered."));
        } else {
            echo json_encode(array("message" => "Unable to register the token."));
        }
    } else {

        http_response_code(401);
        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
} else {
    http_response_code(401);
    echo json_encode(array("message" => "Login failed."));
}
