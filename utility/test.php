<?php
require_once '../models/Employee.php';

$employee = new \Models\Employee();

//$results = $employee->getAll();
//echo json_encode($results);

$results = $employee->create([
  'firstname' => 'Joe',
  'gender' => 'male'
]);
