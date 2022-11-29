<?php
    include('connexion.php');
    
    //On reçoit les données du modal
    $desig_mat = $_POST['desig_mat'];
    $mt_mat = $_POST['mt_mat'];
    $fournisseur = $_POST['fourn'];
    $categ = $_POST['categorie'];

    //On insert les données dans la base de données
    $ajout = $db -> prepare("INSERT INTO matiere_premiere(libelle,montant,fournisseur,id_cat) VALUES (:libelle,:montant,:fournisseur,:id_cat)");
    $ajout -> execute(array(
        ':libelle' => $desig_mat,
        ':montant' => $mt_mat,
        ':fournisseur' => $fournisseur,
        ':id_cat' => $categ
    ));

    header('location:matiere.php');
?>