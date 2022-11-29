<?php 
     
     include('controle.php');
      include('connexion.php');
 
  
      $id_cmd = $_SESSION['id_cmd'];
      $id_cl = $_SESSION['id_cl'];
      $client = $_SESSION['client'];

       $det = $db->query("SELECT pr.id_prod,pr.description,fa.id,fa.id_cmd,fa.qte,fa.pu,fa.pt FROM produits AS pr INNER JOIN  facture_vent AS fa ON pr.id_prod = fa.id_prod WHERE fa.id_cmd=$id_cmd");

           $tt = $db->query("SELECT SUM(pt) FROM facture_vent WHERE id_cmd=$id_cmd");
           $rt = $tt->fetch();
           $total=$rt['0'];

           $_SESSION['montant']=$total; // creation de la session du montant total

          while($data=$det->fetch()){ ?>
                    <tr>
                      <td><?php echo $data['id_prod'] ?></td>
                      <td><?php echo $data['description'] ?></td>
                      <td><?php echo $data['qte'] ?></td>
                      <td><?php echo $data['pu'] ?></td>
                      <td><?php echo $data['pt'] ?></td>
                      <td>
                        <button type="button" name="id" id="<?php echo $data['id'] ?>" class="btn btn-primary btn-sm edit"><i class="fa fa-edit"></i></button>
                        <button type="button" id="<?php echo $data['id'] ?>" class="btn btn-danger btn-sm del"><i class="fa fa-trash"></i></button>  
                      </td>
                    </tr>  
                    <?php } ?>
                    <tr>
                        <td colspan="4" align="center"><b>Total</b></td>
                        <td><b><?= $total ?></b></td>
                    </tr>

                        <tr>
                            <td colspan="5" align="center">
                                <form method="post" action="valide_vente.php" >
                                    <input type="hidden" name="" id="">
                                    <input type="submit" name="" id="" value="Suivant" class="btn btn-success btn-sm">
                                </form>
                            </td>
                        </tr>

                    
                     
                    

