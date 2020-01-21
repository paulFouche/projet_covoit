<?php

session_start();
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
    $prenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['firstname'])); 
    $nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['lastname']));
    $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    $tel = mysqli_real_escape_string($db,htmlspecialchars($_POST['tel']));

    echo $email;
    if($email !== "" && $password !== "")
    {
        //next example will insert new conversation
        $service_url = 'http://dev;paul-fouche.com/API/utilisateur/create.php';
        $curl = curl_init($service_url);
        $curl_post_data = array(
                'prenom' => 'test message',
                'nom' => 'agent@example.com',
                'email' => 'departmentId001',
                'password' => 'My first conversation',
                'tel' => 'recipient@example.com'
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }
        echo 'response ok!';
        var_export($decoded->response);
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