<?php
session_start();
require 'connexion.php';
$id_user = $_SESSION['id'];

$total = $_SESSION["total"];
$caissiere = $_SESSION["user"];

$tab_mois = array('', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'decembre');
$date_jour = date("d") . '-' . $tab_mois[date("n")] . '-' . date("Y");
$mois = $tab_mois[date("n")];

$annee = date('Y');
$date = date('Y-m-d');
$heure = date('H:i:s');


$id_cat = $_POST["id_cat"];
$produit = $_POST["id_prod"];
$libelle=$_POST["description"];
$qte=$_POST["qte"];
$pu=$_POST["pu"];
$pt=$_POST["pt"];
$solde=$_POST["stock"];

for($i=0; $i < count($libelle); $i++)
{







//var_dump($solde); exit;


$stock_fin = $solde[$i] - $qte[$i];
$stock_ent = 0;
$stock_sortie = $qte[$i];

//On met la table produits à jour
$ajour_prod = $db->query("UPDATE produits SET stock=$stock_fin WHERE id_prod=$produit[$i]");

//On calcule le prix total
$prix_tot_prod = $stock_fin * $pu[$i];
$user =$_SESSION['type'];

$contr = $db->query("SELECT * FROM production WHERE date_production ='$date' AND id_pdt=$produit[$i]");
$verif= $contr->rowCount();

if($verif==0)
{
	$si=$solde[$i];
}
else
{
	$qte_init = $db->query("SELECT qnte_init FROM production WHERE date_production ='$date' AND id_pdt=$produit[$i] ORDER BY id ASC LIMIT 1");
	$rep_init = $qte_init->fetch();
	$si= $rep_init["qnte_init"];

}

//On réalise la boucle pour inserer les données
	$datas = array(
		':id_pdt' => $produit[$i],
		':qnte_init' => $si,
		':qnte_ent' => 0,
		':qnte_vend' =>  $stock_sortie,
		':qnte_rest' => $stock_fin,
		':prix_uni' => $pu[$i],
		':prix_tot' => $prix_tot_prod,
		'id_cat' => $id_cat[$i],
		':date_production' => $date,
		':mois_production' => $mois,
		':an_production' => $annee,
		':user' => $user
	);


	//On insert les données dans la base de données
	$ajout = $db -> prepare("INSERT INTO production (id_pdt,qnte_init,qnte_ent,qnte_vend,qnte_rest,prix_uni,prix_tot,id_cat,date_production,mois_production,an_production,user)
	VALUES(:id_pdt,:qnte_init,:qnte_ent,:qnte_vend,:qnte_rest,:prix_uni,:prix_tot,:id_cat,:date_production,:mois_production,:an_production,:user)");
	//var_dump($datas); exit;
	$ajout -> execute($datas);
}

$rd=$db->query("DELETE FROM panier WHERE id_user = $id_user && mvt='entree'");

$message ='<h6 class="alert alert-success">Validation effectuée</h6>';

$reponse['message'] = $message;

echo json_encode($reponse);

?>