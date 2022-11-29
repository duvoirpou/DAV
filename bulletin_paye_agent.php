<?PHP
	require('controle.php');
	require_once('connexion.php');
	
	//On reçoit les coordonnées de l'agent
	$matricule = htmlspecialchars($_GET['matricule']);
	$periode = htmlspecialchars($_GET['periode']);
	$annee = htmlspecialchars($_GET['annee']);
	
	$paye = "SELECT agent.id, agent.matricule, agent.noms, agent.prenoms, agent.sexe, agent.sitfam, agent.fonction, 
	agent.charge, agent.date_eng, agent.contrat, bulletin.id, bulletin.matricule, bulletin.salaire_base,
	 bulletin.prime_fonction, bulletin.autre_prime, bulletin.dette, bulletin.periode, bulletin.date_bulletin, 
	 bulletin.mode_reglement, bulletin.net_payer, bulletin.annee FROM agent INNER JOIN bulletin ON
	  agent.matricule = bulletin.matricule WHERE bulletin.matricule = '$matricule' AND bulletin.periode = '$periode'
	   AND bulletin.annee = '$annee'";

	$rep_paye = $db -> query($paye);
	$nb_bulletin = $rep_paye -> rowCount();
	if($nb_bulletin == 0)
		{
			echo"Aucun bulletin trouvé pour cette période. Merci de contacter le Directeur général afin d'éditer les bulletins.";
			exit();
		}
	while($row = $rep_paye -> fetch())
		{ ?>

<!DOCTYPE HTML>
<html>
<head>
    <title>bulletin_paye</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/submenu.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body onload = "window.print()">
	<div class="container">
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><img src = "assets/img/mie.png" width="180px"/></th>
						<th colspan="3" style="text-align:center" ;>
							<h1>MIE D'ANGE</h1>
							<h5>Boulangeire - Pâtisserie - Salon de thé</h5>
							<h5>102 Avenue de France - Poto-poto / P13.C1132 - Moukondo sonaco</h5>
							<h5>Tél. : +(242) 06 408 74 79 / 05 382 02 95 - 06 408 27 24 / 05 382 06 96</h5>
						</th>
					</tr>
					<tr>
						<th colspan = '3' width = '75%'><h5><b><center>BULLETIN DE SALAIRE</center><b/></h5></th>
						<th>
							Matricule : <b><?PHP echo$matricule ?></b><br/>
							Code : <?PHP echo$row['id'] ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Identité : </td><td width = '40%'><b><?PHP echo$row['noms'] ?> <?PHP echo$row['prenoms'] ?></b></td><td>Contrat : </td><td><b><?PHP echo$row['contrat'] ?></b></td>
					</tr>
					<tr>
						<td>Poste :</td><td><b><?PHP echo$row['fonction'] ?></b></td><td>Date engagement :</td><td><b><?PHP echo$row['date_eng'] ?></b></td>
					</tr>
					<tr>
						<td>Sitfam :</td><td><b><?PHP echo$row['sitfam'] ?></b></td><td>Enfant à charge :</td><td><b><?PHP echo$row['charge'] ?></b></td>
					</tr>
					<tr>
						<td>Sexe :</td><td><b><?PHP echo$row['sexe'] ?></b></td><td></td><td></td>
					</tr>
				</tbody>
			</table>
			<br />
			<table class="table table-bordered table-sm table-striped">
				<thead>
					<b><th width = '10%'>N°</th><th width = '60%'>Libelle</th><th>Gains</th><th>Retenu</th></b>
				</thead>
				<tbody>
					<tr>
						<td>01</td><td>Salaire de base (suivant le contrat)</td><td><?PHP echo$row['salaire_base'] ?></td><td></td>
					</tr>
					<tr>
						<td>02</td><td>Prime de fonction </td><td><?PHP echo$row['prime_fonction'] ?></td><td></td>
					</tr>
					<tr>
						<td>03</td><td>Autre prime</td><td><?PHP echo$row['autre_prime'] ?></td><td></td>
					</tr>
					<tr>
						<td>04</td><td>Retenu sur salaire</td><td></td><td><?PHP echo$row['dette'] ?></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-sm table-striped">
				<thead>
					<b><th>N° Emission</th><th>Date</th><th>Période</th><th>Année scolaire</th><th>Mode règlement</th><th>Net à payer</th></b>
				</thead>
				<tbody>
					<tr>
						<td><?PHP echo$row['id'] ?></td><td><?PHP echo$row['date_bulletin'] ?></td><td><?PHP echo$row['periode'] ?></td><td><?PHP echo$row['annee'] ?></td><td><?PHP echo$row['mode_reglement'] ?></td><td><b><?PHP echo$row['net_payer'] ?> F</b></td>
					</tr>
				</tbody>
			</table>
		<?PHP } ?>
			<br /><br />
			<table class="table table-bordered">
				<tr>
					<td width='33%'><b><center>Le Gestionnaire</center></b></td>
					<td width='33%'><b><center>L'Interssé(e)</center></b></td>
					<td width='33%'><b><center>Le Directeur général</center></b></td>
				</tr>
				<tr><td><br /><br /><br /><br /></td><td></td><td></td></b></tr>
			</table>
		</div>
	</div>
</body>
</html>