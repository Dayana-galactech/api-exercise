<?php
require_once '../models/Employee.php';

$employee = new \Models\Employee();

// $results = $employee->getAll();
// echo json_encode($results);

// $results = $employee->create([
//   'firstname' => 'Rachel',
//   'gender' => 'female'
// ]);

// $results = $employee->getByID(70);
// echo json_encode($results);

// $results = $employee->update(70,[
//   'firstname' => 'Rachel',  
//   'gender' => 'female'
// ]);

$results = $employee->delete(74);
echo json_encode($results);