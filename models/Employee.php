<?php

namespace Models;

class Employee extends BaseModel {
  const TABLE_NAME = 'employees';

  public function __construct() {
    parent::__construct();
  }

  function getTableName() {
    return self::TABLE_NAME;
  }
}