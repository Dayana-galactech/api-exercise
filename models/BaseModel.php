<?php

namespace Models;
use PDO;
use Utility\Database;
abstract class BaseModel {
  public $pdo;
  public $id;
  public $TABLE_NAME;

  public function __construct() {
    $this->TABLE_NAME = $this->getTableName();
    $this->pdo = Database::getConnection();
  }

  abstract function getTableName();
  
 
   public function getAll() {
      $sql = "SELECT * FROM " . $this->TABLE_NAME;
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $rowCount = $stmt->rowCount();
      
        $data = $stmt->fetchAll();
        
   
   return  $data;
  }

  public function getByID(int $id){

    $sql = "SELECT * FROM " . $this->TABLE_NAME . "WHERE id=?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    
      $data = $stmt->fetchAll();
     
  
  return  $data;
  }

  public function create(array $data){
    $column = implode(", ",array_keys($data));
    $value  = implode(", ", array_values($data));
    $sql = "INSERT ". $this->TABLE_NAME ."($column) VALUES('$value')";
    $stmt = $this->pdo->prepare($sql);

    $this->column=htmlspecialchars(strip_tags($this->column));

    $stmt->bindParam("$value", $this->column,$this->pdo=PDO::PARAM_STR);

    $record= $stmt->execute();

  return $record; 
  }


  public function update(int $id, array $data){
    $column = implode(", ",array_keys($data));
    $value  = implode(", ", array_values($data));
    $sql = "UPDATE". $this->TABLE_NAME ."SET $column= :".$value." WHERE id=?";
    $stmt = $this->pdo->prepare($sql);

    $this->column=htmlspecialchars(strip_tags($this->column));

    $stmt->bindParam(':'.$value, $this->column,$this->pdo=PDO::PARAM_STR);

    $record= $stmt->execute();
  
  return $record; 
  } 

  public function delete(int $id){
    $sql = "DELETE * FROM " . $this->TABLE_NAME . "WHERE id=?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
  return  $stmt;
  }

}