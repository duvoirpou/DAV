<?php
    include('connexion.php');
   
    //On récupère les données du formulaire
    $noms = $_POST['noms_ag'];
    $prenoms = $_POST['prenoms_ag'];
    $date_nais = $_POST['date_nais'];
    $lieu_nais = $_POST['lieu_nais'];
    $sexe = $_POST['sexe_ag'];
    $nation = $_POST['nationalite'];
    $adresse = $_POST['adresse'];
    $tele = $_POST['tele'];
    $sitfam = $_POST['sitfam_ag'];
    $charge = $_POST['charge'];
    $date_eng = $_POST['date_eng'];
    $contrat = $_POST['contrat_ag'];
    $fonction = $_POST['fonction'];
    $salaire_base = $_POST['sal_base'];
    $prime_fct = $_POST['prime_fct'];
    $prime_autre = $_POST['prime_autre'];
    
    $sigle = "MIE"; //On dfinie le sigle du matricule

    //On vérifie que cet agent n'a pas encore été saisi
	$check_agent = "SELECT * FROM brouillon_agent WHERE noms = '$noms' AND prenoms = '$prenoms'";
	$agent_existe = $db -> query($check_agent);
	$nb_ag = $agent_existe -> rowCount();
	if($nb_ag != 0)
		{
			echo"<center>ERREUR !!!<br />
					Cet agent existe déjà dans la base de données. Merci de vérifier et saisir un autre nom.
					<hr />
					<a href='agent.php'>Retour</a>
				</center><br />";
			exit();
		}
    else
        {
            /*while($data = $agent_existe -> fetch())
            {
                $mat_ag = $sigle.$data['code'];
            }
        */
            //On inscrit l'élève dans la table brouillon
            $ag_br = $db -> prepare("INSERT INTO brouillon_agent(noms,prenoms,date_nais,sexe)
                                VALUES(:noms,:prenoms,:date_nais,:sexe)");
            $ag_br -> execute(array(
                ':noms' => $noms,
                ':prenoms' => $prenoms,
                ':date_nais' => $date_nais,
                ':sexe' => $sexe,
            ));
        }

    //On récupère le code dans la table brouillon_agent pour déterminer le matricule de l'agent
    $check = "SELECT * FROM brouillon_agent WHERE noms = '$noms' AND prenoms = '$prenoms'";
	$find_agent = $db -> query($check);
	$nbre_find = $find_agent -> rowCount();
    if($nbre_find != 0)
        {
            while($data = $find_agent -> fetch())
            {
                echo$matricule = $sigle.$data['code'];
            }
        }
    
    //On enregistre l'agent dans la table agent
    $agent = $db -> prepare("INSERT INTO agent(matricule, noms, prenoms, date_nais, lieu_nais, sexe, nationalite, adresse, tele, sitfam, charge, date_eng, contrat, fonction, salaire_base, prime_fct, prime_autre)
    VALUES(:matricule,:noms,:prenoms,:date_nais,:lieu_nais,:sexe,:nationalite,:adresse,:tele,:sitfam,:charge,:date_eng,:contrat,:fonction,:salaire_base, :prime_fct, :prime_autre)");
    $agent -> execute(array(
        ':matricule' => $matricule,
        ':noms' => $noms,
        ':prenoms' => $prenoms,
        ':date_nais' => $date_nais,
        ':lieu_nais' => $lieu_nais,
        ':sexe' => $sexe,
        ':nationalite' => $nation,
        ':adresse' => $adresse,
        ':tele' => $tele,
        ':sitfam' => $sitfam,
        ':charge' => $charge,
        ':date_eng' => $date_eng,
        ':contrat' => $contrat,
        ':fonction' => $fonction,
        ':salaire_base' => $salaire_base,
        ':prime_fct' => $prime_fct,
        ':prime_autre' => $prime_autre
    ));

    header('location: agent.php');
?>