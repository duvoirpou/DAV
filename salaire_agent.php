<?PHP
	session_start();
	require_once('connexion.php');
	
	$mois = $_POST['mois'];
	$annee = $_POST['annee'];
		
	$_SESSION['sal_mois'] = $mois;
	$_SESSION['sal_annee'] = $annee;

	$dette_agent = 0;
	$total = 0;
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LGC</title>
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
		<link rel="stylesheet" href="assets/css/style.css">
    </head>
	<body class="bg-info">
         <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h5 class="text-center mb-0">Situation salariale mois de <?php echo$mois.' '.$annee ?></h5>
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
								<th>Bulletin</th>
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
												$dette = "SELECT SUM(mt_dette) AS dette FROM dette_agent WHERE id_agent = '$matricule' AND mois_engage = '$mois' AND annee_engage = '$annee' GROUP BY id_agent";
												$rep_dette = $db -> query($dette);
												$nb_dette = $rep_dette -> rowCount();
												if ($nb_dette == 0)
													{
														$dette_agent = 0;
													}
												else
													{
														while($row = $rep_dette -> fetch())
														{	$dette_agent = $row['dette'];	}
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
													<td style="text-align:center;"><a href="bulletin_paye_agent.php?matricule=<?PHP echo$matricule ?>
													&periode=<?PHP echo$mois ?>&annee=<?PHP echo$annee ?>" target="_bank">
													<button class="btn btn-outline-info" type="submit">Voir bulletin</button></a></td>
												</tr>
											<?php } } ?>
                          </tbody>
                    </table>
						
						<center>La masse salariale pour ce mois est de <b><?php echo $total; ?> CFA</b></center><br /><br />
						<div class="text-center"><a href="print_masse_salaire.php" target="_bank"><button class="btn btn-success" type="submit"><i class="fa fa-print"></i> Imprimer la situation salariale</button></a></div>
						<br />
						<div class="text-center"><a href="valider_salaires.php" target="_bank"><button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Editer les bulletins de salaire</button></a></div>
					</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	<?php include('footer.php') ?>
        <script src="assets/js/app.js"></script>
        <!--
			<script src="assets/js/produit.js"></script>
			<script src="assets/js/prod.js"></script>
			
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/bootstrap/js/submenu.js"></script>
			<script type="text/javascript">
				setInterval(function(){
					document.getElementById('afficherheure').innerHTML = new Date().toLocaleTimeString();
				}, 1000);
			</script>
		-->
    </body>
</html>