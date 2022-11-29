<?php
    include('controle.php');
    include('connexion.php');

    //Onn récupère les données du formulaire modale vente
    $date_entrer = $_POST['date_recap'];

    $date_fr = strftime('%d/%m/%Y', strtotime($date_entrer));

    $req = $db->query("SELECT * FROM categories");

    $sr = $req->fetchAll(PDO::FETCH_OBJ);

    // $requette=$db->query("SELECT SUM(details_entree.pt) AS total_g FROM details_entree JOIN  entree ON details_entree.id_entree=entree.id WHERE entree.date_entree='$date_entrer' ");
    // $resultats = $requette->fetch(PDO::FETCH_OBJ);
    // $total_g = $resultats->total_g;

    $i=1;

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
                        <h5 class="text-center mb-0">TABLEAUX RECAPITULATIFS DES ENTREES ET SORTIES DU <?php echo $date_fr; ?></h5>
                    </div>
                    <div class="card-body">
                    <?php foreach($sr AS $data) { ?>

                        <div class="text-center font-weight-bold" style="margin-top:20px;margin-bottom:10px;"><?= $data->libelle_cat ?></div>

                    <?php

                      $tt=$db->query("SELECT  produits.description, SUM(production.qnte_ent) AS entree, SUM(production.qnte_vend) AS sortie FROM production JOIN categories ON production.id_cat=categories.id_cat JOIN produits ON produits.id_prod=production.id_pdt WHERE production.id_cat=$data->id_cat AND production.date_production='$date_entrer' GROUP BY produits.description");
                      $fd = $tt->fetchAll(PDO::FETCH_OBJ);
                      $ligne= $tt->rowCount();

                      $requet=$db->query("SELECT SUM(production.qnte_ent) AS total_entree, SUM(production.qnte_vend) AS totale_sortie FROM production JOIN categories ON production.id_cat=categories.id_cat JOIN produits ON produits.id_prod=production.id_pdt WHERE production.id_cat=$data->id_cat AND production.date_production='$date_entrer' ");
                      $resultat = $requet->fetch(PDO::FETCH_OBJ);

                      $total_entree = $resultat->total_entree;
                      $total_sortie = $resultat->totale_sortie;

                    ?>
                            <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped" id="vente">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width:5%;">N°</th>
                                        <th style="text-align:center;width:40%;">Produits</th>
                                        <th style="text-align:center;width:7%;">Entrée</th>
                                        <th style="text-align:center;width:7%;">Sortie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php   if($ligne==0){ ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Aucune donnée trouvée</td>
                                        </tr>

                                    <?php   }

                                        else
                                        {

                                        foreach( $fd AS $recap) {   ?>
                                    <tr>
                                        <td style="text-align:center; width:5%;"><?= $i++ ?></td>
                                        <td style="width:40%;"><?= $recap->description ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->entree ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->sortie ?></td>
                                    </tr>
                                    <?php }   } ?>
                                    <tr>
                                            <td colspan="2" style="text-align:center; font-weight:bold;">TOTAL</td>
                                            <td style="text-align:center; font-weight:bold;"><?php echo $total_entree; ?></td>
                                            <td style="text-align:center; font-weight:bold;"><?php echo $total_sortie; ?></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    <?php  } ?>



                    <br />

                 <div class="text-center"><a class="btn btn-success" href="print_rec_date.php?d=<?= $date_entrer ?>" target="_blank"><i class="fa fa-print"></i> Imprimer</a></div>

                    <br />

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