<?php

use Controllers\Employee;
use Utility\Database;

header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require_once '../utility/Database.php';
    require_once '../controllers/Employee.php';
    $database = new Database();
    $db = $database->getConnection();
    $employee = new Employee($db);
    $firstname =trim($_POST['firstname']);
    $gender=trim($_POST['gender']);
    $employee->firstname=$firstname;
    $employee->gender=$gender;
    
    if($employee->createEmployee()){
        echo json_encode([
          'status' => 'ok',
          'message' => 'Employee created successfully.'
        ]);
    } else{
        echo 'Employee could not be created.';
    }
?>