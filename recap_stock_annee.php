<?php
    include('controle.php');
    include('connexion.php');

    //Onn récupère les données du formulaire modale vente
    $annee = $_POST['annee_recap'];


    $req = $db->query("SELECT * FROM categories");

    $sr = $req->fetchAll(PDO::FETCH_OBJ);


    $requette=$db->query("SELECT  SUM(stock) AS ts, SUM(entree)AS te, SUM(sortie) AS tsort, SUM(solde) AS tsolde FROM stock WHERE  an_st='$annee' ");
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
                        <h5 class="text-center mb-0">TABLEAUX RECAPITULATIFS DU STOCK DE L'ANNEE <?php echo $annee; ?></h5>
                    </div>
                    <div class="card-body">
                    <?php foreach($sr AS $data) { ?>

                        <div class="text-center font-weight-bold" style="margin-top:20px;margin-bottom:10px;"><?= $data->libelle_cat ?></div>

                    <?php  

                      $tt=$db->query("SELECT matiere_premiere.libelle, categories.libelle_cat, SUM(stock.stock) AS stock, SUM(stock.entree)AS entree, SUM(stock.sortie) AS sortie,SUM(stock.solde) AS solde FROM stock JOIN matiere_premiere ON stock.id_mat=matiere_premiere.id_mat JOIN categories ON stock.id_cat=categories.id_cat WHERE stock.id_cat=$data->id_cat AND stock.an_st='$annee' GROUP BY matiere_premiere.libelle");
                      $fd = $tt->fetchAll(PDO::FETCH_OBJ);
                      $ligne= $tt->rowCount();

                      $requet=$db->query("SELECT  SUM(stock) AS ts, SUM(entree)AS te, SUM(sortie) AS tsort, SUM(solde) AS tsolde FROM stock WHERE id_cat=$data->id_cat AND an_st='$annee' ");
                      $resultat = $requet->fetch(PDO::FETCH_OBJ);
                      

                    


                    ?>            
                       
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped" id="vente">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width:5%;">N°</th>
                                        <th style="text-align:center;width:40%;">Matière</th>
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
                                        <td style="width:40%;"><?= $recap->libelle ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->stock ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->entree ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->sortie ?></td>
                                        <td style="text-align:center;width:7%;"><?= $recap->solde ?></td>
                                        
                                    </tr>
                                    <?php }   } ?>
                                    <tr>
                                            <td colspan="2" style="text-align:center; font-weight:bold;">SOUS TOTAL</td>
                                            <td style="text-align:center; font-weight:bold;"><?= $resultat->ts ?></td>
                                            <td style="text-align:center; font-weight:bold;"><?= $resultat->te ?></td>
                                            <td style="text-align:center; font-weight:bold;"><?= $resultat->tsort ?></td>
                                            <td style="text-align:center; font-weight:bold;"><?= $resultat->tsolde ?></td>
                                    </tr>
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

                    <div class="text-center"><a class="btn btn-success" href="print_rec_mois.php?a=<?= $annee ?>" target="_blank"><i class="fa fa-print"></i> Imprimer</a></div>

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