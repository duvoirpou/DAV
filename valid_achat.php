<?php

include('controle.php');

require 'connexion.php';

if(isset($_POST['validation'])){


	$id_liv = $_POST['liv'];
	$date_liv = $_POST['date'];
	$montant = $_POST['montant'];


	 	$maj = $db->prepare("UPDATE livraison SET montant=? WHERE id_liv=?");
		$maj->execute(array($montant,$id_liv));
		$message = 'Validation effectuée';


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
    <body class="bg-info" >
    	        <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
			<div class="row">
				<div class="col-6" style="margin: auto;">
					<div class="card">
						<div class="card-header">
							<div class="alert alert-success text-center">
								<?php if(isset($message)){	echo $message;	} ?>
							</div> 
						</div>
						<div class="card-body">
							<table  class="table table-bordered table-sm table-striped ">
			                  <tr>
			                    <th>Facture N° </th><td><?php echo $id_liv ?></td>
			                  </tr>
			                  <tr>  
			                    <th>Date</th><td><?php echo $date_liv ?></td>
			                  </tr>
			                  <tr>
			                  	<th>Montant total</th><td><b><?php echo number_format($montant,'0','',' ').' Frs'; ?></b></td>
			                  </tr> 
			                </table>
			                <div class="text-center"><a class="btn btn-success" href="print_achat.php?id=<?php echo $id_liv ?>"target="blanck" ><i class="fa fa-print"></i> imprimer la facture</a></div>
						</div>
					</div>  
            	</div>
            </div> 
        </div>
            
            <?php include('footer.php') ?>
     
    </body>
</html>

