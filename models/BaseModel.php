<?php

namespace Models;
use PDO;
use Utility\Database;
require_once '../utility/Database.php';
abstract class BaseModel {
  public $pdo;
  public $id;
  public $TABLE_NAME;

  public function __construct() {
    $this->TABLE_NAME = $this->getTableName();
    $this->pdo = Database::getConnection();
  }

  abstract function getTableName();
  
 
   public function getAll($page=null,$count=null) {
     if($page=null & $count=null){
      $page=0;
      $count=10;
      $start = ($page) * $count;
     }
     elseif($page=null){
      $page=0;
      $start = ($page) * $count;
     }
     elseif($count=null){
      $count=0;
      $start = ($page-1) * $count;
     }
     else {
      $start = ($page-1) * $count; 
      }
      $sql = "SELECT * FROM " . $this->TABLE_NAME." LIMIT " . $start . ',' . $count;
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $data = $stmt->fetchAll();    
   
   return  $data;
  }

  public function getByID(int $id,$page=null,$count=null){
    if($page=null & $count=null){
      $page=0;
      $count=10;
      $start = ($page) * $count;
     }
     elseif($page=null){
      $page=0;
      $start = ($page) * $count;
     }
     elseif($count=null){
      $count=0;
      $start = ($page-1) * $count;
     }
     else {
      $start = ($page-1) * $count; 
      }

    $sql = "SELECT * FROM " . $this->TABLE_NAME . "WHERE id=? LIMIT " . $start . ',' . $count;
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    // $rowCount = $stmt->rowCount();
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