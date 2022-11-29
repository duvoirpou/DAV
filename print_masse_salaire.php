<?PHP
	session_start();
	require_once('connexion.php');
	
	$mois = $_SESSION['sal_mois'];
	$annee = $_SESSION['sal_annee'];
	
	$dette_agent = 0;
	$total = 0;
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>salaire</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/submenu.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<body onload = "window.print()">
		<div class="container">

		<div class="card-header">
                  <h5 class="text-center mb-0"><b>Masse salariale, mois de : <?PHP echo $mois.' '.$annee ?></b></h5>
                </div>
			<div class="card-body">
				
			<div class="table-responsive">
						<table class="table table-bordered table-sm table-striped" style="margin-top: 10px;width: 100%;" id="salaire" >
                          <thead>
                              <tr>
							  	<th>Matricule</th>
								<th>Identité</th>
								<th>Poste</th>
								<th>Sal_base</th>
								<th>Prime Fct</th>
								<th>Prime Autre</th>
								<th>Dette</th>
								<th>Net à payer</th>
                              </tr>
                          </thead>
                          <tbody>
							<?php //On recherche les donnés dans la bd
								$check = "SELECT * FROM agent";
								$find_agent = $db -> query($check);
								$nbre_find = $find_agent -> rowCount();
								if($nbre_find == 0)
									{
										echo"Il n'y a aucun agent trouvé. Merci de contacter l'administrateur.";
									}
								else
									{ 
										while($data = $find_agent -> fetch())
											{
												$matricule = $data['matricule'];
												$noms = $data['noms'];
												$prenoms = $data['prenoms'];
												$fonction = $data['fonction'];
												$salaire_base = $data['salaire_base'];
												$prime_fct = $data['prime_fct'];
												$prime_autre = $data['prime_autre'];
										
												//On retrouve les dettes de cet agent
												$dette = "SELECT * FROM dette_agent WHERE id_agent = '$matricule' AND mois_engage = '$mois' AND annee_engage = '$annee'";
												$rep_dette = $db -> query($dette);
												$nb_dette = $rep_dette -> rowCount();
												if ($nb_dette == 0)
													{
														$dette_agent = 0;
													}
												else
													{
														while($row = $rep_dette -> fetch())
														{	$dette_agent = $dette_agent + $row['mt_dette'];	}
													}
													
													//On calcule le net à payer
													$net_paye = (($salaire_base + $prime_fct + $prime_autre) - ($dette_agent));
													$total = $total + $net_paye;
											?>
												<tr>
													<td><?php echo$matricule; ?></td>
													<td><?php echo$prenoms.' '.$noms; ?></td>
													<td><?php echo$fonction; ?></td>
													<td><?php echo number_format($salaire_base, 0,',',' '); ?> CFA</td>
													<td><?php echo number_format($prime_fct,0,',',' '); ?> CFA</td>
													<td><?php echo number_format($prime_autre,0,',',' '); ?> CFA</td>
													<td><?php echo number_format($dette_agent,0,',',' '); ?> CFA</td>
													<td><?php echo number_format($net_paye,0,',',' '); ?> CFA</td>
												</tr>
											<?php } } ?>
                          				</tbody>
                 				   </table>
							<center>La masse salariale pour ce mois est de <b><?php echo $total; ?> CFA</b></center>
			</div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/submenu.js"></script>
		<script type="text/javascript">
            setInterval(function(){
                document.getElementById('afficherheure').innerHTML = new Date().toLocaleTimeString();
            }, 1000);
        </script>
	</body>
</html>