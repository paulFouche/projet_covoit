<?php
class Database{
 
    // specify your own database credentials
    // private $host = "localhost";
    // private $db_name = "covevent";
    // private $utilisateurname = "root";
    // private $password = "root";
    private $host = "paulfoucjsazerty.mysql.db";
    private $db_name = "paulfoucjsazerty";
    private $utilisateurname = "paulfoucjsazerty";
    private $password = "7r5XEz4y3HVrM32k";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->utilisateurname, $this->password);
            //$this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->utilisateurname, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>