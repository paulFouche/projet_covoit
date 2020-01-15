<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/covoiturage.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Covoiturage($db);


 
// get posted data
$data = json_decode(file_get_contents("php://input"));


// make sure data is not empty
if(
    !empty($data->localisation_depart) &&
    !empty($data->depart_date) &&
    !empty($data->nb_place) &&
    !empty($data->localisation_arrive) &&
    !empty($data->prix) && 
    !empty($data->id_evenement) &&
    !empty($data->id_createur)
){
    
    // set product property values
    $product->localisation_depart = $data->localisation_depart;
    $product->depart_date = $data->depart_date;
    $product->nb_place = $data->nb_place;
    $product->localisation_arrive = $data->localisation_arrive;
    $product->prix = $data->prix;
    $product->id_evenement = $data->id_evenement;
    $product->id_createur = $data->id_createur;
    
 
    // create the product
    if($product->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>