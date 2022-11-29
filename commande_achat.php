<?php
    session_start();
    require 'connexion.php';

    $id_user = $_SESSION['id'];
    $req = $db->query("SELECT panier.id, panier.id_prod, panier.id_cat, panier.qte, panier.pu, panier.pt, produits.description, produits.stock FROM panier JOIN produits ON panier.id_prod=produits.id_prod WHERE panier.id_user = $id_user && panier.mvt='entree'");

    $tot = $db->query("SELECT SUM(pt) AS total FROM panier WHERE id_user = $id_user && mvt='entree'");
    $reponse = $tot->fetch();
    $total = $reponse["total"];

    $_SESSION["total"] =  $total;






?>
<form action="" id="valider">
<div class="form-group row">

    <!-- <div class="col-3">
        <button type="button" class="btn btn-success btn-sm" id="cree_client">Créez un client</button>
    </div> -->
</div>
<div class="table-responsive">

    <table class="table table-bordered table-sm">

    <tr>
        <th>Libellé</th>
        <th>Qté</th>
        <th>P. U.</th>
        <th>P. T.</th>
        <th>action</th>
    </tr>
    <?php while($resultat=$req->fetch()) { ?>
        <tr>
            <td>
            <input type="hidden" name="id_prod[]" id="id_prod" value="<?= $resultat["id_prod"] ?>" >
            <input type="hidden" name="id_cat[]" id="id_cat" value="<?= $resultat["id_cat"] ?>" >
            <input type="hidden" name="description[]" id="description" value="<?= $resultat["description"] ?>" >
            <input type="hidden" name="stock[]" id="stock" value="<?= $resultat["stock"] ?>" >
            <?= $resultat["description"] ?></td>
            <td><input type="hidden" name="qte[]" id="qte" value="<?= $resultat["qte"] ?>" ><?= $resultat["qte"] ?></td>
            <td><input type="hidden" name="pu[]" id="pu" value="<?= $resultat["pu"] ?>" ><?= $resultat["pu"] ?></td>
            <td><input type="hidden" name="pt[]" id="pt" value="<?= $resultat["pt"] ?>" ><?= $resultat["pt"] ?></td>
            <td><button type="button" class="btn btn-danger btn-sm supprimer" id="<?= $resultat["id"] ?>"><i class="fa fa-trash"></i></button></td>
        </tr>

    <?php } ?>
    <tr>
        <th colspan="3" style="text-align:center;">Total</th>
        <th><?= $total ?></th>
    </tr>



    </table>
</div>
        <div class="text-center">
        <button type="submit" class="btn btn-success">Valider l'entrée</button>
      </div>
</form>
<br>
<div class="text-center">
        <button type="button" class="btn btn-danger" id="annuler">Annuler l'entrée</button>
      </div>
