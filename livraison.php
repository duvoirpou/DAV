<?PHP
    include('controle.php');
    require 'connexion.php';
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
    <body onload="afficheLiv()" class="bg-info">
      <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h5 class="text-center mb-0">LISTE DES COMMANDES D'ACHAT</h5>
                </div>
                <div class="card-body">
                     <div class="text-right"><button  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ajoutLiv" ><i class="fa fa-plus"></i> Ajouter une commande</button></div>


                    <div class="modal fade" id="ajoutLiv" tabindex="-1" role="dialog" aria-labelledby="ajoutLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ajoutLabel"> Ajouter une commande</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form>
                              <div class="form-group">
                                <label for="date" class="col-form-label">Date</label>
                                <input type="date"  class="form-control" id="date" >
                              </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" onclick="ajoutLiv()" class="btn btn-primary">Enregister</button>
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>

                    <div id="result"></div>
                        <p></p> 
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead align="center">
                                <tr>
                                    <th width="50">Id</th>
                                    <th>Date de livraison</th>
                                    <th>Montant</th>
                                    <th width="60">modifier</th>
                                    <th width="60">Details</th>
                                </tr>
                            </thead>
                            <tbody align="center"></tbody>
                        </table>
                    </div>
    
                </div>
              </div>
            </div>
            
          </div>  
            
                
               
           
    </div>
         <?php include('footer.php') ?>
        <script src="assets/js/livraison.js"></script>
    </body>
</html>



