<?PHP
	include('controle.php');
	include('connexion.php');
	
	$tab_mois = array('','janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
	$date_jour = date("d").' '.$tab_mois[date("n")].' '.date("Y");
    
   echo $date_dette = date('Y-n-d');
	
	echo$id_agent = $_POST['agent'];
	echo$montant = $_POST['montant'];
	echo$libelle = "Accompte sur salaire";
	echo$mois = $_POST['mois_engage'];
	echo$annee = $_POST['annee_engage'];
	
	//On enregistre la dette de l'agent dans la caisse
	$ajout_dette ="INSERT INTO dette_agent (id_agent,mt_dette,libelle_dette,mois_engage,date_dette,annee_engage) 
			VALUES ('$id_agent','$montant','$libelle','$mois','$date_dette','$annee')";
	$req = $db -> query($ajout_dette);
	
	//On affiche la page cahier texte
	header("location:liste_agent.php");
?>