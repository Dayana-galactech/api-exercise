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
    
 
  public function getByID(int $id,$page=null,$count=null){
    return parent::getByID($this->id,$this->page,$this->count);
    $result= json_encode(['success' => 1,'data' => $this->data,]);
  }

  public function create(array $data){
    return parent::create($this->data);
    echo json_encode([
      'status' => 'ok',
      'message' => 'Employee created successfully.'
  ]);
  }

  public function update(int $id, array $data){
    return parent::update($this->id, $this->data);
    echo json_encode([
      'status' => 'ok',
      'message' => 'Employee updated successfully.'
  ]);
  }

  public function delete(int $id){
    return parent::delete($this->id);
    $result= json_encode(['status' => 'ok',
      'message' => 'Employee deleted successfully.']);
  }
}

