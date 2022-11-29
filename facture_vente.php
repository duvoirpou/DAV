<?PHP
    include('controle.php');
    require 'connexion.php';

    $req_vent = $db->query("SELECT ca.id_cmd,ca.mont_ch,ca.payer, ca.reste,date_format(ca.date_ca,'%d-%m-%Y') AS date_fr,cl.noms_cl FROM caisse AS ca INNER JOIN clients AS cl ON ca.id_cl=cl.id_cl WHERE ca.mont_ch!=0 ORDER BY ca.id_cmd DESC");
    $resul = $req_vent->fetchAll();

    $tvent = $db->query("SELECT SUM(payer) FROM caisse");
    $vent = $tvent->fetch();
    $total_vent = $vent['0'];



?>
<!doctype html>
<html>
<head>
    <title>gestock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body class="bg-info">
                <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%; margin-bottom: 7%;">                
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center mb-0">FACTURES VENTE</h6>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm table-striped" >
                                        <thead>
                                            <tr>
                                                <th w>N° Facture</th><th>client</th><th>Date</th><th>Montant</th><th>Payer</th><th>Reste</th><th width="85" style="text-align: center;">imprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($resul as $data) {?>
                                            <tr>
                                                <td><?php echo $data['id_cmd'] ?></td>
                                                <td><?php echo $data['noms_cl'] ?></td>
                                                <td><?php echo $data['date_fr'] ?></td>
                                                <td><?php echo number_format($data['mont_ch'],'0',',',' ').' Frs' ?></td>
                                                <td><?php echo number_format($data['payer'],'0',',',' ').' Frs' ?></td>
                                                <td><?php echo number_format($data['reste'],'0',',',' ').' Frs' ?></td>
                                                <td style="text-align: center;"><a target="_blank" href="print_vente.php?id=<?php echo $data['id_cmd'] ?>" class="btn btn-success btn-sm" ><i class="fa fa-print"></i></a></td>
                                                
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            <div class="text-center alert alert-info" style="font-weight: bold;">TOTAL: <?php echo number_format($total_vent,'0',',',' ').' Frs'; ?></div>

                    </div>
                </div>  
            </div>   
        </div>
        <?php include('footer.php') ?>

    </body>
</html>



        