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

     // delete the product
     function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }




    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                    e.event as id_evenement, c.id, c.localisation_depart, c.depart_date, c.nb_place, c.localisation_arrive, c.prix, c.id_createur
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        categories e
                            ON c.category_id = e.id
                WHERE
                    c.id = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->localisation_depart = $row['localisation_depart'];
        $this->depart_date = $row['depart_date'];
        $this->nb_place = $row['nb_place'];
        $this->localisation_arrive = $row['localisation_arrive'];
        $this->prix = $row['prix'];
        $this->id_evenement = $row['id_evenement'];
        $this->id_createur = $row['id_createur'];

    }




    // used by select drop-down list
    public function read(){
    
        //select all data
        $query = "SELECT
                    id, id_evenement, id_createur, nb_place, localisation_depart, depart_date
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id_evenement";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        return $stmt;
    }




    function search($keywords){
 
        // select all query
        $query = "SELECT
                    e.event as id_evenement, c.localisation_depart, c.depart_date, c.nb_place, c.localisation_arrive, c.prix
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        categories e
                            ON c.category_id = e.id
                WHERE
                    c.localisation_depart LIKE ? OR c.depart_date LIKE ? OR e.event LIKE ?
                ORDER BY
                    c.nb_place DESC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
     
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }


    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    localisation_depart = :localisation_depart,
                    depart_date = :depart_date,
                    nb_place = :nb_place,
                    localisation_arrive = :localisation_arrive,
                    prix = :prix,
                    id_evenement = :id_evenement,
                    id_createur = :id_createur
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->localisation_depart=htmlspecialchars(strip_tags($this->localisation_depart));
        $this->depart_date=htmlspecialchars(strip_tags($this->depart_date));
        $this->nb_place=htmlspecialchars(strip_tags($this->nb_place));
        $this->localisation_arrive=htmlspecialchars(strip_tags($this->localisation_arrive));
        $this->prix=htmlspecialchars(strip_tags($this->prix));
        $this->id_evenement=htmlspecialchars(strip_tags($this->id_evenement));
        $this->id_createur=htmlspecialchars(strip_tags($this->id_createur));
    
        // bind new values
        $stmt->bindParam(':localisation_depart', $this->localisation_depart);
        $stmt->bindParam(':depart_date', $this->depart_date);
        $stmt->bindParam(':nb_place', $this->nb_place);
        $stmt->bindParam(':localisation_arrive', $this->localisation_arrive);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':id_evenement', $this->id_evenement);
        $stmt->bindParam(':id_createur', $this->id_createur);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

}
?>