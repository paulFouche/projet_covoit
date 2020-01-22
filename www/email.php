<?php
$from = "contact@explotrip.com";
$to = "julien@bardin.me";
$subject = "This is my email";
$message = "test1111";
$send = mail($to, $subject, $message);
if(!$send){    
    die();  
}
?>