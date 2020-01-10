<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// required to encode json web token
include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/utilisateur.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate utilisateur object
$utilisateur = new Utilisateur($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// if jwt is not empty
if($jwt){
 
    // if decode succeed, show utilisateur details
    try {
 
        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));
 
        // set utilisateur property values
		$utilisateur->prenom = $data->prenom;
		$utilisateur->nom = $data->nom;
		$utilisateur->email = $data->email;
		$utilisateur->password = $data->password;
		$utilisateur->id = $decoded->data->id;
		 
		// update the utilisateur record
		if($utilisateur->update()){
		    // we need to re-generate jwt because utilisateur details might be different
			$token = array(
			   "iss" => $iss,
			   "aud" => $aud,
			   "iat" => $iat,
			   "nbf" => $nbf,
			   "data" => array(
			       "id" => $utilisateur->id,
			       "prenom" => $utilisateur->prenom,
			       "nom" => $utilisateur->nom,
			       "email" => $utilisateur->email
			   )
			);
			$jwt = JWT::encode($token, $key);
			 
			// set response code
			http_response_code(200);
			 
			// response in json format
			echo json_encode(
			        array(
			            "message" => "utilisateur was updated.",
			            "jwt" => $jwt
			        )
			    );
		}
		 
		// message if unable to update utilisateur
		else{
		    // set response code
		    http_response_code(401);
		 
		    // show error message
		    echo json_encode(array("message" => "Unable to update utilisateur."));
		}
    }
 
    // if decode fails, it means jwt is invalid
	catch (Exception $e){
	 
	    // set response code
	    http_response_code(401);
	 
	    // show error message
	    echo json_encode(array(
	        "message" => "Access denied.",
	        "error" => $e->getMessage()
	    ));
	}
}
// show error message if jwt is empty
else{
 
    // set response code
    http_response_code(401);
 
    // tell the utilisateur access denied
    echo json_encode(array("message" => "Access denied."));
}
?>