<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/covoiturage.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category = new Covoiturage($db);
 
// query categorys
$stmt = $category->readOneReservation($_GET['id']);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $categories_arr=array();
    $categories_arr["reservations"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $category_item=array(
            "id" => $id,
            "id_evenement" => $id_evenement,
            "id_createur" => $id_createur,
            "nb_place" => $nb_place,
            "localisation_depart" => $localisation_depart,
            "depart_date" => $depart_date,
            "localisation_arrive" => $localisation_arrive,
            "prix" => $prix,
            "nom_evenement" => $nom,
            //"description" => html_entity_decode($description)
        );
 
        array_push($categories_arr["reservations"], $category_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show categories data in json format
    echo json_encode($categories_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no categories found
    echo json_encode(
        array("message" => "No categories found.")
    );
}
?>