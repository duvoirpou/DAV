<?php
    include('controle.php');
    include('connexion.php');

    //Onn récupère les données du formulaire modale vente
    $date_entrer = $_POST['date_recap'];

    $date_fr = strftime('%d/%m/%Y', strtotime($date_entrer));

    $req = $db->query("SELECT * FROM categories");

    $sr = $req->fetchAll(PDO::FETCH_OBJ);


    $requette=$db->query("SELECT  SUM(qnte_init) AS ts, SUM(qnte_ent)AS te, SUM(qnte_vend) AS tsort, SUM(qnte_rest) AS tsolde FROM production WHERE  date_production='$date_entrer' ");
    $reponse = $requette->fetch(PDO::FETCH_OBJ);

    $i=1;


?>

<!doctype html>
<html>
<head>
    <title>LGC</title>
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
                        <h5 class="text-center mb-0">TABLEAUX RECAPITULATIFS DU STOCK DU <?php echo $date_fr; ?></h5>
                    </div>
                    <div class="card-body">
                    <?php foreach($sr AS $data) { ?>

                        <div class="text-center font-weight-bold" style="margin-top:20px;margin-bottom:10px;"><?= $data->libelle_cat ?></div>

                    <?php

                      $tt=$db->query("SELECT production.id, produits.description, categories.libelle_cat, production.qnte_init AS stock, SUM(production.qnte_ent)AS entree, SUM(production.qnte_vend) AS sortie,production.qnte_rest AS solde FROM production JOIN produits ON production.id_pdt=produits.id_prod JOIN categories ON production.id_cat=categories.id_cat WHERE production.date_production='$date_entrer' AND production.id_cat=$data->id_cat  ORDER BY production.id DESC LIMIT 1");
                      $fd = $tt->fetchAll(PDO::FETCH_OBJ);
                      $ligne= $tt->rowCount();







                    ?>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped" id="vente">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width:5%;">N°</th>
                                        <th style="text-align:center;width:40%;">Produits</th>
                                        <th style="text-align:center;width:15%;">Stock Initial</th>
                                        <th style="text-align:center;width:15%;">Entrée</th>
                                        <th style="text-align:center;width:15%;">Sortie</th>
                                        <th style="text-align:center;width:15%;">Solde</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php   if($ligne==0){ ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Aucune donnée trouvée</td>
                                        </tr>


                                    <?php   }

                                        else
                                        {

                                        foreach( $fd AS $recap) {   ?>
                                    <tr>
                                        <td style="text-align:center; width:5%;"><?= $i++ ?></td>
                                        <td style="width:40%;"><?= $recap->description ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->stock ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->entree ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->sortie ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->solde ?></td>

                                    </tr>
                                    <?php }   } ?>

                                </tbody>
                            </table>
                        </div>

                    <?php  } ?>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th rowspan="2" style="text-align:center;width:45%;padding:20px;">TOTAL GENERAL</th>
                                <th style="text-align:center;width:15%;">Stock Initial</th>
                                <th style="text-align:center;width:15%;">Entrée</th>
                                <th style="text-align:center;width:15%;">Sortie</th>
                                <th style="text-align:center;width:15%;">Solde</th>
                            </tr>
                            <tr>
                                <th style="text-align:center;width:15%;"><?= $reponse->ts ?></th>
                                <th style="text-align:center;width:15%;"><?= $reponse->te ?></th>
                                <th style="text-align:center;width:15%;"><?= $reponse->tsort ?></th>
                                <th style="text-align:center;width:15%;"><?= $reponse->tsolde ?></th>
                            </tr>
                        </table>
                    </div>

                    <br />

                    <div class="text-center"><a class="btn btn-success" href="print_stock_date.php?d=<?= $date_entrer ?>" target="_blank"><i class="fa fa-print"></i> Imprimer</a></div>

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