<?php

use Models\BaseModel;
use Utility\Database;
require_once './utility/Database.php';

class User extends BaseModel {

    private $db;
    public function __construct() {
        parent::__construct();
        $this->db = new Database;
    }

    public function register($data) {
        return self::create($data);
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

  function getTableName()
  {
    return 'users';
  }
}