<?php
    include('connexion.php');
    //On détermine la date, le mois et l'année
    $tab_mois = array('','janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
	$date_jour = date("d").' '.$tab_mois[date("n")].' '.date("Y");
    
    //On reçoit les données du modal
    $produit = $_POST['produit']; echo'<br />';
    $qnte = $_POST['quantite'];echo'<br />';
    $categorie = $_POST['categorie'];echo'<br />';

    $date_sortie = date('Y-n-d');
    $mois_sortie = $tab_mois[date("n")];
    $annee_sortie = date('Y');

    //On retrouve le solde de la matière par rapport à la catégorie
    $solde_produit = "SELECT * FROM production WHERE id_pdt = $produit AND id_cat = $categorie ORDER BY id DESC LIMIT 1";
    $req = $db -> query($solde_produit);
    $nombre = $req -> rowCount();
    $row = $req->fetch();

    if($nombre == 0)
        {
            $solde = 0;
        }
    else
        {
            $solde = $row['qnte_rest'];
        }

    //On calcule les stock
    $stock_init = $solde;
    $stock_sortie = $qnte;
    $stock_fin = $solde - $qnte;
    $stock_ent = 0;

    //On récupère le prix unitaire du produit
    $prix_prod = "SELECT prix FROM produits WHERE id_prod = $produit AND id_cat = $categorie";
    $req_prod = $db -> query($prix_prod);
    $row = $req_prod->fetch();
    $prix_uni_prod = $row['prix'];

    //On calcule le prix total
    $prix_tot_prod = $qnte * $prix_uni_prod;

    //On insert les données dans la base de données
    $ajout = $db -> prepare("INSERT INTO production (id_pdt,qnte_init,qnte_ent,qnte_vend,qnte_rest,prix_uni,prix_tot,id_cat,date_production,mois_production,an_production) 
    VALUES(:id_pdt,:qnte_init,:qnte_ent,:qnte_vend,:qnte_rest,:prix_uni,:prix_tot,:id_cat,:date_production,:mois_production,:an_production)");
    $ajout -> execute(array(
        ':id_pdt' => $produit,
        ':qnte_init' => $stock_init,
        ':qnte_ent' => $stock_ent,
        ':qnte_vend' => $stock_sortie,
        ':qnte_rest' => $stock_fin,
        ':prix_uni' => $prix_uni_prod,
        ':prix_tot' => $prix_tot_prod,
        'id_cat' => $categorie,
        ':date_production' => $date_sortie,
        ':mois_production' => $mois_sortie,
        ':an_production' => $annee_sortie
    ));

    header('location:journal_production.php');
?>