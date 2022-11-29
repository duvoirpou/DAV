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
                        <h5 class="text-center mb-0">TABLEAUX RECAPITULATIFS<span id="date"></span></h5>
                    </div>
                    <div class="card-body">
                    <div class="text-right" style="margin-bottom: 10px;">
                        <a href="#modal2" class="btn btn-danger btn-sm js-modal">Entrée/Sortie</a>
                        <a href="#modal1" class="btn btn-success btn-sm js-modal">Ventes</a>
                        <a href="#modal3" class="btn btn-primary btn-sm js-modal">Stock</a>
                    </div>

                    <!-- Début modal recap vente -->
                    <aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Tableau réapitulatif de vente</h5>
                            <hr />
                            <form method="POST" action="recap_vente_date.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="date_recap">Selectionnez la date</label><br />
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-sm" type="date" name="date_recap" id="date_recap" required />
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>
                            </form>
                            <form  method="POST" action="recap_vente_mois.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="mois_recap">Selectionnez le mois</label><br />
                                    </div>
                                    <div class="col">
                                        <select name="mois_recap" id="mois_recap" class="form-control form-control-sm" required >
                                            <option value="">--</option>
                                            <option value="janvier">Janvier</option>
                                            <option value="fevrier">Février</option>
                                            <option value="mars">Mars</option>
                                            <option value="avril">Avril</option>
                                            <option value="mai">Mai</option>
                                            <option value="juin">Juin</option>
                                            <option value="juin">Juillet</option>
                                            <option value="juillet">Juillet</option>
                                            <option value="aout">Août</option>
                                            <option value="septembre">Semptembre</option>
                                            <option value="octobre">Octobre</option>
                                            <option value="novembre">novembre</option>
                                            <option value="decembre">Décembre</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>
                            </form>
                            <form  method="POST" action="recap_vente_annee.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="annee_recap">Selectionnez l'année <i class="fa hand-point-right"></i></label><br />
                                    </div>
                                    <div class="col">
                                        <select name="annee_recap" id="annee_recap" class="form-control form-control-sm" required >
                                            <option value="">--</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>
                            </form>
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm js-modal-close">Quitter</button>
                                </div>
                         </div>
                    </aside>
                    <!-- Fin modal récap vente -->

                    <!-- Début modal recap de production -->
                    <aside id="modal2" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Tableau réapitulatif des depenses </h5>
                            <hr />
                            <form method="POST" action="recap_prod_date.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="date_recap">Selectionnez la date</label><br />
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-sm" type="date" name="date_recap" id="date_recap" required />
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>
                            </form>
                            <form  method="POST" action="recap_prod_mois.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="mois_recap">Selectionnez le mois</label><br />
                                    </div>
                                    <div class="col">
                                        <select name="mois_recap" id="mois_recap" class="form-control form-control-sm" required >
                                            <option value="">--</option>
                                            <option value="janvier">Janvier</option>
                                            <option value="fevrier">Février</option>
                                            <option value="mars">Mars</option>
                                            <option value="avril">Avril</option>
                                            <option value="mai">Mai</option>
                                            <option value="juin">Juin</option>
                                            <option value="juin">Juillet</option>
                                            <option value="juillet">Juillet</option>
                                            <option value="aout">Août</option>
                                            <option value="septembre">Semptembre</option>
                                            <option value="octobre">Octobre</option>
                                            <option value="novembre">novembre</option>
                                            <option value="decembre">Décembre</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>
                            </form>
                            <form  method="POST" action="recap_prod_annee.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="annee_recap">Selectionnez l'année <i class="fa hand-point-right"></i></label><br />
                                    </div>
                                    <div class="col">
                                        <select name="annee_recap" id="annee_recap" class="form-control form-control-sm" required >
                                            <option value="">--</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>
                            </form>
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm js-modal-close">Quitter</button>
                                </div>
                         </div>
                    </aside>
                    <!-- Fin modal récap de production -->

                    <!-- Début modal recap stock -->
                    <aside id="modal3" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Tableau réapitulatif de stock</h5>
                            <hr />
                            <form method="POST" action="recap_stock_date.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="date_recap">Selectionnez la date</label><br />
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-sm" type="date" name="date_recap" id="date_recap" required />
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>
                            </form>

                            <form  method="POST" action="recap_stock_mois.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="mois_recap">Selectionnez le mois</label><br />
                                    </div>
                                    <div class="col">
                                        <select name="mois_recap" id="mois_recap" class="form-control form-control-sm" required >
                                            <option value="">--</option>
                                            <option value="janvier">Janvier</option>
                                            <option value="fevrier">Février</option>
                                            <option value="mars">Mars</option>
                                            <option value="avril">Avril</option>
                                            <option value="mai">Mai</option>
                                            <option value="juin">Juin</option>
                                            <option value="juin">Juillet</option>
                                            <option value="juillet">Juillet</option>
                                            <option value="aout">Août</option>
                                            <option value="septembre">Semptembre</option>
                                            <option value="octobre">Octobre</option>
                                            <option value="novembre">novembre</option>
                                            <option value="decembre">Décembre</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>

                            </form>

                            <form  method="POST" action="recap_stock_annee.php">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="annee_recap">Selectionnez l'année <i class="fa hand-point-right"></i></label><br />
                                    </div>
                                    <div class="col">
                                        <select name="annee_recap" id="annee_recap" class="form-control form-control-sm" required >
                                            <option value="">--</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i> Consulter</button>
                                    </div>
                                </div>

                            </form>


                                <div class="form-group">
                                    <button class="btn btn-success btn-sm js-modal-close">Quitter</button>
                                </div>

                         </div>
                    </aside>
                    <!-- Fin modal récap stock -->
                    <!--
                    <div >
                        <table class="table table-sm table-bordered table-striped" id="stock">
                            <thead>
                                <tr>
                                    <th style="text-align:center">N° Ordre</th>
                                    <th style="text-align:center">Produits</th>
                                    <th style="text-align:center">Quantité</th>
                                    <th style="text-align:center">Prix Unit</th>
                                    <th style="text-align:center">Prix Total</th>
                                </tr>
                            </thead>
                            <tbody>
                          <?php
                            //On affiche la table matiere première

                            $mat = "SELECT stock.ref,stock.stock,stock.entree,stock.sortie,stock.solde,stock.date_st,
                            matiere_premiere.libelle,categories.libelle_cat FROM matiere_premiere INNER JOIN stock ON
                            matiere_premiere.id_mat = stock.id_mat INNER JOIN categories ON stock.id_cat =
                            categories.id_cat";

                            // $mat="SELECT * FROM stock";
                            $find_mat = $db -> query($mat);
                            $nombre = $find_mat -> rowCount();
                            if($nombre == 0)
                                {
                                    echo"Il n'y a aucun enregistrement trouvé.";
                                }
                                else
                                {
                                    while($data = $find_mat -> fetch()) { ?>
                                        <tr>

                                        </tr>
                        <?php  }  } ?>
                                </tbody>
                            </table>
                        </div> -->

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