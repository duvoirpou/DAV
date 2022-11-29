        <?php 
                    require 'connexion.php';
                    $message = '';
                    if(isset($_POST['produit'])){

                        $produit = $_POST['descript'];
                        $id_cat = $_POST['id_cat'];
                        $prix = $_POST['prix'];
                        $qte = $_POST['qte'];
                        $date = $_POST['date'];

                        if(empty($produit) || empty($id_cat) || empty($prix) || empty($qte) || empty($date)){

                          $message = 'veillez remplir tous les champs suivants !';  
                        }

                        else{

                                 $verif = $db->query("SELECT * FROM produits WHERE description='$produit'  AND id_cat=$id_cat AND prix=$prix ");

                            $controle = $verif->rowcount();

                            if($controle == 0)
                                {

                                var_dump($verif);

                                        $ins_art = $db ->prepare("INSERT INTO produits (description, id_cat, prix,) VALUES(?,?,?)");

                                    if($ins_art->execute(array($produit, $id_cat, $prix))){

                                        $message = 'produit ajoutée avec succès !';
                                    }
                            
                                }
                                else
                                {
                                    $message = 'le produit '.$produit.' existe déja dans la base !';
                                }    
                            }
                    }

                    if(isset($_POST['mod_prod'])){

                        $lib_prod = $_POST['lib_prod'];
                        $cat = $_POST['id_cat'];
                        $prix_prod = $_POST['prix_prod'];
                        $id_prod = $_SESSION['id_prod'];
                        
                        $udprod = $db->prepare("UPDATE produits SET description ='$lib_prod', id_cat = $cat, prix = $prix_prod WHERE id_prod=$id_prod");
                        
                            if($udprod->execute()){

                                $message = 'modification effectuée avec succès !';
                        }    
                    }

                    $aff_prod = $db->query("SELECT prod.id_prod, prod.description, prod.id_cat ,prod.prix, st.stock  FROM produits AS prod INNER JOIN stock AS st ON prod.id_prod = st.id_prod");
                    $reponse = $aff_prod -> fetchAll(PDO::FETCH_OBJ);
                ?>

        <div class="card mt-4 border-primary" style="color:rgb(7,7,7);">
            <div class="card-header bg-primary">
                <h5 class="text-center mb-0" style="color:rgb(254,253,253);">Produits</h5>
            </div>
            <div class="card-body">
                <?php if(!empty($message)): ?>
                        <div class="alert alert-success text-center">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?> 
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-sm">
                            <form method="post">
                                <tr>
                                    <td>Description</td>
                                    <td><input type="text" name="descript" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>categorie</td>
                                    <td><select type="text" name="id_cat" class="form-control">
                                        <option value=""></option>
                                        <?php
                                            $sel_cat = $db->query("SELECT * FROM categories");
                                              
                                            while($resultat = $sel_cat -> fetch()) { ?>  
                                            <option value="<?php echo $resultat['id_cat'] ; ?>"><?php echo $resultat['libelle_cat'] ; ?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prix unitaire</td>
                                    <td><input type="number" name="prix" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Quantité</td>
                                    <td><input type="number" name="qte" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td><input type="date" name="date" class="form-control"></td>
                                </tr>
                                <tr>    
                                    <td colspan="2" align="center"><button type="submit" name="produit" class="btn btn-primary"><i class="fa fa-plus"></i> ajouter</button></td>
                                </tr>    
                            </form>        
                        </table>       
                    </div>        
                    <br />   
                <div class="table-responsive"> 
                    <table class="table table-bordered table-sm  ">
                        <tr>
                            <thead class="bg-info" style="color: #fff; text-align: center;">
                                <th>Id_produit</th><th>Produits</th><th>Catégories</th><th>Prix unitaire</th><th>Stock</th><th>Modifier</th><th>Supprimer</th>
                            </thead>
                            
                        </tr>
                        <?php foreach($reponse as $table): ?>
                            <tbody style="text-align: center;">
                                <tr>
                                    <td><?= $table->id_prod ; ?></td>
                                    <td><?= $table->description ; ?></td>
                                    <td><?= $table->id_cat ; ?></td>
                                    <td><?= $table->prix ; ?></td>
                                    <td><?= $table->stock ; ?></td>
                                    <td><a href="index.php?page=modif_prod&id=<?php echo $table->id_prod ; ?>"><i class="fa fa-edit"></i></a></td>
                                    <td><a a onclick= "return(confirm('Etes-vous sûr de vouloir Supprimer  <?php echo $table->description ?> ?'));" href="index.php?page=suppr_prod&id=<?php echo $table->id_prod ; ?>"><i class="fa fa-trash text-danger"></i></a></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                        
                    </table>
                </div>
            </div>