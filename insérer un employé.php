<?php

session_start();

require_once 'connexiondb.php';

if (!empty($_POST)) {
    if (isset($_POST["nom"], $_POST["prenom"], $_POST["dates"], $_POST["fonction"], $_POST["mle_assure"], $_POST["mle_interne"]) &&
        !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["dates"]) && !empty($_POST["fonction"]) && !empty($_POST["mle_assure"]) && !empty($_POST["mle_interne"])
    ) {
        $mle_interne = strip_tags($_POST["mle_interne"]);

        // Vérifier si le matricule assure existe déjà dans la base de données
        $check_query = $db->prepare("SELECT COUNT(*) AS count FROM employe WHERE `matricule interne` = :mle_interne");
        $check_query->bindValue(":mle_interne", $mle_interne);
        $check_query->execute();
        $result = $check_query->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            echo "Employé déjà enregistré(e) avec ce matricule interne.";
        } else {
            $nom = strip_tags($_POST["nom"]);
            $prenom = strip_tags($_POST["prenom"]);
            $fonction = strip_tags($_POST["fonction"]);
            $mle_interne = strip_tags($_POST["mle_interne"]);
            $mle_assure = strip_tags($_POST["mle_assure"]);
            $dates = strip_tags($_POST["dates"]);

            $sql = "INSERT INTO employe (nom, prenom, `date de naissance`, fonction, `matricule assure`, `matricule interne`) VALUES (:nom, :prenom, :dates, :fonction, :mle_assure, :mle_interne)";
         
            $query = $db->prepare($sql);
            $query->bindValue(":nom", $nom);
            $query->bindValue(":prenom", $prenom);
            $query->bindValue(":dates", $dates);
            $query->bindValue(":fonction", $fonction);
            $query->bindValue(":mle_assure", $mle_assure);
            $query->bindValue(":mle_interne", $mle_interne);

            if ($query->execute()) {
                header('Location: insérer un employé.php?success=1');
                exit;
            } else {
                echo "Une erreur s'est produite lors de l'enregistrement dans la base de données.";
            }
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
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
<title>Remplir les informations de l'employé</title>
<body>

<!----------------------- Main Container -------------------------->   
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    
    <!----------------------- Login Container -------------------------->
       <div class="row border rounded-2 p-4 bg-white shadow box-area">
    <!-------------------- ------ Right Box ---------------------------->
        <div class="insertion">

            <div class="col-md-6 right-box">
               <div class="row align-items-center">
                     <div class="header-text mb-4">
                         <h2>Remplir les informations</h2>    
                         <form action="" method="POST" id="insertionemployé">
                             </div>
                             <div class="input-group mb-3">
                                 <input type="text" name="nom" class="form-control form-control-lg bg-light fs-6" placeholder="Noms">
                             </div>
                             <div class="input-group mb-3">
                                 <input type="text" name="prenom"  class="form-control form-control-lg bg-light fs-6" placeholder="Prénoms">
                             </div>
                             <div class="input-group mb-3">
                                 <input type="date" name="dates" id="dateInput" class="form-control form-control-lg bg-light fs-6" placeholder="">
                             </div>
                             <div class="input-group mb-3">
                                 <input type="text" name="fonction" class="form-control form-control-lg bg-light fs-6" placeholder="Fonction /Poste occupé">
                             </div>
                             <div class="input-group mb-3">
                                 <input type="text" id="customInput" name="mle_assure" class="form-control form-control-lg bg-light fs-6" placeholder="Matricule Assure (xxxyyyyyd)">
                             </div>
                             <div class="input-group mb-3">
                                 <input type="text" name="mle_interne" class="form-control form-control-lg bg-light fs-6" placeholder="Matricule interne">
                             </div>
                             
                             
                             <!-- <div class="input-group mb-5 d-flex justify-content-between">  
                             </div> -->
                             <div class="input-group mb-3">
                                 <button class="btn btn-lg btn-primary w-100 fs-6">Enregistrer</button>
                             </div>
                            </div>
                         </form>     

            </div> 
     
           </div>
         </div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="insérer un employé.js"></script>
  

</body>
</html>