<?php

            session_start();

            $creator_id = $_GET['id'];
            $user_id = $_SESSION["id"];
            //--
            $curl = curl_init();

            $url_api = "http://dev.paul-fouche.com";

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url_api."/API/utilisateur/read_one.php?id=".$creator_id,
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
            $creator_prenom = $respCreator->prenom;
            

            //-----

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url_api."/API/utilisateur/read_one.php?id=".$user_id,
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
            $user_prenom = $respUser->prenom;


            $to = $user_email;
            $subject = 'Reservation';
            $txt = 'Votre reservation a bien été prise en compte, voici les coordonnées de votre correspondant : '.$creator_nom.' '.$creator_prenom.', email : '.$creator_email.', tel : '.$creator_tel.'Covevent vous souhaites un excellent voyage :)';
            $headers = "From: contact@covevent.com" . "\r\n" .
            "CC: support@covevent.com";

            echo '<script>console.log("email here")</script>';

            mail($to,$subject,$txt,$headers);



            $to = $creator_email;
            $subject = 'Reservation';
            $txt = 'Quelqu\'un a reserver une place dans votre vehicule, voici les coordonnées de votre correspondant : ' 
                    +'[nom : '.$user_nom.', email : '.$user_email.', tel : '.$user_tel.']';
            $txt = 'Quelqu\'un a reserver une place dans votre vehicule, voici les coordonnées de votre correspondant : '.$user_nom.' '.$user_prenom.', email : '.$user_email.', tel : '.$user_tel.'Covevent vous souhaites un excellent voyage :)';
            $headers = "From: contact@covevent.com" . "\r\n" .
            "CC: support@covevent.com";

            echo '<script>console.log("email here")</script>';

            mail($to,$subject,$txt,$headers);
              
?>