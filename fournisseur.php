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
                        <h5 class="text-center mb-0">NOS FOURNISSEURS <span id="date"></span></h5>
                    </div>
                    <div class="card-body">
                    <div class="text-right" style="margin-bottom: 10px;">
                        <a href="#modal1" class="btn btn-success btn-sm js-modal"><i class="fa fa-plus"></i> Nouveau fournisseur</a>
                    </div>                      
                    
                    <!-- Début modal new f/eur -->
                    <aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Nouveau fournisseur</h5>
                            <hr />
                            <form method="POST" action="save_fourn.php">
                                <label for="raison_soc">Raison sociale</label><br />
                                <input class="form-control" type="text" name="raison_soc" id="raison_soc" /><br />
                                
                                <label for="ad_fourn">Adresse fournisseur</label><br />
                                <input class="form-control" type="text" name="ad_fourn" id="ad_fourn" /><br />
                                
                                <label for="tel_fourn">Télephone fournisseur</label><br />
                                <input class="form-control" type="text" name="tel_fourn" id="tel_fourn" /><br />
                                
                                <label for="responsable">Responsable</label><br />
                                <input class="form-control" type="text" name="responsable" id="responsable" /><br />
                                
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
                                    <th style="text-align:center">Raison sociale</th>
                                    <th style="text-align:center">Adresse</th>
                                    <th style="text-align:center">Télephone</th>
                                    <th style="text-align:center">Responsable</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //On affiche la table matiere première
                                    
                                    $fourn = "SELECT * FROM fournisseur";
                                    
                                    // $mat="SELECT * FROM stock";
                                    $find_fourn = $db -> query($fourn);
                                    $nombre = $find_fourn -> rowCount();
                                    if($nombre != 0)
                                        {
                                            while($data = $find_fourn -> fetch()) { ?>
                                                <tr>
                                                    <td style="text-align:center"><?php echo$data['id']; ?></td>
                                                    <td><?php echo$data['raison_sociale']; ?></td>
                                                    <td><?php echo$data['adresse']; ?></td>
                                                    <td><?php echo$data['contact']; ?></td>
                                                    <td><?php echo$data['responsable']; ?></td>
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