<?php
class Evenement{
 
    // database connection and table name
    private $conn;
    private $table_name = "evenements";
 
    // object properties
    public $id;
    public $nom;
    public $description;
    public $nb_place;
    public $localisation;
    public $date_debut;
    public $date_fin;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>