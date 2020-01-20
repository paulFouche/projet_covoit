<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here

// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/utilisateur.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$utilisateur = new Utilisateur($db);
 
// submitted data will be here

// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$utilisateur->prenom = $data->prenom;
$utilisateur->nom = $data->nom;
$utilisateur->email = $data->email;
$utilisateur->password = $data->password;
//$utilisateur->tel = $data->tel;

// create the utilisateur
if(
    !empty($utilisateur->prenom) &&
    !empty($utilisateur->email) &&
    !empty($utilisateur->password) &&
    !empty($utilisateur->nom) &&
    //!empty($utilisateur->tel) &&
    $utilisateur->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: utilisateur was created
    echo json_encode(array("message" => "utilisateur was created."));
}
 
// message if unable to create utilisateur
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create utilisateur
    echo json_encode(array("message" => "Unable to create utilisateur."));
}
?>