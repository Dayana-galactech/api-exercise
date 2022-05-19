<?php

use Utility\Database;

require_once '../utility/Database.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();


if (isset($_GET['id']) && $_GET['id']) {
    $id=$_GET['id'];
    $query = "SELECT token FROM tokens WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetchAll();
    foreach ($row as $token) {
        $jwt = $token->token;
    }
   $q="SELECT * from users INNER JOIN tokens on users.id=tokens.id WHERE tokens.id=?";
   $stmt2 = $db->prepare($q);
   $stmt2->bindParam(1, $id);
   $stmt2->execute();
   $row2 = $stmt2->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
   if (isset($_GET['showhtml'])) {
     echo "<div>".$row2[3][0]['username']."</div>";
   } else {
     echo json_encode([
       'status' => 'ok',
       'data' => $row2
     ]);
   }



}
