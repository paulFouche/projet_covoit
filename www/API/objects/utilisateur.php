<?php
// 'utilisateur' object
class Utilisateur{
 
    // database connection and table name
    private $conn;
    private $table_name = "utilisateur";
 
    // object properties
    public $id;
    public $prenom;
    public $nom;
    public $email;
    public $password;
    public $tel;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

// used when filling up the update product form
function readOne($id){


     // query to read single record
    $query = "SELECT * FROM ".$this->table_name." WHERE id=".$id." ";
    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->id = $row['id'];
    $this->prenom = $row['prenom'];
    $this->nom = $row['nom'];
    $this->email = $row['email'];
    $this->tel = $row['tel'];

}

// used when filling up the update product form
function readOneByEmail($email, $password){


     // query to read single record
    $query = "SELECT * FROM ".$this->table_name." WHERE email='".$email."' AND password='".$password."'";
    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->id = $row['id'];
    $this->prenom = $row['prenom'];
    $this->nom = $row['nom'];
    $this->email = $row['email'];
    $this->tel = $row['tel'];

}





 
function create(){
 
    // insert query
    $query = "INSERT INTO " . $this->table_name . " SET 
                prenom = :prenom,
                nom = :nom,
                email = :email,
                password = :password,
                tel = :tel,
                login = :login";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->prenom=htmlspecialchars(strip_tags($this->prenom));
    $this->nom=htmlspecialchars(strip_tags($this->nom));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->tel=htmlspecialchars(strip_tags($this->tel));
    $this->login=htmlspecialchars(strip_tags($this->login));
 
    // bind the values
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':email', $this->email);
 
    // hash the password before saving to database
    //$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    //$stmt->bindParam(':password', $password_hash);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':tel', $this->tel);
    $stmt->bindParam(':login', $this->login);
 
 
    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
 
// check if given email exist in the database
function emailExists($email){
 
    // query to check if email exists
    $query = "SELECT * FROM " . $this->table_name . " WHERE email ='".$email."' ";
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        return json_encode(true);
    }
 
    // return false if email does not exist in the database
    return json_encode(false);
}
 
// update a utilisateur record
public function update(){
 
    // if password needs to be updated
    $password_set=!empty($this->password) ? ", password = :password" : "";
 
    // if no posted password, do not update the password
    $query = "UPDATE " . $this->table_name . "
            SET
                prenom = :prenom,
                nom = :nom,
                email = :email,
                tel = :tel
                {$password_set}
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->prenom=htmlspecialchars(strip_tags($this->prenom));
    $this->nom=htmlspecialchars(strip_tags($this->nom));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->tel=htmlspecialchars(strip_tags($this->tel));

    // bind the values from the form
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':tel', $this->tel);
 
    // hash the password before saving to database
    if(!empty($this->password)){
        $this->password=htmlspecialchars(strip_tags($this->password));
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
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