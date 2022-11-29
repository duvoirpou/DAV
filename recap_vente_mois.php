<?php
    include('controle.php');
    include('connexion.php');

    //Onn récupère les données du formulaire modale vente
    $mois = $_POST['mois_recap'];


    $req = $db->query("SELECT * FROM categories");

    $sr = $req->fetchAll(PDO::FETCH_OBJ);


    $requette=$db->query("SELECT SUM(details_recette.pt) AS total_g FROM details_recette JOIN  recette ON details_recette.id_recette=recette.id WHERE recette.mois_recette='$mois' ");
    $resultats = $requette->fetch(PDO::FETCH_OBJ);
    $total_g = $resultats->total_g;

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
                        <h5 class="text-center mb-0">TABLEAUX RECAPITULATIFS DES VENTES DU MOIS DE <?php echo $mois; ?></h5>
                    </div>
                    <div class="card-body">
                    <?php foreach($sr AS $data) { ?>

                        <div class="text-center font-weight-bold" style="margin-top:20px;margin-bottom:10px;"><?= $data->libelle_cat ?></div>

                    <?php  

                      $tt=$db->query("SELECT  details_recette.libelle, SUM(details_recette.qte) AS qte, SUM(details_recette.pu) AS pu, SUM(details_recette.pt) AS pt FROM details_recette JOIN categories ON details_recette.id_cat=categories.id_cat JOIN recette ON details_recette.id_recette=recette.id WHERE details_recette.id_cat=$data->id_cat AND recette.mois_recette='$mois' GROUP BY details_recette.libelle");
                      $fd = $tt->fetchAll(PDO::FETCH_OBJ);
                      $ligne= $tt->rowCount();

                      $requet=$db->query("SELECT SUM(details_recette.pt) AS total FROM details_recette JOIN categories ON details_recette.id_cat=categories.id_cat JOIN recette ON details_recette.id_recette=recette.id WHERE details_recette.id_cat=$data->id_cat AND recette.mois_recette='$mois' ");
                      $resultat = $requet->fetch(PDO::FETCH_OBJ);
                      $total = $resultat->total;

                    


                    ?>            
                       
                            <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped" id="vente">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width:5%;">N°</th>
                                        <th style="text-align:center;width:40%;">Produits</th>
                                        <th style="text-align:center;width:7%;">Quantité</th>
                                        <th style="text-align:center;width:20%;">Prix Unit</th>
                                        <th style="text-align:center;width:20%;">Prix Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php   if($ligne==0){ ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Aucune donnée trouvée</td> 
                                        </tr>
                                               

                                    <?php   }

                                        else
                                        { 

                                        foreach( $fd AS $recap) {   ?>
                                    <tr>
                                        <td style="text-align:center; width:5%;"><?= $i++ ?></td>
                                        <td style="width:40%;"><?= $recap->libelle ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->qte ?></td>
                                        <td style="text-align:right; padding-right:20px;"><?= number_format($recap->pu,0,'',' ') ?> FCFA</td>
                                        <td style="text-align:right;  padding-right:20px;"><?= number_format($recap->pt,0,'',' ') ?> FCFA</td>
                                    </tr>
                                    <?php }   } ?>
                                    <tr>
                                            <td colspan="4" style="text-align:center; font-weight:bold;">SOUS TOTAL</td>
                                            <td style="text-align:right;  padding-right:20px;font-weight:bold;"><?= number_format($total,0,'',' ') ?> FCFA</td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>

                    <?php  } ?>

                    <div class="text-center font-weight-bold">TOTAL GENERAL : <?= number_format($total_g,0,'',' ') ?> FCFA</div>

                    <br />

                <!--    <div class="text-center"><a class="btn btn-success" href="print_rec_mois.php?d=<?= $mois ?>" target="_blank"><i class="fa fa-print"></i> Imprimer</a></div> -->

                    <br />                      
                        
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <?php include('footer.php') ?>
   
</body>
</html>