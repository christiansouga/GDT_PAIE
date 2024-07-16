<?php
require_once 'connexiondb.php';

$sql = "SELECT * FROM `client`"; 
$query = $pdo -> prepare($sql); 
$query -> execute(); 
$clients = $query->fetchAll(PDO::FETCH_ASSOC);


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

<link rel="stylesheet" href="liste employé.css">

<title>Liste clients</title>
</head>
<body>




<table class="tableau-style" id="employeeTable">

    
                <thead>
                    
                        <tr>
                        <th>Noms</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        

                    </tr>
                </thead>
                <tbody>
            <?php foreach ($clients as $client):  ?>
            
             <tr>  
            <td><?= $client['NomComplet']?></td>
            <td><?= $client['telephone']?></td>
            <td><?= $client['adresseEmail']?></td>
            </tr>
            
            
                
            <?php endforeach; ?>
        </tbody>    
    </table>