<?php


use Controllers\EmployeeController;


$employeeController = new EmployeeController();

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_GET['id'])) {
      return $employeeController->show($_GET);
    } else {
      return $employeeController->index($_GET);
    }

  case 'POST':
    return $employeeController->store($_POST);

  case 'PUT':
    $params = [];
    parse_str(file_get_contents("php://input"),$params);
    return $employeeController->update($params);

  case 'DELETE':
    return $employeeController->destroy($_GET);

}
