<?PHP
session_start();
    require 'connexion.php';
    $requette = $db->query("SELECT * FROM clients");
    $rep = $requette->fetchAll();


?>
<!doctype html>
<html>
<head>
    <title>gestock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body>
        <div class="container">

            <?PHP include('menu.php') ?>
                <br />
                <div class="text-center"><h5>LISTE DES COMMANDES DE VENTE</h5></div>
                <br />
            <div class="text-right" style="margin-bottom: 5px;">
                <button type="button" name="ajout" class="btn btn-success btn-sm" id="ajout">ajouter</button>
            </div>
            <div id="list" class="table-responsive">
                
            </div>
            <div id="message" title="Donnée ajoutée">
                <form method="post" id="commande">
                    <div class="form-group">
                        <label for="id">Client</label>
                        <select name="id" id="id" class="form-control">
                            <option value=""></option>
                            <?php foreach ($rep as $row) { ?>
                                <option value="<?php echo $row['id_cl'] ?>"><?php echo $row['noms_cl'] ?></option>
                          <?php  } ?>
                        </select>
                        <span id="erreur_client" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" />
                        <span id="erreur_date" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="action" id="action" value="insert" />
                        <input type="hidden" name="id_cache" id="id_cache" />
                        <input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
                    </div>
                </form> 
            </div>

            <div id="action_alert" title="Action">
                
            </div>
 

            <?php include('footer.php') ?>
        </div>
    </body>
</html>



        