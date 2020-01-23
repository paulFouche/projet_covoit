<?php

session_start();
if(isset($_POST['nb_place']) && isset($_POST['prix']))
{
    $db_username = 'paulfoucjsazerty';
    $db_password = '7r5XEz4y3HVrM32k';
    $db_name     = 'paulfoucjsazerty';
    $db_host     = 'paulfoucjsazerty.mysql.db';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $id_event = mysqli_real_escape_string($db,htmlspecialchars($_POST['lieu'])); 
    $localisation_depart = mysqli_real_escape_string($db,htmlspecialchars($_POST['localisation_depart']));
    $localisation_arrive = mysqli_real_escape_string($db,htmlspecialchars($_POST['localisation_arrive']));
    $depart_date = mysqli_real_escape_string($db,htmlspecialchars($_POST['depart_date']));
    $prix = mysqli_real_escape_string($db,htmlspecialchars($_POST['prix']));
    $nb_place = mysqli_real_escape_string($db,htmlspecialchars($_POST['nb_place']));

    //$id_event = pg_escape_string($db,htmlspecialchars($_POST['lieu'])); 
    //$localisation_depart = pg_escape_string($db,htmlspecialchars($_POST['localisation_depart']));
    //$localisation_arrive = pg_escape_string($db,htmlspecialchars($_POST['localisation_arrive']));
    //$depart_date = pg_escape_string($db,htmlspecialchars($_POST['depart_date']));
    //$prix = pg_escape_string($db,htmlspecialchars($_POST['prix']));
    //$nb_place = pg_escape_string($db,htmlspecialchars($_POST['nb_place']));
    
    if($nb_place !== "" && $prix !== "")
    {
        $url_api = "http://dev.paul-fouche.com";
        //next example will insert new conversation
        $service_url = $url_api.'/API/covoiturage/create.php';
        $curl = curl_init($service_url);
        $id = $_SESSION["id"];
        $curl_post_data = array(
                'id_createur' => $id,
                'id_evenement' => $id_event,
                'localisation_arrive' => $localisation_arrive,
                'localisation_depart' => $localisation_depart,
                'depart_date' => $depart_date,
                'prix' => $prix,
                'nb_place' => $nb_place
        );
        echo  json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($curl_post_data));
        $curl_response = curl_exec($curl);
        echo $curl_response;
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
            //header('Location: index.php');
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
            //header('Location: index.php');
        }
        echo 'response ok!';
        var_export($decoded->response);
        header('Location: account.php');
    }
    else
    {
       header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: index.php?erreur=1');
}
?>