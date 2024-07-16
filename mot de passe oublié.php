<?php session_start();
if(!isset($_SESSION["utilisateur"])){
  header('location: connexion.php');
  exit;  
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

    <title>Mot de passe Oublié?</title>
</head>
<body>
    
    <!----------------------- Main Container -------------------------->
    
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    
    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-2 p-4 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       

    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Mot de passe Oublié?</h2>                  
                </div>
                <div class="input-group mb-3">
                    <input type="text" required class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                </div>
                <div class="input-group mb-3">
                    <input type="password" required class="form-control form-control-lg bg-light fs-6" placeholder="Mot de passe">
                </div>
                <div class="input-group mb-3">
                    <input type="password" required class="form-control form-control-lg bg-light fs-6" placeholder="Confirmer Mot de passe">
                
                </div>

                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Envoyer</button>
                </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <body>
        </body>
    </html>