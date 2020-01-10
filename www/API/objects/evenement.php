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

    function create(){
    
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    nom = :nom,
                    description = :description,
                    nb_place = :nb_place,
                    localisation = :localisation,
                    date_debut = :date_debut,
                    date_fin = :date_fin";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->nb_place=htmlspecialchars(strip_tags($this->nb_place));
        $this->localisation=htmlspecialchars(strip_tags($this->localisation));
        $this->date_debut=htmlspecialchars(strip_tags($this->date_debut));
        $this->date_fin=htmlspecialchars(strip_tags($this->date_fin));
    
        // bind the values
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':nb_place', $this->nb_place);
        $stmt->bindParam(':localisation', $this->localisation);
        $stmt->bindParam(':date_debut', $this->date_debut);
        $stmt->bindParam(':date_fin', $this->date_fin);
    
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
 
    // emailExists() method will be here

    // check if given event exist in the database
    function eventExists(){
    
        // query to check if event exists
        $query = "SELECT id, description, nb_place, localisation, date_debut, date_fin
                FROM " . $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->nom);
    
        // bind given email value
        $stmt->bindParam(1, $this->nom);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->description = $row['description'];
            $this->nb_place = $row['nb_place'];
            $this->localisation = $row['localisation'];
            $this->date_debut = $row['date_debut'];
            $this->date_fin = $row['date_fin'];
    
            // return true because email exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }
    
    // update() method will be here

    // update a Evenement record
    public function update(){
    
        // if nb_place needs to be updated
        $nb_place_set=!empty($this->nb_place) ? ", nb_place = :nb_place" : "";
    
        // if no posted nb_place, do not update the nb_place
        $query = "UPDATE " . $this->table_name . "
                SET
                    nom = :nom,
                    description = :description,
                    localisation = :localisation,
                    date_debut = :date_debut
                    date_fin= :date_fin
                    {$nb_place_set}
                WHERE id = :id";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->localisation=htmlspecialchars(strip_tags($this->localisation));
        $this->date_debut=htmlspecialchars(strip_tags($this->date_debut));
        $this->date_fin=htmlspecialchars(strip_tags($this->date_fin));
    
        // bind the values from the form
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':localisation', $this->localisation);
        $stmt->bindParam(':date_debut', $this->date_debut);
        $stmt->bindParam(':date_fin', $this->date_fin);
    
        // hash the nb_place before saving to database
        if(!empty($this->nb_place)){
            $stmt->bindParam(':nb_place', $this->nb_place);
        }
    
        // unique ID of record to be edited
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    
}
?>