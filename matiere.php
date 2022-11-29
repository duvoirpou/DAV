<?PHP
       include('controle.php');
       include('connexion.php');
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
                        <h5 class="text-center mb-0">LISTE DES MATIERES PREMIERES <span id="date"></span></h5>
                    </div>
                    <div class="card-body">
                    <div class="text-right" style="margin-bottom: 10px;">
                        <a href="#modal1" class="btn btn-success btn-sm js-modal"><i class="fa fa-plus"></i> Ajouter</a>
                    </div>                      
                    
                    <!-- Début modal new matiere -->
                    <aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Ajouter une matière première</h5>
                            <hr />
                            <form method="POST" action="ajout_matiere.php">
                                <label for="desig_mat">Désignation matière première</label><br />
                                <input class="form-control" type="text" name="desig_mat" id="desig_mat" /><br />
                                
                                <label for="mt_mat">Montant matière première </label><br />
                                <input class="form-control" type="number" name="mt_mat" id="mt_mat" /><br />
                                
                                <label for="fourn">Fournisseur</label><br />
                                <select name="fourn" id="fourn">
                                    <option value="">--</option>
                                    <?php 
                                        $fournis = "SELECT * FROM fournisseur";
                                        $find_fournis = $db -> query($fournis);
                                        while($data = $find_fournis -> fetch()){ ?>
                                            <option value="<?php echo$data['id']; ?>"><?php echo$data['raison_sociale']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />
                                
                                <label for="categorie">Catégorie</label><br />
                                <select name="categorie" id="categorie">
                                    <option value="">--</option>
                                    <?php 
                                        $categ = "SELECT * FROM categories";
                                        $find_categ = $db -> query($categ);
                                        while($data = $find_categ -> fetch()){ ?>
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
                    <!-- Fin modal new f/eur -->

                    <div >
                        <table class="table table-sm table-bordered table-striped" id="stock">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Ref</th>
                                    <th style="text-align:center">DESIGNATION MATIERE</th>
                                    <th style="text-align:center">MONANT</th>
                                    <th style="text-align:center">FOURNISSEUR</th>
                                    <th style="text-align:center">CATEGORIE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //On affiche la table matiere première
                                    $matiere = "SELECT matiere_premiere.id_mat, matiere_premiere.libelle, matiere_premiere.montant,
                                    matiere_premiere.fournisseur, fournisseur.id, fournisseur.raison_sociale, categories.libelle_cat FROM matiere_premiere INNER JOIN fournisseur ON 
                                    matiere_premiere.fournisseur = fournisseur.id INNER JOIN categories ON matiere_premiere.id_cat = categories.id_cat";
                                    
                                    // $mat="SELECT * FROM stock";
                                    $find_matiere = $db -> query($matiere);
                                    $nombre = $find_matiere -> rowCount();
                                    if($nombre != 0)
                                        {
                                            while($data = $find_matiere -> fetch()) { ?>
                                                <tr>
                                                    <td style="text-align:center"><?php echo$data['id_mat']; ?></td>
                                                    <td><?php echo$data['libelle']; ?></td>
                                                    <td style="text-align:center"><?php echo$data['montant']; ?></td>
                                                    <td><?php echo$data['raison_sociale']; ?></td>
                                                    <td><?php echo$data['libelle_cat']; ?></td>
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