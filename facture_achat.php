<?PHP
    session_start();
 
    if(!isset($_SESSION['user'])){
        header('location:index.php');
    } 

    require 'connexion.php';
    $req_ach = $db->query("SELECT id_liv,date_format(date_liv, '%d-%m-%Y') as date_fr, montant FROM livraison");
    $rep = $req_ach->fetchAll();

    $rt = $db->query("SELECT SUM(montant) FROM livraison");
    $total = $rt->fetch();
    $total_ach = $total['0'];

?>
<!doctype html>
<html>
<head>
    <title>gestock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body class="bg-info">
             <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center mb-0">FACTURES D'ACHAT</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped" id="fact" >
                                    <thead align="center">
                                        <tr>
                                            <th width="15%">N° Facture</th><th>Date</th><th>Montant</th><th width="15%">imprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php foreach ($rep as $tab) {?>
                                        <tr>
                                            <td><?php echo $tab['id_liv'] ?></td>
                                            <td><?php echo $tab['date_fr'] ?></td>
                                            <td><?php echo number_format($tab['montant'],'0',',',' ').' Frs' ?></td>
                                            <td><a href="print_achat.php?id=<?php echo $tab['id_liv'] ?>" target="_blank" class="btn btn-success btn-sm" ><i class="fa fa-print"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <div class="text-center alert alert-info" style="font-weight: bold;">TOTAL: <?php echo number_format($total_ach,'0',',',' ').' Frs'; ?></div>
                        </div>
                    </div>
                </div>
            </div>    

        </div>
         <?php include('footer.php') ?>
         <script src="assets/js/facture-achat.js"></script>
    </body>
</html>



        