<?php
// session_start();
// if(isset($_SESSION["utilisateur"])){
//   header('location: connexion.php');
//   exit;  
// }
//recharge du formulaire et vérification d'existance des champs et de leur remplissage

if(!empty($_POST)){
    if(isset($_POST["email"], $_POST["pass"]) && !empty($_POST["email"]) && !empty
    ($_POST["pass"]))
    {
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            echo"adresse mail incorrecte"; 
        }
        {
            require_once 'connexiondb.php'; 
    
            $sql = "SELECT * FROM `utilisateur` WHERE `email` = :email"; 
            $query = $db->prepare($sql); 
            $query->bindValue(":email", $_POST["email"]); 
            $query->execute(); 
            $utilisateur = $query->fetch(); 
            // var_dump($utilisateur);die; 
            if(!$utilisateur){
                echo"l'utilisateur et ou le mot de passe est incorrect"; 
            }
            //vérification du mot de passe 

            if(!password_verify($_POST["pass"], $utilisateur["mot de passe"])){
                die("l'utilisateur et ou le mot de passe est incorrect"); 
            }
        
        //session php 
        session_start(); 
        // var_dump($_SESSION); 

        $_SESSION["utilisateur"] = [
            "email" => $utilisateur["email"], 
            "NIU" => $utilisateur["NIU"], 
            "raison-commerciale" => $utilisateur["raison commerciale"]
        ];

        header('location: contenuApp.php'); 
        exit; 
        
        }
    

    }
    else{
        echo"formulaire incomplet"; 
    }
}
  

    



?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200&family=Nunito:ital,wght@0,300;1,200&family=Quicksand:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200&family=Nunito:ital,wght@0,300;1,200&family=Quicksand:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<link rel="stylesheet" href="authentification.css">

    <title>GESTION DE LA PAIE</title>
</head>
<body>
    
        <title>connexion</title>
        
            <!----------------------- Main Container -------------------------->
        
             <div class="container d-flex justify-content-center align-items-center min-vh-100">
        
            <!----------------------- Login Container -------------------------->
        
               <div class="row border rounded-5 p-3 bg-white shadow box-area">
        
            <!--------------------------- Left Box ----------------------------->
        
               <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #cecece;">
                   <div class="featured-image mb-3" class="image1">
                    <img src="Ressource/3d cartoon style bunch of keys icon on white background.jpg" class="img-fluid" style="width: 250px;">
                   </div>
                   <p class="text-white fs-2" style="font-family: 'Nunito Sans: 600;"></p>
                   <p class="text-white text-wrap text-center"
                   style="width: 17rem;font-family: 'nunito sans' ">Une Expérience Unique!</p>
               </div> 
        
            <!-------------------- ------ Right Box ---------------------------->
                
               <div class="col-md-6 right-box">
                  <div class="row align-items-center">
                        <div class="header-text mb-4">
                             <h2>Bienvenue sur GEPPT</h2>
                             
                        </div>
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" name="pass" class="form-control form-control-lg bg-light fs-6" placeholder="Mot de passe">
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Se souvenir de moi</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="mot de passe oublié.php" class="text-decoration-none">Mot de passe Oublié?</a></small>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Se connecter</button>
                        </div>
                    </form> 

                        <div class="input-group mb-3">
                           <button class="btn btn-lg btn-light w-100 fs-6"><img src="Ressource/google-logo-9808.png" style="width:20px" class="me-2"><small>Se connecter avec Google</small></button> 
                        </div>
                       
                        <div class="row">
                            <small>Pas de compte? <a class="text-decoration-none" href="inscription.php">S'inscrire</a></small>
                        </div>

                  </div>
               </div> 
        
              </div>
            </div>
        
    
    
    
    
           
            
            
            
            
            
            
            
            <br><br><br><br>
            
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
            <script src="authentification.js"></script>
    
    </body>
    </html>
    