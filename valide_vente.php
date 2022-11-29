<?php
    include ('controle.php');
    include ('connexion.php');




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
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body class="bg-info">

                <?PHP include('menu.php') ?>

        <div class="container" style="margin-top: 7%; margin-bottom: 7%;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center mb-0">VALIDATION  VENTE</h5>
                        </div>
                        <div class="card-body">
                            <div id="message"></div>
                            <div id="affiche"></div>
                        </div>
                    </div>
                </div>
             </div>
        </div>

        <?php include('footer.php') ?>
        <script src="assets/js/valide-vente.js"></script>
    </body>
</html>
