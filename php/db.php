<?php 
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password ;
    public $con;

    
    public function __construct(){
        $this->host = 'db';
        $this->db_name = getenv('MYSQL_DATABASE');
        $this->username = getenv('MYSQL_USER');
        $this->password = getenv('MYSQL_PASSWORD');
    }

    public function getConnection(){
        $this->con = null;

        try{
            $this->con = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->con->exec("set names utf8");
        } catch(PDOException $err){
            echo 'Error in connection: '.$err->getMessage();
        }

        return $this->con;
    } 
}