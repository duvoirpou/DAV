<?PHP

include('controle.php');

?>
<!doctype html>
<html>

<head>
    <title>LGC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="assets/plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        
    <link rel="stylesheet" href="asset/css/jquery-ui.min.css">
    <link rel="stylesheet" href="asset/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="assets/plugins/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="assets/plugins/c3/c3.min.css">
        <link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="assets/dist/css/theme.min.css">
        <script src="assets/src/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="bg-info">
    <?php   include('menu.php'); ?>
    <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mb-0">LISTE DES CATEGORIES DES PRODUITS</h5>
                    </div>
                    <div class="card-body">
                        <?php if($_SESSION['type']=='admin'){ ?>
                        <div class="text-right"><button class="btn btn-success btn-sm" id="ajouter" name="ajouter"><i
                                    class="fa fa-plus"></i> Ajouter</button></div>
                        <?php } ?>
                        <!-- modal -->

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" id="cat_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRMER</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nom" class="col-form-label">Nom</label>
                                                <input type="text" class="form-control" name="nom" id="nom">
                                                <span id="erreur_cat" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="form-group">
                                                <input type="hidden" name="action" id="action" value="insert">
                                                <input type="hidden" name="id_cat" id="id_cat">
                                                <input type="submit" name="operation" id="operation" class="btn btn-primary btn-sm" value="ajouter" />
                                                <span id="action_alert" title="message"></span>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- modal -->

                        
                            <table class="table table-bordered table-striped table-sm" id="categ">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Id</th>
                                        <th>Catégories</th>
                                        <th style="width: 5%; text-align: center;">action</th>
                                    </tr>
                                </thead>
                            </table>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include('footer.php') ?>
    <script src="asset/js/categorie.js"></script>
</body>

</html>