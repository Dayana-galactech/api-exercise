<?php

namespace Models;

abstract class BaseModel {
  public $pdo;
  public $id;
  public $TABLE_NAME;

  public function __construct($db) {
    $this->pdo = $db;
  }

  abstract function getTableName();

 
   public function getAll() {
      $sql = "SELECT * FROM " . $this->$TABLE_NAME . "";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $rowCount = $stmt->rowCount();
      if($rowCount > 0){
        $data = $stmt->fetchAll();
        $result= json_encode(['success' => 1,'data' => $data,]);
    }
    else{
      $result= json_encode(array("message" => "No record found."));
   }
   return  $result;
  }

  public function getByID(int $id){

  }

  public function create(array $data){

  }

  public function update(int $id, array $data){

  } 

  public function delete(int $id){

  }

}