<?php
session_start();
if (!isset($_SESSION["utilisateur"])) {
  header('location: connexion.php');
  exit;
} 
//tableau servant de détermination pour la redevance audio visuelle (RAV)
$valeur = ''; 
$rav = ''; 
$net = '';

$tableau_rav = [
    0 => 0,
    1 => 750,
    2 => 1950,
    3 => 3250,
    4 => 4550,
    5 => 5850,
    6 => 7150,
    7 => 8450,
    8 => 9750,
    9 => 11050,
    10 => 12350,
    11 => 13000
];


//Initialisation des informations de l'employé
$nom = '';
$prenom = '';
$fonction = '';
$matricule_assure = ''; 
$matricule_interne = '';
//transmission des informations par l'url
if(isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['fonction']) && isset($_GET['matricule_assure']) && isset($_GET['matricule_interne'])){
    $nom = $_GET['nom']; 
    $fonction = $_GET['fonction']; 
    $matricule_assure = $_GET['matricule_assure']; 
    $matricule_interne = $_GET['matricule_interne']; 
   
}
else {
    null; 

}
var_dump($nom); 

//fonction déterminant le salaire annuel déductible à l'irpp 
function calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) {

    if($salaire_base > 750000){
        $salaire_deductible =((($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12) - 31500 - (($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12*0.3))- 500000;
        return $salaire_deductible;

    }else{
        $salaire_deductible =((($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12) - (($salaire_base + $prime_rendement + $prime_transport + $indem_representation) * 12 *0.042) - (($salaire_base + $prime_rendement + $prime_embauche + $prime_transport + $indem_representation + $primes_extra) * 12*0.3))- 500000;
        return $salaire_deductible;  
    }
}

// $salaire_deductible_annuel = calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) - 500000;  

 // Initialisation de $snt

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['previsualiser'])) {
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
//valeur de retour du default dans le switch 
$salaireNull = 0;

$base_irpp = calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra); 

//détermination des taxes et calculs de l'irpp en fonction des tranches de salaire annuelles 
$salaire_brut = $salaire_base + $prime_embauche + $prime_rendement + $prime_transport +$indem_representation + $primes_extra; //calcul du salaire brut 
$salaire_brut_annuel = ($salaire_brut)*12;

// calcul du credit foncier part salariale et part patronale 
$cf_part_salariale = ($salaire_brut) * 0.01;  
$cf_part_patronale = ($salaire_brut) * 0.015; 

//calcul part salariale de la cnps taux 4.2%
$salaire_imposable_cnps = ($salaire_base + $prime_rendement + $prime_transport + $indem_representation); 
$cnps_part_salariale = $salaire_imposable_cnps*0.042; 
$cnps_part_patronale = $salaire_imposable_cnps*0.042; 



//calcul irpp mensuelle pour un taux de 10%
$irpp_compris_entre_0_2000000 = (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.1)/12; 

//calcul irpp mensuelle pour un taux de 15%
$irpp_compris_entre_2000000_3000000 =  (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.15)/12;        

//calcul irpp mensuelle pour un taux de 25%
$irpp_compris_entre_3000000_5000000 = (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.25)/12;         

// calcul irpp pour un taux de 35% 
$irpp_plus_de_5000000 = (calculerSalaireNet($salaire_base, $prime_rendement, $prime_embauche, $prime_transport, $indem_representation, $primes_extra) * 0.35)/12;     

//irpp global 
switch(true){
    case($base_irpp > 0 && $base_irpp < 2000000): 
    echo $valeur = $irpp_compris_entre_0_2000000; 
    break; 

    case ($base_irpp > 200000 && $base_irpp < 3000000):
        echo $valeur = $irpp_compris_entre_2000000_3000000; 
        break; 

    case($base_irpp > 300000 && $base_irpp < 5000000): 
        echo $valeur = $irpp_compris_entre_3000000_5000000; 
        break; 
    
    case($base_irpp > 5000000): 
        echo $valeur = $irpp_plus_de_5000000; 
        break; 
    default: 
    echo $salaireNull; 
    }


//calcul du net à percevoir par trancche. il faut noter que ici ils sonts considérés intermédiaire ils permettront de déterminer le net à percevoir final 
    $salairenet1 = $salaire_brut - $cf_part_salariale - $cnps_part_salariale - $irpp_compris_entre_0_2000000; 

    $salairenet2 = $salaire_brut - $cf_part_salariale - $cnps_part_salariale - $irpp_compris_entre_2000000_3000000; 

    $salairenet3 = $salaire_brut - $cf_part_salariale - $cnps_part_salariale - $irpp_compris_entre_3000000_5000000;

    $salairenet4 = $salaire_brut - $cf_part_salariale - $cnps_part_salariale - $irpp_plus_de_5000000;
    //CALCUL DE LA REDEVANCE AUDIO VISUELLE 
    switch(true) {
        case ($salaire_brut < 50000):
            echo $rav = $tableau_rav[0];
            break;
        case ($salaire_brut >= 50000 && $salaire_brut < 100000):
            echo $rav = $tableau_rav[1];
            break;
        case ($salaire_brut >= 100000 && $salaire_brut < 200000):
            echo $rav = $tableau_rav[2];
            break;
        case ($salaire_brut >= 200000 && $salaire_brut < 300000):
            echo $rav = $tableau_rav[3];
            break;
        case ($salaire_brut >= 300000 && $salaire_brut < 400000):
            echo $rav = $tableau_rav[4];
            break;
        case ($salaire_brut >= 400000 && $salaire_brut < 500000):
            echo $rav = $tableau_rav[5];
            break;
        case ($salaire_brut >= 500000 && $salaire_brut < 600000):
            echo $rav = $tableau_rav[6];
            break;
        case ($salaire_brut >= 600000 && $salaire_brut < 700000):
            echo $rav = $tableau_rav[7];
            break;
        case ($salaire_brut >= 700000 && $salaire_brut < 800000):
            echo $rav = $tableau_rav[8];
            break;
        case ($salaire_brut >= 800000 && $salaire_brut < 900000):
            echo $rav = $tableau_rav[9];
            break;
        case ($salaire_brut >= 900000 && $salaire_brut < 1000000):
            echo $rav = $tableau_rav[10];
            break;
        case ($salaire_brut >= 1000000):
            echo $rav = $tableau_rav[11];
            break;
        default:
            echo $salaireNull;
            break;
        }

    //CALCUL DU SALAIRE NET
    switch(true) {
                         
        case ($salaire_brut > 0 && $salaire_brut < 50000):
            echo $net = $salairenet1;
            break;
        case ($salaire_brut >= 50000 && $salaire_brut < 100000):
            echo $net = $salairenet1 - $tableau_rav[1];
            break;
        case ($salaire_brut >= 100000 && $salaire_brut < 200000):
            echo $net = $salairenet1 - $tableau_rav[2];
            break;
        case ($salaire_brut >= 200000 && $salaire_brut < 300000):
            echo $net = $salairenet1 - $tableau_rav[3];
            break;
        case ($salaire_brut >= 300000 && $salaire_brut < 400000):
            echo $net = $salairenet2 - $tableau_rav[4];
            break;
        case ($salaire_brut >= 400000 && $salaire_brut < 500000):
            echo $net = $salairenet2 - $tableau_rav[5];
            break;
        case ($salaire_brut >= 500000 && $salaire_brut < 600000):
            echo $net = $salairenet3 - $tableau_rav[6];
            break;
        case ($salaire_brut >= 600000 && $salaire_brut < 700000):
            echo $net = $salairenet3 - $tableau_rav[7];
            break;
        case ($salaire_brut >= 700000 && $salaire_brut < 800000):
            echo $net = $salairenet4 - $tableau_rav[8];
            break;
        case ($salaire_brut >= 800000 && $salaire_brut < 900000):
            echo $net = $salairenet4 - $tableau_rav[9];
            break;
        case ($salaire_brut >= 900000 && $salaire_brut < 1000000):
            echo $net = $salairenet4 - $tableau_rav[10];
            break;
        case ($salaire_brut >= 1000000):
            echo $net = $salairenet4 - $tableau_rav[11];
            break;
        default :
            echo $salaireNull;
            break;
    }   


    //GENERATION DU BULLETIN DE PAIE 
    
require 'phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;


$excelFile = 'Ressource/bulletin de paie.xlsx';
$spreadsheet = IOFactory::load($excelFile);

$sheet = $spreadsheet->getActiveSheet();
$sheet->mergeCells('B6:C6:D6');
$sheet->setCellValue('B6', $nom); 
$sheet->mergeCells('B7:C7:D7');
$sheet->setCellValue('B7', $prenom);
$sheet->mergeCells('B8:C8:D8');
$sheet->setCellValue('B8', $fonction);
$sheet->mergeCells('B10:C10');
$sheet->setCellValue('B10', $matricule_assure);
$dateHeure = date('Y-m-d H:i:s');
$sheet->mergeCells('A43:B43:C43:D43:E43:F43:G43:H43');
$sheet->setCellValue('A43', "Document généré  : $dateHeure");
// $sheet->setCellValue('H8', $dateHeure);
// $sheet->setCellValue('G12', $dates);
$sheet->mergeCells('B10:C10');
$sheet->setCellValue('B11', $matricule_interne);
$sheet->setCellValue('E15', $salaire_base);
$sheet->setCellValue('E17', $prime_transport);
$sheet->setCellValue('E19', $prime_embauche);
$sheet->setCellValue('E21', $prime_rendement);
$sheet->setCellValue('E18', $indem_representation);
$sheet->setCellValue('E20', $primes_extra);
$sheet->setCellValue('E22', $salaire_brut);
$sheet->setCellValue('E23', $salaire_imposable_cnps);
$sheet->setCellValue('F29', $valeur);
$sheet->setCellValue('G31', $cf_part_salariale);
$sheet->setCellValue('F33', $rav);
$sheet->mergeCells('F25:G25');
$sheet->setCellValue('F25', $cnps_part_salariale);
$sheet->setCellValue('H25', $cnps_part_patronale);
$sheet->mergeCells('I37:J37');
$sheet->setCellValue('I37', $net);
// $sheet->setCellValue('', $);
// $sheet->setCellValue('', $);

$writer = IOFactory::createWriter($spreadsheet, 'Mpdf');

// Enregistrer le document au format PDF
$pdfFile = 'bulletin de paie.pdf';
$writer->save($pdfFile);
// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
// $writer->save('Ressource/bulletin de paie modifie.xlsx');

// header('Content-Type: application/pdf');
// header('Content-Disposition: attachment;filename="'.$pdfFile.'"');
// readfile($pdfFile);
$dateHeure = date('Y-m-d_H-i-s');

// echo '<a href="bulletin de paie.pdf" download>Télécharger le document Excel modifié</a>';
echo '<a href="' . $pdfFile . '" download>Télécharger le bulletin de paie au format PDF</a>';

?>
    
   
    
    
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>remplir un bulletin de paie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="remplir un bulletin de paie.css">
</head>
<body>
    
  <!-- formulaire permettant de remplir un bulletin de paie   -->
  
  <div class="filtrer">
      </div>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="liste-employé">
          <div class="period">
              <label for="nber">Date d'Emission</label>
              <input required name="dates" type="date" id="nber">
              
            </div>
        <table class="tableau-style">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th>Noms et prénoms</th>
                    <th>Informations</th>
                    <th>Montants</th>
                    <th>Part salariale</th>
                    <th>Part patronale</th>
                    <th>Observations</th>
                   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class=""><input type="number" value=""></td>
                    <td><input type="text" placeholder="" name="nom" value="<?php echo $nom; ?>"></td>
                    <td><input type="text" placeholder="Fonction/ Poste" value="<?php echo $fonction; ?>"></td>
                    <td class="four-cell"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>
                   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td><input type="number" placeholder="Mle assure" name="" value="<?php echo $matricule_assure; ?>"></td>
                    <td class="four-cell"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>
                   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td><input type="text" placeholder="Mle interne" value="<?php echo $matricule_interne; ?>"></td>
                    <td class="four-cell"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>
                   
                        </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td class="entete">Eléments salaires</td>
                    <td class=""></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>
                   
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>Salaire de Base</td>
                    <td><input name="salaire_base" type="number" value="<?php echo  $salaire_base; ?>"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>  
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>Prime de rendement</td>
                    <td><input name="prime_rendement" type="number"value="<?php echo $prime_rendement; ?>" ></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>Prime d'embauche</td>
                    <td><input name="prime_embauche" type="number" value="<?php echo $prime_embauche; ?>"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>Prime de transport</td>
                    <td><input name="prime_transport" type="number"  value="<?php echo $prime_transport; ?>"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>    
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>Indem représentation</td>
                    <td><input name="indem_representation" type="number" value="<?php echo $indem_representation; ?>"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>Autres primes</td>
                    <td><input name="primes_extra" type="number" value="<?php echo $primes_extra; ?>"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td class="entete">Taxes</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td class="entete">Salaire Brut</td>
                    <td style="font-weight: bold;">
                    <?php echo $salaire_brut ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>   
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>IRPP</td>
                    <td class="td-contenu" style="font-weight: bold;">
                        <?php 
                        //nous affichons l'irpp en testant le salaire de base
                       echo $valeur; 
                        ?>

                    </td>
                    
                    <td class="td-contenu"></td>
                    <td></td>
                    <td></td>
                    <td class="border-hidden"></td>
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>CF</td>
                    <td class="td-contenu"></td>
                    <td style="font-weight: bold;"><?php echo $cf_part_salariale ?></td>
                    <td style="font-weight: bold;"><?php echo $cf_part_patronale ?></td>
                    <td class="border-hidden"></td>  
                </tr>
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>CNPS</td>
                    <td class="td-contenu"></td>
                    <td style="font-weight: bold;"><?php echo $cnps_part_salariale ?></td>
                    <td style="font-weight: bold;"><?php echo $cnps_part_patronale ?></td>
                    <td class="last-cell"></td>   
                </tr> 
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td>RAV</td>
                    <td class="td-contenu" style="font-weight: bold;">
                    <?php
                     echo $rav; 

                    ?>
                   </td>
                    <td></td>
                    <td></td>
                    <td class="last-cell"></td>  
                </tr> 
                <tr>
                    <td class="caché"></td>
                    <td class="caché"></td>
                    <td class="entete">Net à percevoir</td>
                    <td class="salaire-brut" style="font-weight: bold;">
                    <?php  
                   echo $net; 
                    ?>
                </td>
                    <td >
                    </td>
                    <td></td>
                    <td class="net-percevoir"></td> 
                </tr>
            </tbody>
        </table>
        <!-- bouton d'envoie pour l'enregistrement du formulaire -->
        <div class="button">
            <button type="submit" name="previsualiser" class="btn btn-primary">Prévisualiser</button>
            <button class="btn btn-primary">Enregistrer</button>
        </div> 
</form>



<br><br><br><br><br><br>
    </div>

            
 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

</body>

</html>