<?php 
		require 'connexion.php';
		

			$id_prod = $_POST['id_prod'];

			$req = $db->query("SELECT * FROM produits WHERE id_prod=$id_prod");
			$data = $req->fetch();

			
				$val['id_prod'] = $data['id_prod'];
				$val['prix'] = $data['prix'];
				$val['description'] = $data['description'];
				$val['id_cat'] = $data['id_cat'];
				
			

			echo json_encode($val);
	
