<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/covoiturage.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);
 
// set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$product->readOne();
 
if($product->name!=null){
    // create array
    $product_arr = array(
        "id" =>  $product->id,
        "localisation_depart" => $product->localisation_depart,
        "depart_date" => $product->depart_date,
        "nb_place" => $product->nb_place,
        "localisation_arrive" => $product->localisation_arrive,
        "prix" => $product->prix,
        "id_createur" => $product->id_createur,
        "id_evenement" => $product->id_evenement
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($product_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>