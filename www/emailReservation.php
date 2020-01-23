<?php

            session_start();

            $creator_id = $_GET['id'];
            $user_id = $_SESSION["id"];

            echo "creator : ".$creator_id;
            echo "user : ".$user_id;

            //--
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://dev.paul-fouche.com/API/utilisateur/read_one.php?id=".$creator_id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
              ),
            ));

            $responseCreator = curl_exec($curl);
            $respCreator = json_decode($responseCreator);

            curl_close($curl);
            $creator_email = $respCreator->email;
            $creator_tel = $respCreator->tel;
            $creator_nom = $respCreator->nom;
            

            //-----

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://dev.paul-fouche.com/API/utilisateur/read_one.php?id=".$user_id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
              ),
            ));

            $responseUser = curl_exec($curl);
            $respUser = json_decode($responseUser);

            curl_close($curl);

            $user_email = $respUser->email;
            $user_tel = $respUser->tel;
            $user_nom = $respUser->nom;
            echo $user_email;


            $to = $user_email;
            $subject = 'Reservation';
            $txt = 'Votre reservation a bien été prise en compte, voici les coordonnées de votre correspondant : ' 
                    +'[nom : '.$creator_nom.', email : '.$creator_email.', tel : '.$creator_tel.']';
            $headers = "From: contact@covevent.com" . "\r\n" .
            "CC: support@covevent.com";

            echo '<script>console.log("email here")</script>';

            mail($to,$subject,$txt,$headers);



            $to = $creator_email;
            $subject = 'Reservation';
            $txt = 'Quelqu\'un a reserver une place dans votre vehicule, voici les coordonnées de votre correspondant : ' 
                    +'[nom : '.$user_nom.', email : '.$user_email.', tel : '.$user_tel.']';
            $headers = "From: contact@covevent.com" . "\r\n" .
            "CC: support@covevent.com";

            echo '<script>console.log("email here")</script>';

            mail($to,$subject,$txt,$headers);
              
?>