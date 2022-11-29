<?PHP
	session_start();
	require_once('connexion.php');
	
	//On trouve la date et le mois
	$tab_mois = array('','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','decembre');
	$date_jour = date("d").' '.$tab_mois[date("n")].' '.date("Y");
	$mois_jour = $tab_mois[date("n")];
	
	$mois = $_SESSION['sal_mois'];
	$annee = $_SESSION['sal_annee'];
	
	$dette_agent = 0;
	$total = 0;

	//On vérifie que les bulletins exit
	$check_bulletin = "SELECT * FROM bulletin WHERE periode = '$mois' AND annee = '$annee'";
	$rep_bulletin = $db -> query($check_bulletin);
	$nb_bulletin = $rep_bulletin -> rowCount();
	if($nb_bulletin == 0)
	{ 
		//On retrouve les agents administratifs
		$agent = "SELECT * FROM agent";
		$rep = $db -> query($agent);
		$nb_agent = $rep -> rowCount();
		if($nb_agent != 0)
		{
			while($row = $rep -> fetch())
				{ 
					$matricule = $row['matricule'];
					$noms_agent = $row['noms'];
					$prenoms_agent = $row['prenoms'];
					$poste_agent = $row['fonction'];
					$sal_base_agent = $row['salaire_base'];
					$prime_fct_agent = $row['prime_fct'];
					$autre_agent = $row['prime_autre'];
										
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
							while($data = $rep_dette -> fetch())
							{	
								$dette_agent = $dette_agent + $data['mt_dette'];
							}
						}
							$net_paye = (($sal_base_agent + $prime_fct_agent + $autre_agent) - ($dette_agent));
							
							//On enregistre le bulletin de salaire dans la table bulletin
							$req_bulletin = $db -> prepare("INSERT INTO bulletin (matricule,salaire_base,prime_fonction,autre_prime,dette,periode,date_bulletin,mode_reglement,net_payer,annee)
							VALUES (:matricule,:salaire_base,:prime_fonction,:autre_prime,:dette,:periode,:date_bulletin,:mode_reglement,:net_payer,:annee)");
							$req_bulletin -> execute(array(
								':matricule' => $matricule,
								':salaire_base' => $sal_base_agent,
								':prime_fonction' => $prime_fct_agent,
								':autre_prime' => $autre_agent,
								':dette' => $dette_agent,
								':periode' => $mois,
								':date_bulletin' => $date_jour,
								':mode_reglement' => 'Espece',
								':net_payer' => $net_paye,
								':annee' => $annee
							));
				}
		}
	}

	echo "<script language='javascript'>window.close()</script>"; //ce script ferme la page
?>