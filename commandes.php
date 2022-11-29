<?php
    session_start();
    require 'connexion.php';
    $id_user = $_SESSION['id'];
    include("fonction_client.php");
    $req = $db->query("SELECT panier.id, panier.id_prod, panier.id_cat, panier.qte, panier.pu, panier.pt, produits.description, produits.stock FROM panier JOIN produits ON panier.id_prod=produits.id_prod WHERE panier.id_user = $id_user && panier.mvt='sortie'");

    $tot = $db->query("SELECT SUM(pt) AS total FROM panier  WHERE id_user = $id_user && mvt='sortie'");
    $reponse = $tot->fetch();
    $total = $reponse["total"];

    $_SESSION["total"] =  $total;






?>
<form action="" id="valider">
    <div class="form-group row">
        <div class="col">
            <select name="id_client" id="id_client" class="form-control form-control-sm">
                <?php echo affiche_client(); ?>
            </select>
        </div>
        <div class="col-3">
            <button type="button" class="btn btn-success btn-sm" id="cree_client">Ajoutez un client</button>
        </div>
    </div>

    <div class="form-group row">
        <div class="col">
            <label for="nbre_tissus">Nombre de tissus</label>
            <input type="number" class="form-control form-control-sm" name="nbre_tissus" id="nbre_tissus"
                aria-describedby="helpId" placeholder="Nombre de tissus">
        </div>
        <div class="col">
            <label for="modele">Modele</label>
            <input type="text" class="form-control form-control-sm" name="modele" id="modele" aria-describedby="helpId"
                placeholder="Model">
        </div>
        <div class="col">
            <label for="date_retrait">Date de retrait</label>
            <input type="date" class="form-control form-control-sm" name="date_retrait" id="date_retrait" aria-describedby="helpId" placeholder="Date de retrait">
        </div>
        <div class="col">
            <label for="col">Col</label>
            <input type="text" class="form-control form-control-sm" name="col" id="col" aria-describedby="helpId" placeholder="col">
        </div>
    </div>

    <div class="form-group row">
        <div class="col">
            <label for="epaule">Epaule</label>
            <input type="text" class="form-control form-control-sm" name="epaule" id="epaule"
                aria-describedby="helpId" placeholder="Epaule">
        </div>
        <div class="col">
            <label for="poitrine">Poitrine</label>
            <input type="text" class="form-control form-control-sm" name="poitrine" id="poitrine" aria-describedby="helpId" placeholder="Poitrine">
        </div>
        <div class="col">
            <label for="ventre">Ventre</label>
            <input type="text" class="form-control form-control-sm" name="ventre" id="ventre"
                aria-describedby="helpId" placeholder="ventre">
        </div>
        <div class="col">
            <label for="bassin">Bassin</label>
            <input type="text" class="form-control form-control-sm" name="bassin" id="bassin" aria-describedby="helpId" placeholder="Bassin">
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <label for="ceinture">Ceinture</label>
            <input type="text" class="form-control form-control-sm" name="ceinture" id="ceinture"
                aria-describedby="helpId" placeholder="ceinture">
        </div>
        <div class="col">
            <label for="cuisse">Cuisse</label>
            <input type="text" class="form-control form-control-sm" name="cuisse" id="cuisse" aria-describedby="helpId" placeholder="cuisse">
        </div>
        <div class="col">
            <label for="bas_pied">Bas de pied</label>
            <input type="text" class="form-control form-control-sm" name="bas_pied" id="bas_pied"
                aria-describedby="helpId" placeholder="Bas de pied">
        </div>
        <div class="col">
            <label for="longueur_manche">Longueur manches</label>
            <input type="text" class="form-control form-control-sm" name="longueur_manche" id="longueur_manche" aria-describedby="helpId" placeholder="longueur_manche">
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <label for="tour_manche">Tour de manche</label>
            <input type="text" class="form-control form-control-sm" name="tour_manche" id="tour_manche" aria-describedby="helpId" placeholder="tour de manche">
        </div>
        <div class="col">
            <label for="tour_poignet">Tour de poignet</label>
            <input type="text" class="form-control form-control-sm" name="tour_poignet" id="tour_poignet" aria-describedby="helpId" placeholder="tour de poignet">
        </div>
        <div class="col">
            <label for="tour_manche">Tour de manche</label>
            <input type="text" class="form-control form-control-sm" name="tour_manche" id="tour_manche" aria-describedby="helpId" placeholder="tour de manche">
        </div>
        <div class="col">
            <label for="tour_poignet">Tour de poignet</label>
            <input type="text" class="form-control form-control-sm" name="tour_poignet" id="tour_poignet" aria-describedby="helpId" placeholder="tour de poignet">
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <label for="tour_taille">Tour de taille</label>
            <input type="text" class="form-control form-control-sm" name="tour_taille" id="tour_taille" aria-describedby="helpId" placeholder="tour de taille">
        </div>
        <div class="col">
            <label for="contour_tete">Contour tête</label>
            <input type="text" class="form-control form-control-sm" name="contour_tete" id="contour_tete" aria-describedby="helpId" placeholder="contour tête">
        </div>
        <div class="col">
            <label for="longueur_chemise">Longueur chemise</label>
            <input type="text" class="form-control form-control-sm" name="longueur_chemise" id="longueur_chemise" aria-describedby="helpId" placeholder="longueur chemise">
        </div>
        <div class="col">
            <label for="longueur_pantalon">Longueur pantalon</label>
            <input type="text" class="form-control form-control-sm" name="longueur_pantalon" id="longueur_pantalon" aria-describedby="helpId" placeholder="longueur pantalon">
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <label for="sens_seins">Sens des seins</label>
            <input type="text" class="form-control form-control-sm" name="sens_seins" id="sens_seins" aria-describedby="helpId" placeholder="Sens des seins">
        </div>
        <div class="col">
            <label for="pince">Pince</label>
            <input type="text" class="form-control form-control-sm" name="pince" id="pince" aria-describedby="helpId" placeholder="pince">
        </div>
        <div class="col">
            <label for="longueur_haut">Longueur haut</label>
            <input type="text" class="form-control form-control-sm" name="longueur_haut" id="longueur_haut" aria-describedby="helpId" placeholder="longueur haut">
        </div>
        <div class="col">
            <label for="longueur_juppe">Longueur juppe</label>
            <input type="text" class="form-control form-control-sm" name="longueur_juppe" id="longueur_juppe" aria-describedby="helpId" placeholder="longueur juppe">
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <label for="longueur_robe">Longueur robe</label>
            <input type="text" class="form-control form-control-sm" name="longueur_robe" id="longueur_robe" aria-describedby="helpId" placeholder="longueur robe">
        </div>
        <div class="col">
            <label for="longueur_culotte">Longueur culotte</label>
            <input type="text" class="form-control form-control-sm" name="longueur_culotte" id="longueur_culotte" aria-describedby="helpId" placeholder="longueur culotte">
        </div>
        <div class="col">
            <label for="longueur_fente">Longueur fente</label>
            <input type="text" class="form-control form-control-sm" name="longueur_fente" id="longueur_fente" aria-describedby="helpId" placeholder="longueur fente">
        </div>
        <div class="col">
            <label for="genre">Genre</label>
            <select class="form-control form-control-sm" id="genre" name="genre">
                <option value=""></option>
                <option value="1">Homme</option>
                <option value="2">Femme</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <label for="remarques">Remarques</label>
            <textarea name="remarques" id="remarques" cols="30" rows="5" class="form-control form-control-sm"></textarea>
        </div>


    </div>


    <div class="form-group row">
    <div class="col">
        <input type="number" name="montant" id="montant" value="" placeholder="Montant à payé" class="form-control">
    </div>
    <div class="col">
        <input type="number" name="avance" id="avance" value="" placeholder="Montant payé" class="form-control">
    </div>
        <button type="submit" class="btn btn-success">Valider la commande</button>
    </div>

</form>
<br>
<div class="text-center">
    <button type="button" class="btn btn-danger" id="annuler">Annuler la commande</button>
</div>