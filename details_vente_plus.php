<?php
	  if(isset($_POST['vente']))
    {
      $id = $_POST['id_cl'];
      $date = $_POST['date'];

   
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
    <body>
        <div class="container">

            <?PHP include('menu.php') ?>
        <div class="card border-primary" style="color:rgb(7,7,7); margin-top:15px;">
            <div class="card-header bg-primary">
                <h5 class="text-center mb-0" style="color:rgb(254,253,253);">Vente du</h5>
            </div>
                <div class="card-body">

                  
                </div>
        </div>
            
            <?php include('footer.php') ?>
        </div>
    </body>
</html>