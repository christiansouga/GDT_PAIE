<?php
session_start();
if (!isset($_SESSION["utilisateur"])) {
    // header('location: connexion.php');
    // exit;
}

require_once 'connexiondb.php'; 


