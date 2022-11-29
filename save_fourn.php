<?php
    include('connexion.php');
    
    //On reçoit les données du modal
    $raison_soc = $_POST['raison_soc'];
    $ad_fourn = $_POST['ad_fourn'];
    $tel_fourn = $_POST['tel_fourn'];
    $responsable = $_POST['responsable'];

    //On insert les données dans la base de données
    $ajout = $db -> prepare("INSERT INTO fournisseur(raison_sociale,adresse,contact,responsable) VALUES (:raison_sociale,:adresse,:contact,:responsable)");
    $ajout -> execute(array(
        ':raison_sociale' => $raison_soc,
        ':adresse' => $ad_fourn,
        ':contact' => $tel_fourn,
        ':responsable' => $responsable
    ));

    header('location:fournisseur.php');
?>