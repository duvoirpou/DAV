<?php
    include('connexion.php');
    //On détermine la date, le mois et l'année
    $tab_mois = array('','janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
	$date_jour = date("d").' '.$tab_mois[date("n")].' '.date("Y");
    
    //On reçoit les données du modal
    $mat = $_POST['matiere']; echo'<br />';
    $cat = $_POST['categorie'];echo'<br />';
    $qnte = $_POST['quantite'];echo'<br />';

    $date_ajout = date('Y-n-d');echo'<br />';
    $mois_ajout = $tab_mois[date("n")];echo'<br />';
    $annee_ajout = date('Y');echo'<br />';

    //On retrouve le solde de la matière par rapport à la catégorie
    $solde_mat = "SELECT * FROM stock WHERE id_mat = $mat AND id_cat = $cat ORDER BY ref DESC LIMIT 1";
    $req = $db -> query($solde_mat);
    $row = $req->fetch();

    $solde = $row['solde'];

    //On calcule les stock
    $stock_init = $solde;echo'<br />';
    $stock_ent = $qnte;echo'<br />';
    $stock_fin = $solde + $qnte;echo'<br />';
    $sotck_sortie = 0;echo'<br />';

    //On insert les données dans la base de données
    $ajout = $db -> prepare("INSERT INTO stock(id_mat,id_cat,stock,entree,sortie,solde,date_st,mois_st,an_st) 
    VALUES(:id_mat,:id_cat,:stock,:entree,:sortie,:solde,:date_st,:mois_st,:an_st)");
    $ajout -> execute(array(
        ':id_mat' => $mat,
        ':id_cat' => $cat,
        ':stock' => $solde,
        ':entree' => $qnte,
        ':sortie' => $sotck_sortie,
        ':solde' => $stock_fin,
        ':date_st' => $date_ajout,
        ':mois_st' => $mois_ajout,
        ':an_st' => $annee_ajout
    ));

    header('location:journal_stock.php');
?>