<?php
require_once 'connexiondb.php'; 
$sql = "SELECT * FROM `employe`"; 
$query = $db -> prepare($sql); 
$query -> execute(); 
$employes = $query->fetchAll(PDO::FETCH_ASSOC); 

//
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des employés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="liste employé.css">
</head>
<body>
    
    <div class="filtrer">
        
    </div>
    
    <div class="liste-employé">
        <table class="tableau-style" id="employeeTable">
            <thead>
                <tr id="row_1">
                    <th>ID</th>
                    <th>Noms</th>
                    <th>Prénoms</th>
                    <th>Fonction</th>
                    <th>Mle Assure</th>
                    <th>Mle interne</th>
                    <th>Naissance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $employe):  ?>
                <tr id="employeeRow_<?= $employe['id_employe'] ?>">
                    <!-- <td><?= $employe['id_employe'] ?></td> -->
        <td><?= $employe['nom']?></td>
        <td><?= $employe['prenom']?></td>
        <td><?= $employe['fonction']?></td>
        <td><?= $employe['matricule assure'] ?></td>
        <td><?= $employe['matricule interne'] ?></td>
        <td><?= $employe['date de naissance'] ?></td>
        <td>

            <!--    
                <a href="modifier ou désactiver un employé.php?id=<?= $employe['id_employe'] ?>&nom=<?= $employe['nom'] ?>&prenom=<?= $employe['prenom'] ?>&fonction=<?= $employe['fonction'] ?>&matricule assure=<?= $employe['matricule assure'] ?>&matricule interne=<?= $employe['matricule interne'] ?>&date naissance=<?= $employe['date de naissance'] ?>"> 
             -->
            
            <a href="modifier un employé.php?id= <?= $employe['id_employe'] ?>&nom=<?= $employe['nom'] ?>&prenom=<?= $employe['prenom'] ?>&fonction=<?= $employe['fonction'] ?>&matricule assure=<?= $employe['matricule assure'] ?>&matricule interne=<?= $employe['matricule interne'] ?>&date naissance=<?= $employe['date de naissance'] ?>">
            </i>
            </a>
                    <a href=""><i class="fa fa-download" aria-hidden="true"></i></a>
            </a>
            
            <a href="désactiver un employé.php?id= <?= $employe['id_employe'] ?>&nom=<?= $employe['nom'] ?>&prenom=<?= $employe['prenom'] ?>&fonction=<?= $employe['fonction'] ?>&matricule assure=<?= $employe['matricule assure'] ?>&matricule interne=<?= $employe['matricule interne'] ?>&date naissance=<?= $employe['date de naissance'] ?>">

            </a>

            <a href="remplir un bulletin de paie.php?id=<?= $employe['id_employe'] ?>&nom=<?= $employe['nom'] . ' ' . $employe['prenom']?>&prenom=<?= $employe['prenom'] ?>&fonction=<?= $employe['fonction'] ?>&matricule assure=<?= $employe['matricule assure'] ?>&matricule interne=<?= $employe['matricule interne'] ?>"></a>    
    
    
        </td>
        </tr>
        <?php endforeach; ?>
        </tbody>    
        </table>
        </div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="liste employé.js"></script>

</body>

</html>