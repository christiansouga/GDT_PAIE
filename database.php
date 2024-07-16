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
    <title>DATABASE</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" placeholder="votre nom" name="nom_utilisateur">
        <br><br>
        <input type="text" placeholder="votre prenom" name="prenom_utilisateur">
    </form>
    <br>
    <button type="submit" name="button">Envoyer</button>
</body>
</html>

<?php 
$mysqlconnection = new PDO(
    'mysql:host=localhost;dbname=test',
    'root',
    'lechris2022'
);
if(!$mysqlconnection)
{
    echo'base de donnée introuvable!!!'; 
}

if (isset($_POST['nom_utilisateur']) AND isset($_POST['button'])AND isset($_POST['prenom_utilisateur']))
{
    $nom = $_POST['nom_utilisateur']; 
    $prenom = $_POST['prenom_utilisateur']; 
    echo "$nom"; 
   
} 














?>