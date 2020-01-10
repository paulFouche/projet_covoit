<?php
class Database{
 
    // specify your own database credentials
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
            $this->conn->exec("set names utf8");
            echo "Connection validate";
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>