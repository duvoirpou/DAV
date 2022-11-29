<?php 
session_start();
require 'connexion.php';

$page = isset($_GET['p'])?$_GET['p']:'';
if($page=='add'){
    $produit = $_POST['produit'];
    $qte = $_POST['qte'];


    $sel_prod = $db->query("SELECT * FROM produits WHERE description='$produit' ")
    $result=$sel_prod->fetch();

    $id_prod = $result['id_prod'];
    $prix_prod = $result['prix'];
    $pt = $qte * $prix_prod;

    $req = $db->prepare("INSERT INTO facture (id_prod,qte,pu,pt) VALUES(?,?,?,?)");
        if($req->execute(array($id_prod,$qte,$prix,$pt))){
            echo "livraison ajoutée avec succès";
        }
        else{
            echo "Echec d'ajout de la livraison";
        }
    
    }else if($page=='edit') {
        $id_liv = $_POST['id_liv'];
        $date_liv = $_POST['date'];
        $req = $db->prepare("UPDATE livraison SET date_liv=? WHERE id_liv=? ");
            if($req->execute(array($date_liv,$id_liv))){

            echo "le client a été mis à jour avec succès";
        }
        else{
            echo "Echec de la mise à jour du client";
        }

}else if($page=='suppr') {
            $id_liv = $_GET['id_liv'];
            $req = $db->prepare("DELETE FROM livraison  WHERE id_liv=? ");
            if($req->execute(array($id_liv))){

            echo "la livraison a été supprimée avec succès";
        }
        else{

            echo "Echec de suppression du client";
        }
    
}else{

    $req = $db->query("SELECT id_liv, DATE_FORMAT(date_liv,'%d/%m/%Y') AS date_liv_fr FROM livraison  ORDER BY id_liv DESC");
    while($row = $req->fetch()){
        ?>
            <tr>
                <td><?php echo $row['id_liv']?></td>
                <td><?php echo $row['date_liv_fr']?></td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit-<?php echo $row['id_liv'] ?>" >Editer</button>

                        <div class="modal fade" id="edit-<?php echo $row['id_liv'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel-<?php echo $row['id_liv'] ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editLabel">Modification d'une livraison</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                 <form>
                                <div class="modal-body">
                                    <input type="hidden" id="<?php echo $row['id_liv'] ?>" value="<?php echo $row['id_liv'] ?>" >
                                  <div class="form-group">
                                    <label for="date" class="col-form-label">Date de livraison</label>
                                    <input  class="form-control" id="date-<?php echo $row['id_liv'] ?>" value="<?php echo $row['date_liv_fr'] ?>">
                                  </div>
                                </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" onclick="editLiv(<?php echo $row['id_liv']?>)" class="btn btn-primary">Modifier</button>
                                  </div>
                                </form>
                            </div>
                          </div>
                        </div>


                    <button onclick="supprLiv(<?php echo $row['id_liv']?>)" class="btn btn-danger">suppr</button>
                    <a href="detail.php?id=<?php echo $row['id_liv']?>&date=<?php echo $row['date_liv_fr'] ?>" class="btn btn-primary">livr.</a>
                    
    
                </td>
            </tr>

    <?php } 
    

}


?>