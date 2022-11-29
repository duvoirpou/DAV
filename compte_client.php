<?PHP
    

     
    
    $req_vent = $db->query("SELECT ca.*,cl.id_cl,cl.noms_cl FROM caisse AS ca INNER JOIN clients AS cl ON ca.id_cl=cl.id_cl WHERE ca.id_cl=$id_cl AND ca.reste!=0 ORDER BY ca.id_cmd DESC");
    
    $ligne = $req_vent->rowcount();

    $tvent = $db->query("SELECT SUM(reste) FROM caisse WHERE id_cl=$id_cl");
    $vent = $tvent->fetch();
    $total_dette = $vent['0'];

    
?>

            


            
            <div style="text-align: left;margin-bottom: 7px;">Nom du client : <?php echo $row['noms_cl'] ; ?></div>
                    
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead align="center">
                    <tr>
                        <th width="100">N° Facture</th>
                        <th width="100">Date</th>
                        <th width="100">Montant</th>
                        <th width="100">Avance</th>
                        <th width="100">Reste</th>
                    </tr>
                </thead>
                <tbody align="center">
                        <?php if($ligne==0) { ?>
                       <tr>
                           <td colspan="5"><?php echo "AUCUNE FACTURE A REGLER";   ?></td>
                       </tr>       

                     <?php   }
                        else
                        {    

                         while($resul=$req_vent->fetch()) { ?>
                            
                            <tr>
                                <td><?php echo $resul['id_cmd'] ; ?></td>
                                <td><?php echo $resul['date_ca'] ; ?></td>
                                <td><?php echo $resul['mont_ch'] ; ?></td>
                                <td><?php echo $resul['payer'] ; ?></td>
                                <td><?php echo $resul['reste'] ; ?></td>
                            </tr>
                            <?php } } ?>
                </tbody>
            </table>
            
        </div>         
    
        Nombre de facture : <?php echo $ligne; ?><br />
       <b> Total : <?php echo $total_dette; ?></b>
