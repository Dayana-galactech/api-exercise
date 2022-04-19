<?php
header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require_once './conoop.php';
    require_once './employee.php';
    try{
    $database = new Database();
    $db = $database->getConnection();
    $employee = new Employee($db);
    $stmt = $employee->getEmployees();
    $employeeCount = $stmt->rowCount();

    if($employeeCount > 0){
        $data = $stmt->fetchAll();
        
        echo json_encode([
          'success' => 1,
          'data' => $data,
      ]);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
}
catch(\Exception $exception){
    echo $exception->getMessage();
}
?>