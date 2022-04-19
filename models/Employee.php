<?php

namespace Models;
use PDO;
class Employee extends BaseModel {
  const TABLE_NAME = 'employee';
  public $firstname;
  public $gender;
 

  public function __construct($db) {
    parent::__construct($db);
  }

  public function getTableName() {
    return self::TABLE_NAME;
  }

  public function getAll() {
  //   $sql = "SELECT * FROM " . $this->TABLE_NAME . "";
  //   $stmt = $this->pdo->prepare($sql);
  //   $stmt->execute();
  //   $employeeCount = $stmt->rowCount();
  //   if($employeeCount > 0){
  //     $data = $stmt->fetchAll();
  //     $result= json_encode(['success' => 1,'data' => $data,]);
  // }

  // else{
  //    $result= json_encode(array("message" => "No record found."));
  // }
  // return  $result;  
  }

  public function getByID($id){

  }

  public function create(array $data){
    // $sql = "INSERT ". $this->db_table ."(firstname,gender) VALUES(:firstname,:gender)";

    // $stmt = $this->pdo->prepare($sql);

    // $this->firstname=htmlspecialchars(strip_tags($this->firstname));
    // $this->gender=htmlspecialchars(strip_tags($this->gender));  

    // $stmt->bindParam(":firstname", $this->firstname,$this->pdo=PDO::PARAM_STR);
    // $stmt->bindParam(":gender", $this->gender,$this->pdo=PDO::PARAM_STR); 

    // if($stmt->execute()){
    //     return true;
    //  }
    //  return false;

  }

  public function update(int $id, array $data){

  }

  public function delete(int $id){

  }
}