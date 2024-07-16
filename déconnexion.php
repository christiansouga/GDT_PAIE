<?php 
session_start(); 
session_start();
if(!isset($_SESSION["utilisateur"])){
  header('location: connexion.php');
  exit;  
}
unset($_SESSION["utilisateur"]);
header('location: connexion.php'); 

