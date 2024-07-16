<?php
require_once 'connexiondb.php'; 
if (!empty($_POST)){
    if (
        isset($_POST["nom"], $_POST["prenom"], $_POST["date_naissance"], $_POST["fonction"], $_POST["mle_assure"], $_POST["mle_interne"], $_POST["id"]) && 
        !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["date_naissance"]) && !empty($_POST["fonction"]) && !empty($_POST["mle_assure"]) && !empty($_POST["mle_interne"]) && !empty($_POST["id"])
    ) {
        $sql = "UPDATE travailleur SET nom = :nom, prenom = :prenom, fonction = :fonction, mle_assure = :mle_assure, mle_interne = :mle_interne, date_naissance = :date_naissance WHERE id = :id";
        $query = $db->prepare($sql);
        $query->execute(array(
            "nom" => $_POST['nom'],
            "prenom" => $_POST['prenom'],
            "fonction" => $_POST['fonction'],
            "mle_assure" => $_POST['mle_assure'],
            "mle_interne" => $_POST['mle_interne'],
            "date_naissance" => $_POST['date_naissance'],
            "id" => $_POST['id']
        ));

        echo "Modification réussie !";
    } else {
        echo "Veuillez remplir tous les champs";
    }
}
