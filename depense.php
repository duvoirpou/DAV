<?PHP
    include('controle.php');
    require 'connexion.php';
    /* $requette = $db->query("SELECT * FROM produits WHERE stock BETWEEN 1 AND 5 ");
    $pa = $requette->rowcount(); */
?>

<!doctype html>
<html>
    <head>
        <title>accueil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body class="bg-info">
        <?PHP include('menu.php') ?>
    <div class="container"  style="margin-top: 7%;margin-bottom:7%;">
        <div class="card border-primary" style="color:rgb(7,7,7);margin-top: 2%;">
            <div class="card-header">
                <h5 class="text-center mb-0">FAIRE UNE DEPENSE</h5>
            </div>
            <div class="card-body">
                <form method="post" id="depense"  action="save_depense.php">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="libelle">Libelle</label>
                                <input type='text' name='libelle' class="form-control form-control-sm" placeholder="Libelle" id="libelle" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mt_ch">Montant en chiffre</label>
                                <input type='number' name='mt_ch' placeholder="Montant en chiffre" class="form-control form-control-sm" id="mt_ch" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mt_let">Montant en lettre</label>
                                <input type='text' name='mt_let' placeholder="Montant en lettre" class="form-control form-control-sm" id="mt_let" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="benef">Bénéficiaire</label>
                                <input type='text' name='benef' placeholder="Bénéficiaire" class="form-control form-control-sm" id="benef" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col">
                            <div class="pull-right">
                                <!--<input type="hidden" name="matricule" id="matricule" />
                                <input type="hidden" name="operation" id="operation" value="ajouter" />-->
                                <input type="submit" name="action" id="action" value="Enregistrer" class="btn btn-success btn-sm" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <?php include('footer.php') ?>
        <script src="assets/js/saisir_recette.js"></script>
        <script src="assets/js/saisir_recette.js"></script>
    </body>
</html>