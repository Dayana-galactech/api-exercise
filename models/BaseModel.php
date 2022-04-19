<?php

namespace Models;

abstract class BaseModel {

  public function __construct() {

  }

  abstract function getTableName();

}