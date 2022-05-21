<?php

include '../vendor/autoload.php';

// use \Firebase\JWT\JWT;
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
$secret = 'secretKey';
$csrf = hash_hmac('SHA256','a string', $secret);

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['csrf'])) {
    
    if(hash_equals($csrf , $_POST['csrf'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);


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


            function generate_jwt($headers, $payload, $secret)
            {
                $headers_encoded = base64url_encode(json_encode($headers));

                $payload_encoded = base64url_encode(json_encode($payload));

                $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
                $signature_encoded = base64url_encode($signature);

                $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";

                return $jwt;
            }

            function base64url_encode($str)
            {
                return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
            }

            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            $issuer_claim = "localhost";
            $audience_claim = "localhost";
            $issuedat_claim = time() + 1000;
            $notbefore_claim = $issuedat_claim + 10;
            $expire_claim = $issuedat_claim + 60;

            $payload = [
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "csrf" => $csrf,
                    "email" => $email,
                    "password" => $password2,
                    "username" => $username
                )
            ];

            $jwt = generate_jwt($header, $payload,$secret);

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
                // echo "token was successfully registered.";
                // header("location: http://localhost:8012/api-exercise/views/");
                include('validation.php');
            } else {
                echo "Unable to register the token.";
            }
        } else {

            http_response_code(401);
            echo "Login failed";
        }
    } else {
        http_response_code(401);
        echo "Login failed.";
    }
    }
    else{
        http_response_code(401);
    echo "csrf error";
    }
} else {
    http_response_code(401);
    echo "Empty fields";
}
