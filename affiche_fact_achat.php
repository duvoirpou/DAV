<?php

    include ('connexion.php');

    $req_ach = $db->query("SELECT * FROM livraison");
    $rep = $req_ach->fetch();

    $rt = $db->query("SELECT SUM(montant) FROM livraison");
    $total = $rt->fetch();
    $total_ach = $total[0]; ?>


    <table class="table table-bordered table-sm table-striped" >
                        <thead>
                            <tr>
                                <th>N° Facture</th><th>Date</th><th>Montant</th><th>imprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rep as $tab) {?>
                            <tr>
                                <td><?php echo $tab['id_liv'] ?></td>
                                <td><?php echo $tab['date_liv'] ?></td>
                                <td><?php echo $tab['montant'] ?></td>
                                <td><a href="print_achat.php?id=<?php echo $tab['id_liv'] ?>" target="_blank" class="btn btn-success btn-sm" ><i class="fa fa-print"></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-center alert-info" style="font-weight: bold;">TOTAL: <?php echo $total_ach; ?></div>


?>