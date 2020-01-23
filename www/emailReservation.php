<?php
            $to = $_POST['email'];
              $subject = $_POST['subject'];
              $txt = $_POST['txt'];
              $headers = "From: contact@covevent.com" . "\r\n" .
              "CC: support@covevent.com";

              echo '<script>console.log("email here")</script>';

              mail($to,$subject,$txt,$headers);
      ?>