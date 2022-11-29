<?PHP
    include('controle.php');
    include('connexion.php');

    $tab_mois = array('','janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
	$date_jour = date("d").' '.$tab_mois[date("n")].' '.date("Y");

?>
<!doctype html>
<html>
<head>
    <title>LG</title>
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
                        <h5 class="text-center mb-0">JOURNAL DE PRODUCTION AU <?php echo$date_jour; ?><span id="date"></span></h5>
                    </div>
                    <div class="card-body">
                    <div class="text-right" style="margin-bottom: 10px;">
                       <!-- <button type="button" id="add" name="add" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Ajouter</button> -->
                        <a href="#modal1" class="btn btn-success btn-sm js-modal"><i class="fa fa-plus"></i> Stock produit</a>
                        <a href="#modal2" class="btn btn-danger btn-sm js-modal"><i class="fa fa-m"></i> Stock vendu</a>
                    </div>                      
                    
                    <!-- Début modal stock produit -->
                    <aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Stock produit</h5>
                            <hr />
                            <form method="POST" action="stock_production.php">
                                <label for="produit">Produit</label><br />
                                <select name="produit" id="produit">
                                    <option value="">--</option>
                                    <?php 
                                        $prod = "SELECT * FROM produits";
                                        $find_prod = $db -> query($prod);
                                        while($data = $find_prod -> fetch()){ ?>
                                            <option value="<?php echo$data['id_prod']; ?>"><?php echo$data['description']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />

                                <label for="quantite">Quantité</label><br />
                                <input class="form-control" type="number" name="quantite" id="quantite" /><br />

                                <label for="categorie">Catégorie(s)</label><br />
                                <select name="categorie" id="categorie">
                                    <option value="">--</option>
                                    <?php 
                                        $cat = "SELECT * FROM categories";
                                        $find_cat = $db -> query($cat);
                                        while($data = $find_cat -> fetch()){ ?>
                                            <option value="<?php echo$data['id_cat']; ?>"><?php echo$data['libelle_cat']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Enregistrer</button>
                                    <button class="btn btn-danger" type="reset"><i class="fa fa-remove"></i> Annuler</button>
                                    <button class="btn btn-success js-modal-close">Quitter</button>
                                </div>
                            </form>
                         </div>
                    </aside>
                    <!-- Fin modal stock produit -->

                    <!-- Début modal stock vendu -->
                    <aside id="modal2" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Stock vendu</h5>
                            <hr />
                            <form method="POST" action="stock_vendu.php">
                            <label for="produit">Produit</label><br />
                                <select name="produit" id="produit">
                                    <option value="">--</option>
                                    <?php 
                                        $prod = "SELECT * FROM produits";
                                        $find_prod = $db -> query($prod);
                                        while($data = $find_prod -> fetch()){ ?>
                                            <option value="<?php echo$data['id_prod']; ?>"><?php echo$data['description']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />

                                <label for="quantite">Quantité</label><br />
                                <input class="form-control" type="number" name="quantite" id="quantite" /><br />

                                <label for="categorie">Catégorie(s)</label><br />
                                <select name="categorie" id="categorie">
                                    <option value="">--</option>
                                    <?php 
                                        $cat = "SELECT * FROM categories";
                                        $find_cat = $db -> query($cat);
                                        while($data = $find_cat -> fetch()){ ?>
                                            <option value="<?php echo$data['id_cat']; ?>"><?php echo$data['libelle_cat']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Enregistrer</button>
                                    <button class="btn btn-danger" type="reset"><i class="fa fa-remove"></i> Annuler</button>
                                    <button class="btn btn-success js-modal-close">Quitter</button>
                                </div>
                            </form>
                         </div>
                    </aside>
                    <!-- Fin modal stock vendu -->

                        <div >
                            <table class="table table-sm table-bordered table-striped" id="stock">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Ref</th>
                                        <th style="text-align:center">Produits</th>
                                        <th style="text-align:center">Qnte Init</th>
                                        <th style="text-align:center">Qnte Ent</th>
                                        <th style="text-align:center">Qnte Vend</th>
                                        <th style="text-align:center">Qnte Rest</th>
                                        <th style="text-align:center">Prix unitaire</th>
                                        <th style="text-align:center">Prix total</th>
                                        <th style="text-align:center">Catégorie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //On affiche la table matiere première
                                        $production = "SELECT production.id, production.qnte_init, production.qnte_ent, production.qnte_vend, production.qnte_rest, production.prix_uni, production.prix_tot, production.date_production,
                                        production.mois_production, production.an_production, categories.id_cat, categories.libelle_cat, produits.id_prod,
                                        produits.description, produits.prix FROM production INNER JOIN produits ON production.id_pdt = produits.id_prod 
                                        INNER JOIN categories ON production.id_cat = categories.id_cat";
                                        
                                       // $mat="SELECT * FROM stock";
                                        $find_prod = $db -> query($production);
                                        $nombre = $find_prod -> rowCount();
                                        if($nombre == 0)
                                            {
                                                echo"Il n'y a aucun enregistrement trouvé.";
                                            }
                                         else
                                            { 
                                                while($data = $find_prod -> fetch()) { ?>
                                                    <tr>
                                                        <td style="text-align:center"><?php echo$data['id']; ?></td>
                                                        <td><?php echo$data['description']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['qnte_init']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['qnte_ent']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['qnte_vend']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['qnte_rest']; ?></td>
                                                        <td style="text-align:center"><?php echo number_format($data['prix_uni'],0,',',' '); ?> CFA</td>
                                                        <td style="text-align:center"><?php echo number_format($data['prix_tot'],0,',',' '); ?> CFA</td>
                                                        <td style="text-align:center"><?php echo$data['libelle_cat']; ?></td>                                          
                                                    </tr>
                                    <?php  }  } ?>
                                </tbody>
                            </table>
                        </div>  
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