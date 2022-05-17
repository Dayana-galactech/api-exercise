<?php

include '../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Utility\Database;

require_once '../utility/Database.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();

// $requestMethod = $_SERVER["REQUEST_METHOD"];
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
// if (isset($_GET['id']) && $_GET['id']) {
//     $id=$_GET['id'];
//     $query = "SELECT token FROM tokens WHERE id=?";
//     $stmt = $db->prepare($query);
//     $stmt->bindParam(1, $id);
//     $stmt->execute();
//     $row = $stmt->fetchAll();
//     foreach ($row as $token) {
//         var_dump($jwt = $token->token);
//     }
if(isset($_POST['jwt'])){
var_dump($jwt=$_POST['jwt']);
    try {
        $secret_key = "secretKey";
        $data = JWT::decode($jwt, $secret_key,array('HS256'));

        echo json_encode([
            'status' => 1,
            'message' => $data,
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 0,
            'message' => $e->getMessage(),
        ]);
    }
}
// }
// }
?>