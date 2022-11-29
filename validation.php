<?php
session_start();
require 'connexion.php';
$id_user = $_SESSION['id'];

$total = $_SESSION["total"];
$caissiere = $_SESSION["user"];
$id_client = $_POST["id_client"];
$avance = $_POST["avance"];

$tab_mois = array('', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'decembre');
$date_jour = date("d") . '-' . $tab_mois[date("n")] . '-' . date("Y");
$mois = $tab_mois[date("n")];

$annee = date('Y');
$date = date('Y-m-d');
$heure = date('H:i:s');

$req=$db->prepare("INSERT INTO recette(id_client, montant, avance, date_recette, heure_recette, mois_recette, annee_recette, caissiere) VALUES($id_client,$total,$avance,'$date','$heure','$mois','$annee','$caissiere') ");
$req->execute();

$id_recette = $db->lastInsertId();
$id_cat = $_POST["id_cat"];
$produit = $_POST["id_prod"];
$libelle=$_POST["description"];
$qte=$_POST["qte"];
$pu=$_POST["pu"];
$pt=$_POST["pt"];
$solde=$_POST["stock"];

for($i=0; $i < count($libelle); $i++)
{
	$data = array(
		':id_recette' => $id_recette,
		':id_cat' => $id_cat[$i],
		':libelle' => $libelle[$i],
		':qte' => $qte[$i],
		':pu' => $pu[$i],
		':pt' => $pt[$i]
	);





//var_dump($si); exit;

$stock_sortie = $qte[$i];
$stock_ent = 0;
$stock_fin = ($solde[$i] + $stock_ent) - $qte[$i];


//On met la table produits à jour
$ajour_prod = $db->query("UPDATE produits SET stock=$stock_fin WHERE id_prod=$produit[$i]");

//On calcule le prix total
$prix_tot_prod = $stock_fin  * $pu[$i];
$user =$_SESSION['type'];


$contr = $db->query("SELECT * FROM production WHERE date_production ='$date' AND id_pdt=$produit[$i]");
$verif= $contr->rowCount();

if($verif==0)
{
	$si=$solde;
}
else
{
	$qte_init = $db->query("SELECT qnte_init FROM production WHERE date_production ='$date' AND id_pdt=$produit[$i] ORDER BY id ASC LIMIT 1");
	$rep_init = $qte_init->fetch();
	$si= $rep_init["qnte_init"];

}

//var_dump($si[$i]); exit;

//On réalise la boucle pour inserer les données
	$datas = array(
		':id_pdt' => $produit[$i],
		':qnte_init' => $si,
		':qnte_ent' => $stock_ent,
		':qnte_vend' => $qte[$i],
		':qnte_rest' => $stock_fin,
		':prix_uni' => $pu[$i],
		':prix_tot' => $prix_tot_prod,
		'id_cat' => $id_cat[$i],
		':date_production' => $date,
		':mois_production' => $mois,
		':an_production' => $annee,
		':user' => $user
	);

	//var_dump($datas); exit;

	//On insert les données dans la base de données
	$ajout = $db -> prepare("INSERT INTO production (id_pdt,qnte_init,qnte_ent,qnte_vend,qnte_rest,prix_uni,prix_tot,id_cat,date_production,mois_production,an_production,user)
	VALUES(:id_pdt,:qnte_init,:qnte_ent,:qnte_vend,:qnte_rest,:prix_uni,:prix_tot,:id_cat,:date_production,:mois_production,:an_production,:user)");
	$ajout -> execute($datas);



}

$rd=$db->query("DELETE FROM panier WHERE id_user = $id_user && mvt='sortie'");

$message ='<h6 class="text-success">Validation effectuée</6>';
$bouton = '<div class="text-center"><a class="btn btn-info btn-sm" href="recu.php?p='.htmlspecialchars($id_recette).'" target="_blank">Imprimer le reçu</a></div>';

$reponse['message'] = $message;
$reponse['bouton'] = $bouton;



echo json_encode($reponse);

?>