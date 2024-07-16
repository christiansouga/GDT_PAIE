<?php session_start();
if(!isset($_SESSION["utilisateur"])){
  header('location: connexion.php');
  require_once 'connexiondb.php'; 
  exit;   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css">
    <link rel="stylesheet" href="contenuApp.css">
    <link rel="stylesheet" href="authentification.css">
    <title>contenuApplication</title>
</head>
<body>

    <div id="wrapper">
        <div class="overlay"></div>
         
             <!-- Sidebar -->
         <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
          <ul class="nav sidebar-nav">
            <div class="sidebar-header">
                <h6 style="color:skyblue"><?= $_SESSION["utilisateur"]["raison-commerciale"] ?></h6>
                <h6 style="color:skyblue"><?= $_SESSION["utilisateur"]["NIU"] ?></h6>
            <div class="sidebar-brand">
              <a href="déconnexion.php">Déconnecter</a></div></div>
            <li><a href="#home">Home</a></li>
            <!-- <li><a href="#about">About</a></li> -->
           
            <li class="dropdown">
            <a href="#personnel" class="dropdown-toggle"  data-toggle="dropdown">Personnel <span class="caret"></span></a>
          <ul class="dropdown-menu animated fadeInLeft" role="menu">
           <!-- <div class="dropdown-header">Dropdown heading</div> -->
           <li><a href="insérer un employé.php" class="dropdown-toggle">Insérer un employé</a></li>
<li><a href="liste des employés.php" class="reload-content">Modifier ou désactiver un employé</a></li>
<li><a href="payer.php" class="reload-content">Payer un employé</a></li>
           <!-- <li><a href="#supemployé">Supprimer un employé</a></li> -->
         
           </ul>
           </li>
           <li>
            <li class="dropdown">
            <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">Formulaires<span class="caret"></span></a>
          <ul class="dropdown-menu animated fadeInLeft" role="menu">
           <!-- <div class="dropdown-header">Dropdown heading</div> -->
           <!-- <li><a href="remplir un bulletin de paie.php">Remplir un bulletin de paie</a></li> -->
           <li><a href="editer un bulletin de paie.php " target="_blank">Editer un bulletin de paie</a></li>
           <li><a href="état de salaire.php" target="_blank">Générer un état de salaire</a></li>
           <li><a href="grille des taxes.php" target="_blank">Générer la grille des taxes</a></li>
           </ul>
           </li>
           <li>
            <li class="dropdown">
            <a href="#simulation" class="dropdown-toggle"  data-toggle="dropdown">Simuler un calcul <span class="caret"></span></a>
          <ul class="dropdown-menu animated fadeInLeft" role="menu">
           <!-- <div class="dropdown-header">Dropdown heading</div> -->
           <!-- <li><a href="simulation calcul acompte is.php" name="Acompte-IS">Acompte IS</a></li> -->
           <li><a href="simulation calcul irpp.php" name="IRPP">IRPP</a></li>
           <!-- <li><a href="simulation calcul cnps.php" name="CNPS">CNPS</a></li> -->
           <li><a href="remplir un bulletin de paie.php">Bulletin de Paie</a></li>
           </ul>
           </li>
           <li>
            <!-- <a href="#services">Services</a></li>
           <li><a href="#contact">Contact</a></li> -->
           
           </ul>
       </nav>
             <!-- /#sidebar-wrapper -->
     
             <!-- Page Content -->
             <div id="page-content-wrapper">
                 <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                     <span class="hamb-top"></span>
               <span class="hamb-middle"></span>
             <span class="hamb-bottom"></span>
                 </button>
                 <div class="main-content">
        <div class="row">
            <div class="content-app">
              <div class="notice-container">
                <p class="notice" id="animated-text">Tout enregistrement d'un bulletin de paie ne peut être modifié. Vérifiez si les informations sont correctes avant d'Enregistrer.</p>

              </div>
    </div>   
  </div>
</div>
               
             </div>
             <!-- /#page-content-wrapper -->
     
         </div>
         <!-- /#wrapper -->

         <div class="main">
         </div>

         <!-- <div class="foo">
           
         </div> -->
         
       
  









     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
    
    <script src="contenuApp.js"></script>
    <script src="liste employé.js"></script>
    <script src="formulaires.js"></script>
   <scrip t src="insérer un employé.js"></script>
    
 
    
   
    
</body>
</html>