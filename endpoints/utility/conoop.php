<?php


class Database {

    // private $host = 'localhost';
    // private $dbname = 'api';
    // private $username = 'root';
    // private $password = '';
 
    public $pdo;
    public function getConnection(){
        // $var=file_get_contents('./credentials.json');
        // $config=json_decode($var);
        
        $this->pdo = null;
        try{
            $var=file_get_contents('../../credentials.json');
            $config= (array)json_decode($var);
            
            $this->pdo = new PDO("mysql:host=" . $config['host'] . ";dbname=" .$config['dbname'], $config['user'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("set names utf8");
            
        }catch(PDOException $exception){
           echo $exception->getMessage();
        }
        return $this->pdo;
    }
}  

?>