<?php
class Evenement{
 
    // database connection and table name
    private $conn;
    private $table_name = "evenement";
 
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


    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
                FROM " .$this->table_name. " p
                    LEFT JOIN
                        categories c
                            ON p.category_id = c.id
                WHERE
                    p.id = ?
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
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }




    // used by select drop-down list
    public function read(){
    
        //select all data
        $query = "SELECT id, nom, description FROM " . $this->table_name . " ORDER BY nom";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        return $stmt;
    }




    function search($keywords){
 
        // select all query
        $query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
                FROM " . $this->table_name . " p
                    LEFT JOIN
                        categories c
                            ON p.category_id = c.id
                WHERE
                    p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
                ORDER BY
                    p.created DESC";
     
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


    function updateReservationMoins(){
    
        // update query
        $query = "UPDATE " . $this->table_name . " SET
                    nb_place = nb_place - 1
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->id=htmlspecialchars(strip_tags($this->id));
    
       // bind id of record to delete
       $stmt->bindParam(":id", $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    function updateReservationPlus(){
    
        // update query
        $query = "UPDATE " . $this->table_name . " SET
                    nb_place = nb_place + 1
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->id=htmlspecialchars(strip_tags($this->id));
    
       // bind id of record to delete
       $stmt->bindParam(":id", $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    
}
?>