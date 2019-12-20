<?php
class Covoiturage{
 
    // database connection and table name
    private $conn;
    private $table_name = "covoiturages";
 
    // object properties
    public $id;
    public $localisation_depart;
    public $depart_date;
    public $localisation_arrive;
    public $prix;
    public $nb_place;
    public $id_createur;
    public $id_evenement;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>