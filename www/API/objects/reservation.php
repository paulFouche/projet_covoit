<?php
class Reservation{
 
    // database connection and table name
    private $conn;
    private $table_name = "reservations";
 
    // object properties
    public $id;
    public $id_utilisateur;
    public $id_covoiturage;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>