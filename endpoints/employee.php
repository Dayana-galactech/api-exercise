<?php

class Employee{
    public $pdo;
    private $db_table = "employee";
    public $id;
    public $firstname;
    public $gender;
    
    public function __construct($db){
        $this->pdo = $db;
       
    }
    
    public function getEmployees(){
        $sql = "SELECT id, firstname, gender FROM " . $this->db_table . "";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function createEmployee(){
        $sql = "INSERT ". $this->db_table ."(firstname,gender) VALUES(:firstname,:gender)";

        $stmt = $this->pdo->prepare($sql);

        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->gender=htmlspecialchars(strip_tags($this->gender));  

        $stmt->bindParam(":firstname", $this->firstname,$this->pdo=PDO::PARAM_STR);
        $stmt->bindParam(":gender", $this->gender,$this->pdo=PDO::PARAM_STR); 

        if($stmt->execute()){
            return true;
         }
         return false;
    }
}    
?>