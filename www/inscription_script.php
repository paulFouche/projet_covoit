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

    $to = $email;
    $subject = "Inscription";
    $txt = "Votre inscription a bien été prise en charge par CovEvent.";
    $headers = "From: contact@covevent.com" . "\r\n" .
    "CC: support@covevent.com";

    echo '<script>console.log("email here")</script>';

    mail($to,$subject,$txt,$headers);
        

    if($email !== "" && $password !== "")
    {

        $curl = curl_init();

        $curl_post_data = array(
                'prenom' => $prenom,
                'nom' => $nom,
                'email' => $email,
                'password' => $password,
                'tel' => $tel
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://dev.paul-fouche.com/API/utilisateur/create.php",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>$curl_post_data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        if ($response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
            header('Location: index.php');
        } 

        if ($response === true) {
            $_SESSION["email"]=$email;
            $_SESSION["password"]=$password;
            $_SESSION["prenom"]=$prenom;
            $_SESSION["nom"]=$nom;

            header('Location: account.php');
        } 

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