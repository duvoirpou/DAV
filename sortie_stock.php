<?php
    include('connexion.php');
    //On détermine la date, le mois et l'année
    $tab_mois = array('','janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
	$date_jour = date("d").' '.$tab_mois[date("n")].' '.date("Y");
    
    //On reçoit les données du modal
    $mat = $_POST['matiere'];
    $cat = $_POST['categorie'];
    $qnte = $_POST['quantite'];

    $date_sortie = date('Y-n-d');
    $mois_sortie = $tab_mois[date("n")];
    $annee_sortie = date('Y');

    //On retrouve le solde de la matière par rapport à la catégorie
    $solde_mat = "SELECT * FROM stock WHERE id_mat = $mat AND id_cat = $cat ORDER BY ref DESC LIMIT 1";
    $req = $db -> query($solde_mat);
    $row = $req->fetch();

    $solde = $row['solde'];

    //On calcule les stock
    $stock_sortie = $qnte;
    $stock_fin = $solde - $qnte;
    $stock_ent = 0;

    //On insert les données dans la base de données
    $ajout = $db -> prepare("INSERT INTO stock(id_mat,id_cat,stock,entree,sortie,solde,date_st,mois_st,an_st) 
    VALUES(:id_mat,:id_cat,:stock,:entree,:sortie,:solde,:date_st,:mois_st,:an_st)");
    $ajout -> execute(array(
        ':id_mat' => $mat,
        ':id_cat' => $cat,
        ':stock' => $solde,
        ':entree' => $stock_ent,
        ':sortie' => $qnte,
        ':solde' => $stock_fin,
        ':date_st' => $date_sortie,
        ':mois_st' => $mois_sortie,
        ':an_st' => $annee_sortie
    ));

    header('location:journal_stock.php');
?>