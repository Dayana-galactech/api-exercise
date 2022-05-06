<?php
require_once '../models/Employee.php';

$employee = new \Models\Employee();

// $results = $employee->getAll();
// echo json_encode($results);

// $results = $employee->create([
//   'firstname' => 'Rachel',
//   'gender' => 'female'
// ]);

// $results = $employee->getByID(77);
// echo json_encode($results);

$results = $employee->update(62, [
    'id' => 62,
    'firstname' => 'Dayananew',
    'gender' => 'female'
]);

// $results = $employee->delete(60);
