<?php

namespace Utility;

use Exception;
use PDO;

class Database {

    public static function getConnection(){
        $pdo=null;
        try{
            $var=file_get_contents('./credentials.json');

            $config= (array) json_decode($var);

            $pdo = new PDO("mysql:host=" . $config['host'] . ";dbname=" .$config['dbname'], $config['user'], $config['password']);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            
        }catch(Exception $exception){
           echo $exception->getMessage();
        }
        return $pdo;
    }
}  

