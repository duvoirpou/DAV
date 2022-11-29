<?php
    session_start();
    include('connexion.php');
   
    //On récupère les données du formulaire
    $libelle = $_POST['libelle'];
    $mt_ch = $_POST['mt_ch'];
    $mt_let = $_POST['mt_let'];
    $benef = $_POST['benef'];
    $date_jour = date('Y-n-d');
    $mois_jour = date('n');
    $annee_jour = date('Y');
    $nom_user = $_SESSION['user'];
    $heure_jour = date('H:i:s');
    
    //On enregistre l'agent dans la table agent
    $agent = $db -> prepare("INSERT INTO depense(libelle, montant, mt_lettre, date_dep, heure_dep, mois_dep, annee_dep, benef, caissiere)
    VALUES(:libelle, :montant, :mt_lettre, :date_dep, :heure_dep, :mois_dep, :annee_dep, :benef, :caissiere)");
    $agent -> execute(array(
        ':libelle' => $libelle,
        ':montant' => $mt_ch,
        ':mt_lettre' => $mt_let,
        ':date_dep' => $date_jour,
        ':heure_dep' => $heure_jour,
        ':mois_dep' => $mois_jour,
        ':annee_dep' => $annee_jour,
        ':benef' => $benef,
        ':caissiere' => $nom_user
    ));

   // header('location: depense.php');
?>

<!doctype html>
<html>
<head>
    <title>LGC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="bg-info">
    <?php  include('menu.php'); ?>
    <div class="container"  style="margin-top: 7%;margin-bottom:7%;">        
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mb-0">DEPENSE</h5>
                    </div>
                    <div class="card-body" style="height: 300px;">
                        <center>Votre dépense a été enregistrée avec succes.<center>
                    </div>    
                </div>
            </div>   
        </div>
    </div>
        <?php include('footer.php') ?>
    </body>
</html>
