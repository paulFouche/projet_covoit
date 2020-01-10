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

    // create new Evenement record
    function create(){
    
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    localisation_depart = :localisation_depart,
                    depart_date = :depart_date,
                    nb_place = :nb_place,
                    localisation_arrive = :localisation_arrive,
                    prix = :prix,
                    id_evenement = :id_evenement,
                    id_createur = :id_createur";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->localisation_depart=htmlspecialchars(strip_tags($this->localisation_depart));
        $this->depart_date=htmlspecialchars(strip_tags($this->depart_date));
        $this->nb_place=htmlspecialchars(strip_tags($this->nb_place));
        $this->localisation_arrive=htmlspecialchars(strip_tags($this->localisation_arrive));
        $this->prix=htmlspecialchars(strip_tags($this->prix));
        $this->id_evenement=htmlspecialchars(strip_tags($this->id_evenement));
        $this->id_createur=htmlspecialchars(strip_tags($this->id_createur));
    
        // bind the values
        $stmt->bindParam(':localisation_depart', $this->localisation_depart);
        $stmt->bindParam(':depart_date', $this->depart_date);
        $stmt->bindParam(':nb_place', $this->nb_place);
        $stmt->bindParam(':localisation_arrive', $this->localisation_arrive);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':id_evenement', $this->id_evenement);
        $stmt->bindParam(':id_createur', $this->id_createur);
    
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


}
?>