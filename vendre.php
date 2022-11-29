<?php
    require_once('connexion.php');

    //On récupère le libelle produit, l'id catégorie et l'id recette
    $id_recette = $id_recette;
    $id_cat = $id_cat;
    $libelle = $libelle;

    //On retrouve l'id du produit
    $check_id = $db->query("SELECT produits.id_prod FROM produits WHERE produits.description = $libelle");                      
    while($resultat = $find_id -> fetch()) 
        {
            $id_prod = $resultat['id_prod'];
        }

    echo$id_prod;

?>