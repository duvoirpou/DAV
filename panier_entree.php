<?php
session_start();
include('connexion.php');

$id_user = $_SESSION['id'];

  if(isset($_POST['action'])){

    if($_POST['action']=="ajouter"){
        $qte = $_POST['qte'];
        $id_prod = htmlentities(trim(strip_tags($_POST['id_prod2'])));
        $prix = $_POST['prix'];
        $id_cat = $_POST['id_cat2'];





        $pt = $qte * $prix;

        $req = $db->prepare("INSERT INTO panier (id_prod, id_cat, qte, pu, pt,id_user,mvt) VALUES($id_prod, $id_cat, $qte, $prix, $pt,$id_user,'entree')");

        if($req->execute()){

           echo  '<div class="text-center text-success">produit ajouté au panier</div>';
        }
        else
        {
             echo  'echec d\'enregistrement';
        }




}

        if($_POST['action']=='supprimer'){

        $id_panier = $_POST['id_panier'];
        $rp = $db->query("DELETE FROM panier WHERE id=$id_panier");
      }

       if($_POST['action']=='annuler'){

        $rd=$db->query("DELETE FROM panier WHERE id_user = $id_user && mvt='entree'");
      }
	}
?>