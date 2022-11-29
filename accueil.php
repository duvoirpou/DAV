<?PHP
    include('controle.php');
    require 'connexion.php';
    //$requette = $db->query("SELECT * FROM produits WHERE stock BETWEEN 1 AND 5 ");
   // $pa = $requette->rowcount();

?>
<!doctype html>
<html>
<head>
    <title>LGC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="assets/plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="assets/plugins/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="assets/plugins/c3/c3.min.css">
        <link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="assets/dist/css/theme.min.css">
        <script src="assets/src/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <?php  include('menu.php'); ?>
    <!-- <div class="container" class="bg-info" style="margin-top: 7%;margin-bottom:7%;">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mb-0">Bienvenue</h5>
                    </div>
                    <div class="card-body" style="height: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <?php include('footer.php') ?>
    </body>
</html>