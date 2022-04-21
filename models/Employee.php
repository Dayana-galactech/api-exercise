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
}

