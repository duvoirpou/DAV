<?php
  session_start();

    include('connexion.php');

     $liv = $_SESSION['liv'];
     $date = $_SESSION['dt']; 

           $det = $db->query("SELECT pr.id_prod,pr.description,fa.id,fa.id_liv,fa.qte,fa.pu,fa.pt FROM produits AS pr INNER JOIN  facture_ach AS fa ON pr.id_prod = fa.id_prod WHERE fa.id_liv=$liv ORDER BY fa.id DESC");

           $tt = $db->query("SELECT SUM(pt) FROM facture_ach WHERE id_liv=$liv");
           $rt = $tt->fetch();
           $total=$rt['0'];

             while($data=$det->fetch()){ ?>
                        <tr>
                          <td><?php echo $data['id_prod'] ?></td>
                          <td><?php echo $data['description'] ?></td>
                          <td><?php echo $data['qte'] ?></td>
                          <td><?php echo $data['pu'] ?></td>
                          <td><?php echo $data['pt'] ?></td>
                          <td>
                            <button type="button" name="id" id="<?php echo $data['id'] ?>" class="btn btn-primary btn-sm edit"><i class="fa fa-edit"></i></button>
                            <button type="button" name="id" id="<?php echo $data['id'] ?>" class="btn btn-danger btn-sm del"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>  
                        <?php } ?> 
                        <tr>
                          <td colspan="4" align="center" style="font-weight: bold;">TOTAL</td><td style="color:#0b0376;font-weight: bold;"><?php echo $total ?></td>
                        </tr>
                        <tr>
                          <td colspan="6" align="center" style="padding: 15px">
                            <form method="post" action="valid_achat.php">
                              <input type="hidden" name="liv" value="<?php echo $liv ?>">
                              <input type="hidden" name="date" value="<?php echo $date ?>">
                              <input type="hidden" name="montant" value="<?php echo $total ?>">
                              <input type="submit" name="validation" value="Valider la facture" class="btn btn-success btn-sm">
                            </form>
                          </td>
                        </tr> 
                        
                        
                          
                        
