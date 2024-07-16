<!-- Ce fichier a pour objectif de faire la simulaton de calcul pour les acomptes Is, l'IRPP, CNPS. il fournit le meme input pour les trois mais des appels de fonctions différentes pour chaque calcul.-->

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['calculer'])) {
    $salaire_base = isset($_POST['salaire_base']) ? floatval($_POST['salaire_base']) : 0;
    $prime_rendement = isset($_POST['prime_rendement']) ? floatval($_POST['prime_rendement']) : 0;
    $prime_embauche = isset($_POST['prime_embauche']) ? floatval($_POST['prime_embauche']) : 0;
    $prime_transport = isset($_POST['prime_transport']) ? floatval($_POST['prime_transport']) : 0;
    $indem_representation = isset($_POST['indem_representation']) ? floatval($_POST['indem_representation']) : 0;
    $primes_extra = isset($_POST['primes_extra']) ? floatval($_POST['primes_extra']) : 0;
} 
else {
    // Réinitialiser les valeurs à zéro si le formulaire n'a pas été soumis
    $salaire_base = $_POST['$salaire_base'] = 0;
    $prime_rendement = $_POST['$prime_rendement'] = 0;
    $prime_embauche = $_POST['$prime_embauche'] = 0;
    $prime_transport = $_POST['$prime_transport'] = 0;
    $indem_representation = $_POST['$indem_representation'] = 0;
    $primes_extra =  $_POST['$primes_extra'] = 0;
}


function calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) {

    if($salaire_base > 750000){
        $salaire_deductible =((($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12) - 31500 - (($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12*0.3))- 500000;
        return $salaire_deductible;

    }else{
        $salaire_deductible =((($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12) - (($salaire_base + $prime_rendement + $prime_transport + $indem_representation) * 12 *0.042) - (($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12*0.3))- 500000;
        return $salaire_deductible;  
    }
}
$base_irpp = calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra); 

$salaire_brut = $salaire_base + $prime_embauche + $prime_rendement + $prime_transport +$indem_representation + $primes_extra;

//calcul irpp mensuelle pour un taux de 10%
$irpp_compris_entre_0_2000000 = (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.1)/12; 

//calcul irpp mensuelle pour un taux de 15%
$irpp_compris_entre_2000000_3000000 =  (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.15)/12;        

//calcul irpp mensuelle pour un taux de 25%
$irpp_compris_entre_3000000_5000000 = (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.25)/12;         

// calcul irpp pour un taux de 35% 
$irpp_plus_de_5000000 = (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.35)/12;                       
$salaireNull = 0;  
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

        
    <form method="POST" class="irpp" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="container">
  <h2>Simuler Le Calcul de l'IRPP</h2>
  <div id="inputContainer">
    <div class="form-group">
      <input type="number" class="form-control" name="salaire_base" placeholder="Salaire de base">
    </div>
    <div class="form-group">
      <input type="number" class="form-control" name="prime_embauche" placeholder="prime d'embauche">
    </div>
    <div class="form-group">
      <input type="number" class="form-control" name="prime_rendement" placeholder="prime de rendement">
    </div>
    <div class="form-group">
      <input type="number" class="form-control" name="prime_transport" placeholder="prime de transport">
    </div>
    <div class="form-group">
      <input type="number" class="form-control" name="indem_representation" placeholder="indemnité de représentation">
    </div>
    <div class="form-group">
      <input type="number" class="form-control" name="primes_extra" placeholder="autres primes">
    </div>
    <div class="form-group custom-div" style="color: green; font-weight: bold; text-align: center;" >
        <?php
    switch(true){
                        case($base_irpp > 0 && $base_irpp < 2000000): 
                        echo $irpp_compris_entre_0_2000000; 
                        break; 

                        case ($base_irpp > 200000 && $base_irpp < 3000000):
                            echo $irpp_compris_entre_2000000_3000000; 
                            break; 

                        case($base_irpp > 300000 && $base_irpp < 5000000): 
                            echo $irpp_compris_entre_3000000_5000000; 
                            break; 
                        
                        case($base_irpp > 5000000): 
                            echo $irpp_plus_de_5000000; 
                            break; 
                        default: 
                        echo $salaireNull; 
                        }
                        ?>
    </div>
      <button id="btnAddInputscalcul" name="calculer" class="btn btn-primary">Calculer</button>
    </div>
</form>
<br><br><br><br><br><br>



     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
    <!-- <script src="simulation calcul.js"></script> -->
   
   
    
</body>
</html>















