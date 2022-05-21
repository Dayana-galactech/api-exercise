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
$secret = 'secretKey';
$csrf = hash_hmac('SHA256', 'a string', $secret);
try {
    if (!empty($_POST['username']) && !empty($_POST['email'])  && !empty($_POST['password'])) {

        if (isset($_POST['csrf']) && hash_equals($csrf, $_POST['csrf'])) {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $table = 'users';

            $q = $con->prepare("SELECT `email` FROM $table WHERE `email` = ?");
            $q->bindValue(1, $email);
            $q->execute();

            if ($q->rowCount() > 0) {
                echo "Email already exists";
            } else {

                $query = "INSERT INTO " . $table . " (username,email,password) VALUES(:username, :email, :password)";

                $stmt = $con->prepare($query);

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);

                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt->bindParam(':password', $password_hash);

                if ($stmt->execute()) {

                    http_response_code(200);
                    echo "User was successfully registered.";
                    include("signin.php");
                } else {
                    http_response_code(400);

                    echo "Unable to register the user.";
                }
            }
        } else {
            echo "csrf not valid";
        }
    } else {
        http_response_code(400);
        echo "Some fields are empty!";
    }
} catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
    echo '  alert("' . $error . '");';
}
