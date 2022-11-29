<?PHP
    session_start();
 
    if(!isset($_SESSION['user'])){
        header('location:index.php');
    } 
?>

<!doctype html>
<html>
<head>
    <title>gestock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body class="bg-info">
         <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">JOURNAL DE CAISSE</h6>
                        </div>
                        <div class="card-body">
                            <fieldset class="form-group">
                                <legend style="font-size: 14px;">Recherche par date</legend>
                            <form method="post" id="rech_form" class="form-inline">
                                <div>
                                    <input type="date" name="date_sel" id="date_sel" class="form-control form-control-sm" />
                                    <input type="hidden" name="action" id="action" value="ok" />
                                    <input type="submit" class="btn btn-outline-primary btn-sm" value="valider">
                                    <span id="info" class="text-danger"></span>
                                </div>
                            </form>
                            </fieldset>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead align="center">
                                        <tr>
                                            <th width="100">id</th>
                                            <th width="100">Client</th>
                                            <th width="100">N° Facture</th>
                                            <th width="100">Montant</th>
                                            <th width="100">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                    </tbody>
                                </table>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
    </div>
        <?php include('footer.php') ?>
        <script src="assets/js/journ-caisse.js"></script>
    </body>
</html>