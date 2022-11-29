<?php
        require 'connexion.php';

     if(isset($_GET['id'])){

                        $id = $_GET['id'];
                        $_SESSION['id_art'] = $id;

                      $mod_prod = $db->query("SELECT cat.libelle_cat, art.id_art, art.libelle_art,art.prix  FROM categories AS cat INNER JOIN articles AS art ON cat.id_cat = art.id_cat WHERE art.id_art=$id");
                        $data = $mod_prod->fetch(); 

                        $sel_id = $db->query("SELECT id_cat FROM articles WHERE id_art=$id");
                        $rep = $sel_id->fetch();
                        $new_id = $rep['id_cat']; 

                        $det = $db->query("SELECT * FROM categories WHERE id_cat=$new_id");


                        
                     }

?>
        <div class="card mt-4 border-primary " style="color:rgb(7,7,7);">
            <div class="card-header bg-primary">
                <h5 class="text-center mb-0" style="color:rgb(254,253,253);">Modification d'un produit</h5>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <form method="post" action="index.php?page=prod">
                                <tr>
                                    <td>libelle</td>
                                    <td><input type="text" name="lib_prod" value="<?php echo $data['libelle_art'] ; ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>categorie</td>
                                    <td><select type="text" name="id_cat" class="form-control">

                                        <?php while($val = $det->fetch()){?>
                                        <option value="<?php echo $val['id_cat'] ; ?>"><?php echo $val['libelle_cat'] ; ?></option>
                                    <?php } ?>
                                        <?php
                                            $sel_cat = $db->query("SELECT * FROM categories");
                                              
                                            while($resultat = $sel_cat -> fetch()) { ?>  
                                            <option value="<?php echo $resultat['id_cat'] ; ?>"><?php echo $resultat['libelle_cat'] ; ?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>prix</td>
                                    <td><input type="number" name="prix_prod" value="<?php echo $data['prix'] ; ?>" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><button type="submit" name="mod_prod" class="btn btn-primary">modifier</button></td>
                                </tr>
                            </form>
                        </table>
                    </div>            
            </div>
        </div>


