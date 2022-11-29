<?PHP

       include('controle.php');
    
?>
<!doctype html>
<html>
<head>
    <title>LG</title>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body class="bg-info">

         <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">UTILISATEUR</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-right"><button class="btn btn-success btn-sm ajout" data-toggle="modal" data-target="#ajoutLiv" >créer un utilisateur</button></div>

                            <!-- debut modal-->
                            <div class="modal fade" id="ajoutLiv" tabindex="-1" role="dialog" aria-labelledby="ajoutLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="ajoutLabel">Edition utlisateur</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="post" action="" id="form_user">
                                      <div class="form-group">
                                        <label for="user" class="col-form-label">Nom d'utilisateur</label>
                                        <input type="text" name="user" class="form-control form-control-sm" id="user" >
                                        <span id="erreur_user" class="text-danger"></span>
                                      </div>
                                      <div class="form-group">
                                        <label for="pass" class="col-form-label">Mot de passe</label>
                                        <input type="password" name="pass" class="form-control form-control-sm" id="pass" >
                                        <span id="erreur_pass" class="text-danger"></span>
                                      </div>
                                      <div class="form-group">
                                        <label for="repass" class="col-form-label">repeter mot de passe</label>
                                        <input type="password" name="repass" class="form-control form-control-sm" id="repass" >
                                        <span id="erreur_repass" class="text-danger"></span>
                                      </div>
                                      <div class="form-group">
                                        <label for="type" class="col-form-label">Type d'utilisateur</label>
                                        <select type="text" name="type" class="form-control form-control-sm" id="type" >
                                            <option value=""></option>
                                            <option value="admin">Administrateur</option>
                                            <option value="caissiere">Caissière</option>

                                        </select>
                                        <span id="erreur_type" class="text-danger"></span>
                                      </div>
                                      </div>
                                      <div class="modal-footer">
                                        <div id="action_message" style="margin-right: 15px;"></div>
                                        <div id="erreur_mdp" class="text-danger" style="margin-right: 15px;"></div>
                                        <input type="hidden"  name="action" value="inserer">
                                        <input type="hidden"  name="id_cache" value="id_cache">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Enregister">
                                      </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                             <!-- fin modal-->
                            
                            <div class="table-responsive" style="margin-top: 5px;">
                                <table class="table table-bordered table-striped table-sm" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nom d'utilisateur</th>
                                            <th>Mot de passe</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                
                        </div>          
                    </div>
                </div>
            </div>
        </div>                            
    </div>
        <?php include('footer.php') ?>
        <script src="assets/js/user.js"></script>
        
    </body>
</html>



