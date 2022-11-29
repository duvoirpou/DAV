<?PHP
       include('controle.php');
       include('connexion.php');

?>
<!doctype html>
<html>

<head>
    <title>gestock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="bg-info">

    <?PHP include('menu.php') ?>
    <div class="container" style="margin-top: 7%; margin-bottom:7%">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mb-0">JOURNAL DE STOCK <span id="date"></span></h5>
                    </div>
                    <div class="card-body">

                        <div>
                            <table class="table table-sm table-bordered table-striped" id="stock">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Catégorie</th>
                                        <th>S.I</th>
                                        <th>Entrée</th>
                                        <th>Sortie</th>
                                        <th>Solde</th>
                                        <th>P.U</th>
                                        <th>P.T</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <?php include('footer.php') ?>
    <script src="assets/js/journ-stock.js"></script>

</body>

</html>