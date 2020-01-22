<?php
session_start();
$_SESSION["email"]="";
$_SESSION["tel"]="";
$_SESSION["prenom"]="";
$_SESSION["nom"]="";
$_SESSION["id"]="";
header('Location: index.php');

?>