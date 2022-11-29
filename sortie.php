<?PHP
    session_start();
    require 'connexion.php';
?>

<!doctype html>
<html>
<head>
    <title>LGC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include('menu.php');?>
    <div class="container-fluid" style="margin-top: 7%;margin-bottom: 7%;">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mb-0">SORTIE</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered   table-hover table-sm" id="affiche_produit">
                                        <thead>
                                            <tr>
                                                <th>libellé produit</th>
                                                <th>Catégorie</th>
                                                <th>Prix</th>
                                                <th>Stock</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="col">
                                <div id="message"></div>
                                <br>
                                <div id="commande"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="modalCmd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <form method="post" id="form">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Entrez la quantité</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="form-group">
                <input type="text" name="produit" id="produit" class="form-control" readonly />
           </div>
           <div class="form-group">
                <label for="qte">Quantité / Nombre part</label>
                <input type="number" name="qte" id="qte" class="form-control" />
                <input type="hidden" name="id_prod2" id="id_prod2" class="form-control" />
                <input type="hidden" name="id_cat2" id="id_cat2" class="form-control" />
                <input type="hidden" name="prix" id="prix" class="form-control" />
                <input type="hidden" name="action" id="action" value="ajouter" />
           </div>
      </div>
      <div class="modal-footer">
        <div id="msg"></div>
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
  </div>
</div>


       <!-- Modal -->
<div class="modal fade" id="modalClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <form method="post" id="formClient">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajoutez un client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="form-group">
                <input class="form-control" type="text" name="noms_client" id="noms_client" value="" placeholder="Nom(s) du client"/><br>
                <input class="form-control" type="text" name="prenoms_client" id="prenoms_client" value="" placeholder="Prénom(s) du client"/><br>
                <input class="form-control" type="text" name="num_client" id="num_client" value="" placeholder="Numero de tel du client"/><br>
                <input class="form-control" type="text" name="ville" id="ville" value="" placeholder="Ville du client"/><br>
                <input class="form-control" type="text" name="commune" id="commune" value="" placeholder="Commune du client"/><br>
                <input class="form-control" type="text" name="quartier" id="quartier" value="" placeholder="Quartier du client"/><br>
                <input class="form-control" type="text" name="rue" id="rue" value="" placeholder="Rue du client"/>
                <input type="hidden" name="action" id="action" />
           </div>
      </div>
      <div class="modal-footer">
        <div id="sms"></div>
        <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary btn-sm">Enregistrez</button>
      </div>
    </div>
    </form>
  </div>
</div>



    </div>
    <?php include('footer.php') ?>
    <script src="assets/js/recette_sortie.js"></script>
</body>
</html>