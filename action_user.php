<?php
	include('controle.php');

	include('connexion.php');


	if(isset($_POST['action'])){

		if($_POST['action']=='inserer'){

			$user = htmlentities(trim(strip_tags($_POST['user'])));
			$pass = htmlentities(trim(strip_tags($_POST['pass'])));
			$type = htmlentities(trim(strip_tags($_POST['type'])));

			$sql= $db->prepare("INSERT INTO users (login,password,type) VALUES(:login,:password,:type)");

			if($sql->execute(array(':login' => $user, ':password' => $pass, ':type' => $type))){

				echo '<h6 class="text-success">enregistrement effectué avec succès</h6>';

				}
				else
				{

					echo '<h6 class="text-danger">Echec d\'enregistrement</h6>';

				}
			}
		}


?>