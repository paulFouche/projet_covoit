<?php

session_start();
if(isset($_POST['email']) && isset($_POST['password']))
{
    $db_username = 'paulfoucjsazerty';
    $db_password = '7r5XEz4y3HVrM32k';
    $db_name     = 'paulfoucjsazerty';
    $db_host     = 'paulfoucjsazerty.mysql.db';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $prenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['firstname'])); 
    $nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['lastname']));
    $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    $tel = mysqli_real_escape_string($db,htmlspecialchars($_POST['tel']));

    if($email !== "" && $password !== "")
    {
        //next example will insert new conversation
        $service_url = 'http://dev.paul-fouche.com/API/utilisateur/create.php';
        $curl = curl_init($service_url);
        $curl_post_data = array(
                'prenom' => $prenom,
                'nom' => $nom,
                'email' => $email,
                'password' => $password,
                'tel' => $tel
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
            header('Location: index.php');
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
            header('Location: index.php');
        }

        echo 'response ok!';
        var_export($decoded->response);

        $_SESSION["email"]=$email;
        $_SESSION["password"]=$password;
        $_SESSION["prenom"]=$prenom;
        $_SESSION["nom"]=$nom;

        header('Location: account.php');
    }
    else
    {
       header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: index.php');
}
?>