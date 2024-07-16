<?php
session_start();
if (!isset($_SESSION["utilisateur"])) {
    // header('location: connexion.php');
    // exit;
}

// Établir la connexion à la base de données
require_once 'connexiondb.php'; 
//initialisation des informations 
$nom = "";
$prenom = "";
$fonction = "";
$mle_interne = "";
$mle_assure = ""; 
$dates = ""; 
$id_employe = "" ; 

// Récupérer les données du formulaire via la méthode GET
if(isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['fonction']) && isset($_GET['mle_assure']) && isset($_GET['mle_interne']) && isset($_GET['dates']) && isset($_GET['id_employe'])){
    $nom = ($_GET["nom"]);
    $prenom = ($_GET["prenom"]);
    $fonction = ($_GET["fonction"]);
    $mle_interne = ($_GET["mle_interne"]);
    $mle_assure = ($_GET["mle_assure"]);
    $dates = ($_GET["dates"]);
    $id_employe = ($_GET["id_employe"]);
} else {
    $prenom = ""; 
}


// Préparer la requête SQL avec des paramètres
$sql = "UPDATE employe SET nom = :nom, prenom = :prenom, `date de naissance` = :dates, fonction = :fonction, `matricule assure` = :mle_assure, `matricule interne` = :mle_interne WHERE id_employe = :id_employe";


// Préparation de la requête
$query = $db->prepare($sql);

// Liaison des paramètres
$query->bindValue(':nom', $nom);
$query->bindValue(':prenom', $prenom);
$query->bindValue(':dates', $dates);
$query->bindValue(':fonction', $fonction);
$query->bindValue(':mle_assure', $mle_assure);
$query->bindValue(':mle_interne', $mle_interne);
$query->bindValue(':id_employe', $id_employe);
$query->execute(); 

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
<title>Modifier les information d'un employé</title>
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
        <input type="text" name="nom" id="noms" class="form-control form-control-lg bg-light fs-6" placeholder="Noms">
    </div>
     <!-- <div class="input-group mb-3">
        <input type="text" name="nom" id="id_class" class="form-control form-control-lg bg-light fs-6" placeholder="Noms" value="<?php  ?>">
    </div>  -->
    <div class="input-group mb-3">
        <input type="text" name="prenom" id="prenoms" class="form-control form-control-lg bg-light fs-6" placeholder="Prénoms" value="<?php echo $prenom; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="date" name="dates" class="form-control form-control-lg bg-light fs-6" value="<?php echo $dates; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="text" name="fonction" class="form-control form-control-lg bg-light fs-6" placeholder="Fonction /Poste occupé" value="<?php echo $fonction; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="text" name="mle_assure" class="form-control form-control-lg bg-light fs-6" placeholder="Matricule Assure"value="<?php echo $mle_assure; ?>">
    </div>
    <div class="input-group mb-3">
        <input type="text" name="mle_interne" class="form-control form-control-lg bg-light fs-6" placeholder="Matricule interne" value="<?php echo $mle_interne; ?>">
    </div>
    <div class="input-group mb-3">
    <input type="hidden" name="id"value="">
    </div>
    <div class="input-group mb-3">
        <button class="btn btn-lg btn-primary w-100 fs-6">Modifier</button>
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