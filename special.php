<?php include ('controle.php') ?>
<!doctype html>
<html>
<head>
    <title>gestock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.theme.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
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
                    <h5 class="text-center mb-0">LISTE speciale</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table id="tProduit" class="table table-bordered table-sm table-striped" style="100%;">
                                    <thead>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                        <th>Sel</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <th>Designation</th>
                                        <th>Qté</th>
                                        <th>PU</th>
                                        <th>PT</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
<script src="assets/js/produit.js"></script>
<script src="assets/js/special.js"></script>
</body>
</html>



