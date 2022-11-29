<?php
    include('controle.php');
    include('connexion.php');

    //Onn récupère les données du formulaire modale vente
    $date_entrer = $_POST['date_recap'];
    $mois_entrer = $_POST['mois_recap'];
    $annee_entrer = $_POST['an_reacp'];

    if(empty($date_entrer) && empty($mois_entrer) && empty($annee_entrer))
        {
            echo"Erreur ! Entrer un critère de selection";
            exit();
        }
    if(empty($mois_entrer) && empty($annee_entrer))
        {
            //On fait le récapitulatif de vente de la date choisie
            $req = $db->query("SELECT details_recette.libelle, SUM(details_recette.qte) AS qte, details_recette.pu,
            SUM(details_recette.pt) AS pt, recette.date_recette FROM details_recette JOIN recette ON details_recette.id_recette=recette.id 
            WHERE recette.date_recette='$date_entrer' GROUP BY details_recette.libelle");
            
            $nb = $req->rowcount();

            $total_date = 0;
            $numero = 1;

        }
    elseif(empty($date_entrer) && empty($annee_entrer))
        {
            
            
            //On fait le récapitulatif du mois choisi
            echo"Récap suivant le mois entré.";
        }
    elseif(empty($date_entrer) && empty($mois_entrer))
        {
            //On fait le récapitulatif de l'année choisie
            echo"Récap suivant l'année entrée";
        }
?>

<!doctype html>
<html>
<head>
    <title>LG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body  class="bg-info">
    <?PHP include('menu.php') ?>
    <div class="container" style="margin-top: 7%; margin-bottom:7%">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mb-0">TABLEAUX RECAPITULATIFS DES VENTES DU <?php echo $date_entrer; ?></h5>
                    </div>
                    <div class="card-body">
                        <div >
                            <table class="table table-sm table-bordered table-striped" id="vente">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">N° Ordre</th>
                                        <th style="text-align:center">Produits</th>
                                        <th style="text-align:center">Quantité</th>
                                        <th style="text-align:center">Prix Unit</th>
                                        <th style="text-align:center">Prix Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($resultat = $req->fetch()) { ?>
                                        <tr>
                                            <td style="text-align:center"><?php echo$numero; ?></td>
                                            <td><?php echo$resultat['libelle'];?></td>
                                            <td style="text-align:center"><?php echo$resultat['qte'];?></td>
                                            <td style="text-align:center"><?php echo$resultat['pu'];?></td>
                                            <td style="text-align:center"><?php echo$resultat['pt'];?></td>
                                        </tr>
                                        <?php 
                                            $total_date = $total_date + $resultat['pt']; 
                                            $numero = $numero + 1;
                                        }?>
                                <tbody>
                            </table>
                                <center><b><?php echo"SOUS TOTAL 1 : ".$total_date; ?></b></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <?php include('footer.php') ?>
   <!-- <script src="assets/js/journ-stock.js"></script> -->
    <script src="assets/js/app.js"></script>
</body>
</html>