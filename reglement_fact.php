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
        <div class="container" style="margin-top:7%;margin-bottom: 7%;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">FACTURES A REGLER</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-striped" >
                                    <thead align="center">
                                        <tr>
                                            <th>N° Facture</th><th>client</th><th>Date</th><th>Montant</th><th>Payer</th><th>Reste</th><th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php') ?>
        <script src="assets/js/regl-fact.js"></script>
    </body>
</html>



        