<?php

namespace Models;
use PDO;
require_once 'BaseModel.php';
class Employee extends BaseModel {
  const TABLE_NAME = 'employee';
  public $firstname;
  public $gender;
 

  public function __construct() {
    parent::__construct();
  }

  public function getTableName() {
    return self::TABLE_NAME;
  }

  public function getAll() {
    return parent::getAll(); 
    json_encode(['success' => 1,'data' => $data,]);
    }
    
 
  public function getByID(int $id){
    return parent::getBYID();
    $result= json_encode(['success' => 1,'data' => $data,]);
  }

  public function create(array $data){
    return parent::create();
    echo json_encode([
      'status' => 'ok',
      'message' => 'Employee created successfully.'
  ]);
  }

  public function update(int $id, array $data){
    return parent::update();
    echo json_encode([
      'status' => 'ok',
      'message' => 'Employee updated successfully.'
  ]);
  }

  public function delete(int $id){
    return parent::delete();
    $result= json_encode(['status' => 'ok',
      'message' => 'Employee deleted successfully.']);
  }
}

