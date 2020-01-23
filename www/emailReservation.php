<?php

            session_start();

            $creator_id = $_GET['id'];
            $user_id = $_SESSION["id"];


            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://dev.paul-fouche.com/API/utilisateur/read_one.php?id=" + $creator_id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $dataCreator = curl_exec($curl);

            curl_close($curl);
            $responseCreator - json_decode($dataCreator);

            $creator_email = $responseCreator['email'];
            $creator_tel = $responseCreator[0]['tel'];
            $creator_nom = $responseCreator[0]['nom'] + " " + $responseCreator[0]['prenom'];




            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://dev.paul-fouche.com/API/utilisateur/read_one.php?id=" + $user_id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $dataUser = curl_exec($curl);

            curl_close($curl);
            $responseUser - json_decode($dataUser);

            $user_email = $responseUser[0]['email'];
            $user_tel = $responseUser[0]['tel'];
            $user_nom = $responseUser[0]['nom'] + " " + $responseUser[0]['prenom'];


            $to = $user_email;
            $subject = 'Reservation';
            $txt = 'Votre reservation a bien été prise en compte, voici les coordonnées de votre correspondant : ' 
                    +'[nom : ' + $creator_nom + ', email : ' + $creator_email + ', tel : ' + $creator_tel + ']';
            $headers = "From: contact@covevent.com" . "\r\n" .
            "CC: support@covevent.com";

            echo '<script>console.log("email here")</script>';

            mail($to,$subject,$txt,$headers);



            $to = $creator_email;
            $subject = 'Reservation';
            $txt = 'Quelqu\'un a reserver une place dans votre vehicule, voici les coordonnées de votre correspondant : ' 
                    +'[nom : ' + $user_nom + ', email : ' + $user_email + ', tel : ' + $user_tel + ']';
            $headers = "From: contact@covevent.com" . "\r\n" .
            "CC: support@covevent.com";

            echo '<script>console.log("email here")</script>';

            mail($to,$subject,$txt,$headers);
              
?>