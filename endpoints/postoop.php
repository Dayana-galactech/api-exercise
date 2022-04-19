<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once './conoop.php';
    include_once './employee.php';
    $database = new Database();
    $db = $database->getConnection();
    $employee = new Employee($db);
    $firstname =trim($_POST['firstname']);
    $gender=trim($_POST['gender']);
    $employee->firstname=$firstname;
    $employee->gender=$gender;
    
    if($employee->createEmployee()){
        echo ' Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>