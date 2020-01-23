<?php
            $to = "julien@bardin.me";
              $subject = 'c est un test';
              $txt = 'le text est là ';
              $headers = "From: contact@covevent.com" . "\r\n" .
              "CC: support@covevent.com";

              echo '<script>console.log("email here")</script>';

              mail($to,$subject,$txt,$headers);

              $to2 = $_SESSION["email"];
              $subject2 = 'c est un test';
              $txt2 = 'le test est là ';
              $headers2 = "From: contact@covevent.com" . "\r\n" .
              "CC: support@covevent.com";

              echo '<script>console.log("email here")</script>';

              mail($to2,$subject2,$txt2,$headers2);
              
?>