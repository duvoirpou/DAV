 <?PHP
        session_start();
 
    if(!isset($_SESSION['user'])){
        header('location:index.php');
    } 
   
    require 'connexion.php';
    
   
    if(isset($_POST['vente'])){
        $cmd = $_POST['cmd'];
        $id_cl = $_POST['cl'];
        $client = $_POST['client'];
        

        $_SESSION['id_cmd'] = $cmd;
        $_SESSION['client'] = $client;
        $_SESSION['id_cl'] = $id_cl;
      }
    
      $client = $_SESSION['client'];
      $cmd =  $_SESSION['id_cmd'];
      $id_cl = $_SESSION['id_cl'];
       
?>
<!DOCTYPE html>
<html>
<head>
    <title>gestock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.theme.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
     <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body class="bg-info">

        <?PHP include('menu.php') ?>
      <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
        <div class="row">
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h6 class="text-center mb-O">DETAILS VENTE</h6>
              </div>
              <div class="card-body">

                
                  <form method="post" action="#" id="form">
                    <div class="form-row align-items-center">
                      <div class="col-1">
                        <label for="client" class="col-form-label">Client:</label>
                      </div>
                      <div class="col">
                        <input type="text" readonly="" name="client" value="<?php echo $client ?>" class="form-control form-control-sm" >
                      </div>
                      <div class="col-1">
                        <label for="id_cmd" class="col-form-label">Facture N°:</label>
                      </div>
                      <div class="col">
                        <input readonly class="form-control form-control-sm" name="id_cmd" id="id_cmd" value="<?php echo $cmd ?>" >
                      </div>
                    </div>
                     <div class="form-row align-items-center">
                      <div class="col-1">
                        <label for="client" class="col-form-label">Produit:</label>
                      </div>
                      <div class="col">
                        <input type="text" id="recherche" placeholder="rechercher le produit" class="form-control form-control-sm">
                        <input type="hidden" name="id_prod" id="id_prod" class="form-control form-control-sm" >
                        <span id="erreur_produit" class="text-danger"></span>
                      </div> 
                      <div class="col-1">
                        <label for="id_cmd" class="col-form-label">Quantité:</label>
                      </div>
                      <div class="col">
                         <input type="number"  class="form-control form-control-sm" name="qte" id="qte" >
                            <span id="erreur_qte" class="text-danger"></span>
                      </div>
                    </div> 
                    <div class="form-group" style="text-align: right;margin-top: 3px;">
                       <input type="hidden" name="action" id="action" value="ajout">
                          <input type="hidden" name="hidden_id" id="hidden_id">
                          <input type="submit" name="produit" id="produit" class="btn btn-success btn-sm" value="Ajouter">
                    </div>  
                      <div id="resultat" style="margin-left:8%; width:40%;"></div>  
                       
                  <div id="message"></div>
                <div class="table-responsive">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th width="80">IP PROD</th><th>DESIGNATION</th><th>QTE</th><th>PU</th><th>PT</th><th width="120">OPERATION</th>
                      </tr>
                    </thead>
                    <tbody id="listeVente">
                    </tbody>
                  </table>
                </div>
                    <div id="delete_message" title="confirmation suppression">
                     <p>Etes vous sûr de vouloir supprimer cette entrée ?</p>
                    </div>
                    
              </div>
            </div>
          </div>
        </div>  
            
        

              
        </div>
            
            <?php include('footer.php') ?>
            <script src="assets/js/detail-vente.js"></script>
    </body>
</html> 



        
 
               