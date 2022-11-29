<?php
require 'connexion.php';


if(isset($_POST['action'])){
	if($_POST['action']=='insert'){

		$nom =htmlentities(trim(addslashes(strip_tags($_POST['nom']))));

		$req = $db->prepare("INSERT INTO categories(libelle_cat) VALUES(?) ");
		$req->execute(array($nom));

		echo  '<div class="text-center text-success">categorie ajoutée avec succès</div>';
	}

		if($_POST['action']=='afficher'){
        $id_cat = $_POST['id'];
        $rp = $db->query("SELECT * FROM categories WHERE id_cat=$id_cat");
        $rep = $rp->fetchAll();

        foreach($rep AS $row){

          $data['nom']=$row['libelle_cat'];
          $data['id_cat']=$row['id_cat'];

        }

        echo json_encode($data);

      }

		if($_POST['action']=='modifier'){

		$id_cat = $_POST['id_cat'];
		$nom = $_POST['nom'];
		$req = $db->prepare("UPDATE categories SET libelle_cat=? WHERE id_cat=? ");
		$req->execute(array($nom,$id_cat));

			echo "mise à jour effectuée avec succès";

	}

		if($_POST['action']=='supprimer'){

			$id_cat = $_GET['id_cat'];
			$req = $db->prepare("DELETE FROM categories  WHERE id_cat=? ");
			$req->execute(array($id_cat));
				echo "La catégorie a été supprimée avec succès";
		}

}

?>