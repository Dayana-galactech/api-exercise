<?php


use Models\Employee;


require_once '../utility/Database.php';
require_once 'BaseModel.php';
require_once 'Employee.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$requestMethod = $_SERVER["REQUEST_METHOD"];

$userEntity = new Employee();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($this->id) {
        $user = $userEntity->getByID($this->id);
    } else {
        $user = $userEntity->getAll();
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = $userEntity->create($this->data);
}
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $user = $userEntity->update($this->id, $this->data);
}
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $user = $userEntity->delete($this->id);
}
