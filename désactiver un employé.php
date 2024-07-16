<?php
session_start();
if (!isset($_SESSION["utilisateur"])) {
    // header('location: connexion.php');
    // exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="authentification.css">
</head>
<title>Désactiver un employé</title>
<body>

<!----------------------- Main Container -------------------------->
    
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    
    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-2 p-4 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->
  
     

    <!-------------------- ------ Right Box ---------------------------->
        <div class="insertion">
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                    <h2>Modifier les informations</h2>                  
                    </div>
                    <!-- Formulaire pour afficher les informations -->
<form method="POST" id="modification_information_employe" class="information_employe">
    <div class="input-group mb-3">
        <input type="text" name="nom" id="nom" class="form-control form-control-lg bg-light fs-6" placeholder="Noms" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : ''; ?>">
    </div>
     <!-- <div class="input-group mb-3">
        <input type="text" name="nom" id="id_class" class="form-control form-control-lg bg-light fs-6" placeholder="Noms" value="<?php echo isset($_GET['id_class']) ? $_GET['id_class'] : ''; ?>">
    </div>  -->
    <div class="input-group mb-3">
        <input type="text" name="prenom" id="prenom" class="form-control form-control-lg bg-light fs-6" placeholder="Prénoms" value="<?php echo isset($_GET['prenom']) ? $_GET['prenom'] : ''; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="date" name="date_naissance" class="form-control form-control-lg bg-light fs-6" value="<?php echo isset($_GET['date_naissance']) ? $_GET['date_naissance'] : ''; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="text" name="fonction" class="form-control form-control-lg bg-light fs-6" placeholder="Fonction /Poste occupé" value="<?php echo isset($_GET['fonction']) ? $_GET['fonction'] : ''; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="text" name="mle_assure" class="form-control form-control-lg bg-light fs-6" placeholder="Matricule Assure" value="<?= isset($_GET['matricule_assure']) ? $_GET['matricule_assure'] : ''; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="text" name="mle_interne" class="form-control form-control-lg bg-light fs-6" placeholder="Matricule interne" value="<?= isset($_GET['matricule_interne']) ? $_GET['matricule_interne'] : ''; ?>">
    </div>
    <div class="input-group mb-3">
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    </div>
    <div class="input-group mb-3">
        <button class="btn btn-lg btn-danger w-100 fs-6">Désactiver</button>
    </div>
    
</form>
                         
                        
                   </div>
                </div> 
         
               </div>
             </div>
        </div>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="liste employé.js"></script>
   
  

</body>
</html>