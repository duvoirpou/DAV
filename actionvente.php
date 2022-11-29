<?php 
	include('controle.php');
    include('connexion.php');

if(isset($_POST['action'])){

		if($_POST['action']=='inserer'){

			$id_cl = htmlentities(trim(addslashes(strip_tags($_POST['client_id']))));
		
			$req = $db->prepare("INSERT INTO commande(id_cl,date_cmd) VALUES($id_cl,current_date())");
			$req->execute();
			echo '<div class="text-success">enregistrement effectué</div>';
			$req->closeCursor();

		}
		
	}
	
?>	