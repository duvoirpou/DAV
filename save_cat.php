<?php 
	
	require 'connexion.php';

	if(isset($_POST['nom']) && !empty($_POST['nom']))
	{
		$nom = htmlspecialchars(trim($_POST['nom']));

		$cont =$db->query("SELECT * FROM categories WHERE libelle_cat='$nom' ");
		$res = $cont->rowCount();
		if ($res==0)
		{
			
		$in =$db->exec("INSERT INTO categories(libelle_cat) VALUES('$nom') ");

		echo "<div class='alert-success' >categorie enregistrée avec succès</div>";
		}
		else
		{
			echo "<div class='alert-info' >la categorie <b>$nom</b> existe déjà dans la base </div>";
		}
	
	}
	else
	{
		echo "<div class='alert-danger' >veuillez compléter le champs</div>";
	}
?>
