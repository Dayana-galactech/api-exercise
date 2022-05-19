<?php

namespace Controllers;

use Models\Employee;

class EmployeeController{

    public function index($data = array()) {
        $employees = new Employee();
        $employeesData = $employees->getAll();

        return array(
          'status' => 'ok',
          'data' => $employeesData
        );
    }

    public function show($data = array()) {
      if (!isset($data['id'])) {
        return array(
          'status' => 'error',
          'message' => 'please provide an employee id'
        );
      }

      $employeeID = intval($data['id']);

      $employees = new Employee();
      $employee  = $employees->getByID($employeeID);

      return array(
        'status' => 'ok',
        'data' => $employee
      );
    }

    public function create($data = array()) {

    }

    public function store($data = array()) {
        $data['firstname']  = htmlspecialchars(strip_tags($data['firstname']));
        $data['gender']     = htmlspecialchars(strip_tags($data['gender']));

        $employees = new Employee();
        $status = $employees->create($data);

        return array(
          'status' => $status ? 'ok' : 'error'
        );
    }

    public function edit($data = array()) {

    }

    public function update($data = array()) {
      $id = $data['id'];
      unset($data['id']);

      $employees = new Employee();

      $status = $employees->update($id, $data);

      return array(
        'status' => $status ? 'ok' : 'error'
      );
    }

    public function destroy($data = array()) {
      if (!isset($data['id'])) {
        return array(
          'status' => 'error',
          'message' => 'please provide an employee id'
        );
      }

      $employees = new Employee();

      $status = $employees->delete($data['id']);

      return array(
        'status' => $status ? 'ok' : 'error'
      );
    }
}    
