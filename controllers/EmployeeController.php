<?php

namespace Controllers;

use Models\Employee;

class EmployeeController{

    public function index($request = array()) {
        $employees = new Employee();
        $employeesData = $employees->getAll();

        return array(
          'status' => 'ok',
          'data' => $employeesData
        );
    }

    public function show($request = array()) {
      if (!isset($request['data']['id'])) {
        return array(
          'status' => 'error',
          'message' => 'please provide an employee id'
        );
      }

      $employeeID = intval($request['data']['id']);

      $employees = new Employee();
      $employee  = $employees->getByID($employeeID);

      return array(
        'status' => 'ok',
        'data' => $employee
      );
    }

    public function create($request = array()) {

    }

    public function store($request = array()) {
        $request['data']['firstname']  = htmlspecialchars(strip_tags($request['data']['firstname']));
        $request['data']['gender']     = htmlspecialchars(strip_tags($request['data']['gender']));

        $employees = new Employee();
        $status = $employees->create($request['data']);

        return array(
          'status' => $status ? 'ok' : 'error'
        );
    }

    public function edit($request = array()) {

    }

    public function update($request = array()) {
      $id = $request['data']['id'];
      unset($request['data']['id']);

      $employees = new Employee();

      $status = $employees->update($id, $request['data']);

      return array(
        'status' => $status ? 'ok' : 'error'
      );
    }

    public function destroy($request = array()) {
      if (!isset($request['data']['id'])) {
        return array(
          'status' => 'error',
          'message' => 'please provide an employee id'
        );
      }

      $employees = new Employee();

      $status = $employees->delete($request['data']['id']);

      return array(
        'status' => $status ? 'ok' : 'error'
      );
    }
}    
