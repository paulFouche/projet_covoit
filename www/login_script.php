<?php

// files needed to connect to database
include_once '../API/config/database.php';
include_once '../API/objects/utilisateur.php';

session_start();
echo "hello ici";
if(isset($_POST['email']) && isset($_POST['password']))
{
    echo "hello";
    $db_username = 'paulfoucjsazerty';
    $db_password = '7r5XEz4y3HVrM32k';
    $db_name     = 'paulfoucjsazerty';
    $db_host     = 'paulfoucjsazerty.mysql.db';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    session_start();
    if($email !== "" && $password !== "")
    {
        $requete = "SELECT count(*), id FROM utilisateur WHERE email = '".$email."' and password = '".$password."' ";
        echo $requete;
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        echo $reponse;
        $count = $reponse['count(*)'];
        $numUtilisateur = $reponse['id'];


        $to = $_POST['email'];
        $subject = "Inscription";
        $txt = "Votre inscription a bien été prise en charge par CovEvent.";
        $headers = "From: contact@covevent.com" . "\r\n" .
        "CC: support@covevent.com";

        echo '<script>console.log("email here")</script>';

        mail($to,$subject,$txt,$headers);
        
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
            $_SESSION["email"]=$email;
            $_SESSION["password"]=$password;
            $_SESSION["prenom"]=$prenom;
            $_SESSION["nom"]=$nom;
            header('Location: account.php');
        }
        else
        {
           header('Location: index.php?erreur=1'); // utilisateur ou mot de passe incorrect
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