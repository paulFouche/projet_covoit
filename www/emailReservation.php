<?php
            $to = $_SESSION["email"];
              $subject = "Reservation";
              $txt = "Votre reservation a bien été prise en charge par CovEvent.";
              $headers = "From: contact@covevent.com" . "\r\n" .
              "CC: support@covevent.com";

              echo '<script>console.log("email here")</script>';

              mail($to,$subject,$txt,$headers);

              echo '<script>document.location.href="index.php"</script>'
      ?>