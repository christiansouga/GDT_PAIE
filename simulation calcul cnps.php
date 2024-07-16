<!-- Ce fichier a pour objectif de faire la simulaton de calcul pour les acomptes Is, l'IRPP, CNPS. il fournit le meme input pour les trois mais des appels de fonctions différentes pour chaque calcul.-->

<?php





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css">
   <link rel="stylesheet" href="simulation calcul.css" class="rel">
    <title>Formulaire de simulation</title>

    </head>
    <body>

    <div class="container">
  <h2>Simuler Le Calcul</h2>

  <div id="inputContainer">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="inputCount">Entrer le nombre de lignes supplémentaires à traiter :</label>
    <input type="number" id="inputCount" class="form-control" min="0" value="0">
  </div>

  <button id="btnAddInputs" class="btn btn-primary">Ajouter des champs</button>
  <button id="btnAddInputscalcul" class="btn btn-primary">Calculer</button>
</div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
    <script src="simulation calcul.js"></script>
   
   
    
</body>
</html>















