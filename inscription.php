<?php
session_start();

require_once 'connexiondb.php';

if (!empty($_POST)) {
    if (isset($_POST["monemail"], $_POST["raison-commerciale"], $_POST["NIU"], $_POST["secteur-d'activite"], $_POST["mot-de-passe"], $_POST["confirmer-le-mot-de-passe"]) &&
        !empty($_POST["monemail"]) && !empty($_POST["raison-commerciale"]) && !empty($_POST["NIU"]) && !empty($_POST["secteur-d'activite"]) && !empty($_POST["mot-de-passe"]) && !empty($_POST["confirmer-le-mot-de-passe"])
    ) {
        $monemail = strip_tags($_POST["monemail"]);
        $raison_commerciale = strip_tags($_POST["raison-commerciale"]);
        $NIU = strip_tags($_POST["NIU"]);
        $secteur_activite = strip_tags($_POST["secteur-d'activite"]);

        if (!filter_var($monemail, FILTER_VALIDATE_EMAIL)) {
            echo "Veuillez insérer une adresse mail valide";
        } else {
            // Vérifier si le NIU existe déjà dans la base de données
            $check_query = $db->prepare("SELECT COUNT(*) AS count FROM utilisateur WHERE NIU = :NIU");
            $check_query->bindValue(":NIU", $NIU);
            $check_query->execute();
            $result = $check_query->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                echo "Compte existant avec ce NIU.";
            } else {
                $mot_de_passe = password_hash($_POST["mot-de-passe"], PASSWORD_ARGON2ID);

                $sql = "INSERT INTO utilisateur (email, `raison commerciale`, NIU, `secteur d'activité`, `mot de passe`) VALUES (:monemail, :raison_commerciale, :NIU, :secteur_activite, :mot_de_passe)";

                $query = $db->prepare($sql);
                $query->bindValue(":monemail", $monemail);
                $query->bindValue(":raison_commerciale", $raison_commerciale);
                $query->bindValue(":NIU", $NIU);
                $query->bindValue(":secteur_activite", $secteur_activite);
                $query->bindValue(":mot_de_passe", $mot_de_passe);
                $query->execute();

                echo "Inscription réussie";
                header('Location: inscription_reussie.php');
                exit;
            }
        }
    } else {
        echo "Tous les champs sont obligatoires";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta http-equiv="refresh" content="0;url=connexion.php"> -->
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

<title>Inscription</title>
</head>
<body>
    
<!----------------------- Main Container -------------------------->
    
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    
    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-2 p-4 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       

    <!-------------------- ------ Right Box ---------------------------->

    <!--- début du formulaire d'incription--->
    <form action="" method="POST">

       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Inscription</h2>                  
        </div>
            
         <div class="input-group mb-3">
                    <input type="text" 
                    name="monemail"
                    class="form-control form-control-lg bg-light fs-6" placeholder="Email">
        </div>
            
        <div class="input-group mb-3">
                    <input type="text" id="RaisonCommerciale" 
                    name="raison-commerciale"
                    class="form-control form-control-lg bg-light fs-6" placeholder="Raison Commerciale">
        </div>
            
        <div class="input-group mb-3">
                    <input type="text" id="monInputNIU"
                    name="NIU"
                    class="form-control form-control-lg bg-light fs-6" placeholder="Numero identifiant unique">
                
        </div>
        <div class="input-group mb-3">
                    <input type="text"  id="SecteurActivite"
                    name="secteur-d'activite"
                    class="form-control form-control-lg bg-light fs-6" placeholder="Secteur d'activité">
                
        </div>

        <div class="input-group mb-3">
          
                <input type="password"  id="motDepasse" class="form-control form-control-lg bg-light fs-6" placeholder="Mot de passe" name="mot-de-passe">
                <!-- <i class="fa fa-eye-slash" aria-hidden="true"></i> -->

            </div>
                
        </div>
            <p class="indicationMotdepasse">le mot de passe doit être au minimum 8 et au maximum 14 caractères. il doit contenir une seule lettre majuscule, @, quatre chiffres.</p>   
        <div class="input-group mb-3">
                <input type="password" name="confirmer-le-mot-de-passe" 
                id="confirmerLemotDepasse"
                class="form-control form-control-lg bg-light fs-6" placeholder="Confirmer le Mot de passe">
        </div>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">S'inscrire</button>
        </div>                           
</form>

  <!--- fin du formulaire d'incription--->
                
                <!-- <div class="input-group mb-5 d-flex justify-content-between">  
                </div> -->

    









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="inscription.js"></script>
</body>
</html>