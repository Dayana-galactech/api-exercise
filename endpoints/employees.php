<?php


use Models\Employee;


require_once '../utility/Database.php';
require_once '../models/BaseModel.php';
require_once '../models/Employee.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$requestMethod = $_SERVER["REQUEST_METHOD"];

$userEntity = new Employee();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && $_GET['id']) {
        $user = $userEntity->getByID($_GET['id']);
    } else {
        try {
          $users = $userEntity->getAll();
          echo json_encode([
            'status' => 'ok',
            'data' => $users
          ]);
        } catch (\Exception $e) {
          echo json_encode([
            'status' => 'error',
            'msg' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
          ]);
        }
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = $userEntity->create($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $params = [];
    parse_str(file_get_contents("php://input"),$params);
    $user = $userEntity->update($params['id'], $params);
}
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
  if (isset($_GET['id']) && $_GET['id']) {
    $user = $userEntity->delete($_GET['id']);}
}
