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

    // create new Reservation record
    function create(){
    
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    id_utilisateur = :id_utilisateur,
                    id_covoiturage = :id_covoiturage";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_utilisateur=htmlspecialchars(strip_tags($this->id_utilisateur));
        $this->id_covoiturage=htmlspecialchars(strip_tags($this->id_covoiturage));
    
        // bind the values
        $stmt->bindParam(':id_utilisateur', $this->id_utilisateur);
        $stmt->bindParam(':id_covoiturage', $this->id_covoiturage);
    
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

}
?>