<?php
session_start();
require 'connexion.php';



$caissiere = $_SESSION["user"];
$id_client = $_POST["id_client"];
$avance = $_POST["avance"];


$nbre_tissus=$_POST["nbre_tissus"];
$modele=$_POST["modele"];
$remarques=$_POST["remarques"];
$date_retrait=$_POST["date_retrait"];
$montant=$_POST["montant"];

$tab_mois = array('', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'decembre');
$date_jour = date("d") . '-' . $tab_mois[date("n")] . '-' . date("Y");
$mois = $tab_mois[date("n")];

$annee = date('Y');
$date = date('Y-m-d');
$heure = date('H:i:s');

// $req=$db->prepare("INSERT INTO recette(id_client, montant, avance, date_recette, heure_recette, mois_recette, annee_recette, caissiere) VALUES($id_client,$total,$avance,'$date','$heure','$mois','$annee','$caissiere') ");
// $req->execute();

$req=$db->prepare("INSERT INTO commande(id_client, nbre_tissus, modele, montant, avance, date_depot, date_retrait, remarques, caissiere) VALUES($id_client,$nbre_tissus,'$modele',$montant,$avance,'$date','$date_retrait', '$remarques','$caissiere') ");
$req->execute();



$id_cmd = $db->lastInsertId();



$epaule=$_POST["epaule"];
$poitrine=$_POST["poitrine"];
$ventre=$_POST["ventre"];
$bassin=$_POST["bassin"];
$ceinture=$_POST["ceinture"];
$cuisse=$_POST["cuisse"];
$bas_pied=$_POST["bas_pied"];
$longueur_manche=$_POST["longueur_manche"];
$tour_manche=$_POST["tour_manche"];
$tour_poignet=$_POST["tour_poignet"];
$tour_taille=$_POST["tour_taille"];
$contour_tete=$_POST["contour_tete"];
$longueur_chemise=$_POST["longueur_chemise"];
$longueur_pantalon=$_POST["longueur_pantalon"];
$sens_seins=$_POST["sens_seins"];
$pince=$_POST["pince"];
$longueur_haut=$_POST["longueur_haut"];
$longueur_juppe=$_POST["longueur_juppe"];
$longueur_robe=$_POST["longueur_robe"];
$longueur_culotte=$_POST["longueur_culotte"];
$longueur_fente=$_POST["longueur_fente"];
$id_genre=$_POST["genre"];
$col=$_POST["col"];


$rec=$db->prepare("INSERT INTO mesures (id_cmd, epaule, poitrine, ventre, bassin, ceinture, cuisse, bas_pied, longueur_manche, tour_manche, tour_poignet, tour_taille, col, contour_tete, longueur_chemise, longueur_pantalon, sens_seins, pince, longueur_haut, longueur_juppe, longueur_robe, longueur_culotte, longueur_fente, id_genre) VALUES ($id_cmd,$epaule,$poitrine,$ventre,$bassin,$ceinture,$cuisse,$bas_pied,$longueur_manche,$tour_manche,$tour_poignet,$tour_taille,$col,$contour_tete,$longueur_chemise,$longueur_pantalon,$sens_seins,$pince,$longueur_haut,$longueur_juppe,$longueur_robe,$longueur_culotte,$longueur_fente,$id_genre) ");

//var_dump($rec); die();
$rec->execute();




// $contr = $db->query("SELECT * FROM production WHERE date_production='$date'");
// $verif= $contr->rowCount();


//var_dump($solde); exit;

// $stock_sortie = $qte[$i];
// $stock_ent = 0;
// $stock_fin = ($solde[$i] + $stock_ent) - $qte[$i];


// //On met la table produits à jour
// $ajour_prod = $db->query("UPDATE produits SET stock=$stock_fin WHERE id_prod=$produit[$i]");

// //On calcule le prix total
// $prix_tot_prod = $qte[$i] * $pu[$i];
// $user =$_SESSION['type'];

// //On réalise la boucle pour inserer les données
// 	$datas = array(
// 		':id_pdt' => $produit[$i],
// 		':qnte_init' => $solde[$i],
// 		':qnte_ent' => $stock_ent,
// 		':qnte_vend' => $qte[$i],
// 		':qnte_rest' => $stock_fin,
// 		':prix_uni' => $pu[$i],
// 		':prix_tot' => $prix_tot_prod,
// 		'id_cat' => $id_cat[$i],
// 		':date_production' => $date,
// 		':mois_production' => $mois,
// 		':an_production' => $annee,
// 		':user' => $user
// 	);

//	if($verif==0){

	//On insert les données dans la base de données
// 	$ajout = $db -> prepare("INSERT INTO production (id_pdt,qnte_init,qnte_ent,qnte_vend,qnte_rest,prix_uni,prix_tot,id_cat,date_production,mois_production,an_production,user)
// 	VALUES(:id_pdt,:qnte_init,:qnte_ent,:qnte_vend,:qnte_rest,:prix_uni,:prix_tot,:id_cat,:date_production,:mois_production,:an_production,:user)");
// 	$ajout -> execute($datas);

// }
// else
// {
// 	$modif = $db -> prepare("UPDATE production SET id_pdt=$produit,qnte_init=$solde,qnte_ent=$stock_ent,qnte_vend=$stock_sortie,qnte_rest=$stock_fin,prix_uni=$pu,prix_tot=$prix_tot_prod,id_cat=$id_cat,date_production='$date',mois_production='$mois',an_production='$annee',user='$user' WHERE  date_production='$date'");
// 	$modif -> execute($datas);
// }





//$rd=$db->query("DELETE FROM panier WHERE id_user = $id_user && mvt='sortie'");

$message ='<h6 class="alert alert-success">Validation effectuée</6>';
$bouton = '<div class="text-center"><a class="btn btn-info btn-sm" href="recus_commandes.php?p='.htmlspecialchars($id_cmd).'" target="_blank">Imprimer le reçu</a></div>';

$reponse['message'] = $message;
$reponse['bouton'] = $bouton;



echo json_encode($reponse);

?>