<?PHP
     include('controle.php');
    
    require 'connexion.php';
    $limit = 7;

    $dem = $db->query("SELECT com.id_cmd,com.date_cmd,com.montant,cl.noms_cl,cl.id_cl FROM commande AS com LEFT JOIN clients AS cl ON com.id_cl=cl.id_cl ORDER BY com.id_cmd DESC");

    $nb_page = $dem->rowcount();
    $total_page = ceil($nb_page / $limit);

?>
<!doctype html>
<html>
<head>
    <title>LGC</title>
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

        <div class="container" style="margin-top: 7%; margin-bottom: 7%;">
            <div class="row">
              <div class="col">
                <div class="card">
                  <div class="card-header">
                    <h5 class="text-center mb-0">LISTE DES VENTES</h5>
                  </div>
                  <div class="card-body">
                      <div class="text-right"><button  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ajoutvente" ><i class="fa fa-plus"></i> Nouvelle vente</button></div>

                    
                    <div class="modal fade" id="ajoutvente" tabindex="-1" role="dialog" aria-labelledby="ajoutLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ajoutLabel">nouvelle vente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="post" id="form_client">
                              <p>
                                <label for="client_id" class="col-form-label">Client</label>
                                <select class="form-control" name="client_id" id="client_id" >
                                    <option value=""></option>
                                        <?php $prod = $db->query("SELECT * FROM clients");
                                                     while($mat = $prod->fetch()){ ?> 
                                    <option value="<?php echo $mat['id_cl'] ?>"><?php echo $mat['noms_cl'] ?></option> 
                                 
                                        <?php } ?>
                                </select> 
                                <span id="erreur_client" class="text-danger"></span>   
                              </p>
                          </div>
                              <div class="modal-footer">
                                <div id="message"></div>
                                <input type="hidden" name="action" id="action" value="inserer">
                                <input type="hidden" name="id_cache" id="id_cache" >
                                <input type="submit" name="valider" id="valider" class="btn btn-success btn-sm" value="Enregister">
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  
                    <div class="table-responsive" style="margin-top: 5px;">
                        <table class="table table-bordered table-striped table-sm" id="tab_vente">
                            <thead>
                                <tr>
                                    <th width="10%">N° vente</th>
                                    <th>client</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>   
                        </table>           
                    </div>   
                  </div>
                </div>
                
              </div>
              
            </div>    
                  
        
      </div>  
        <?php include('footer.php') ?>
        <script src="assets/js/vente.js"></script>
    </body>
</html>



        