<?php
include '../vendor/autoload.php';

use Utility\Database;

require_once '../utility/Database.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

$database = new Database();
$db = $database->getConnection();


$secret = 'secretKey';
$csrf = $_SESSION['csrf_token'];

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['csrf'])) {

  if (hash_equals($csrf, $_POST['csrf'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $query = "SELECT * FROM users WHERE email = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    if (count($rows) == 0) {
      http_response_code(401);
      echo "Login failed.";
    }


    $row = $rows[0];
    $username = htmlspecialchars($row->username);
    $hashedPassword = $row->password;

    if (password_verify($password, $hashedPassword)) {
      $_SESSION['user'] = array(
        "email" => $email,
        "username" => $username
      );

      http_response_code(200);
      header("location: /views/index.php");
    } else {
      http_response_code(401);
      echo "Login failed, password " . $password;
    }

  }
}