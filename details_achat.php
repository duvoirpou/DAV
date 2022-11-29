 <?PHP
session_start();
    require 'connexion.php';
    
   
    if(isset($_POST['envoi'])){
        $id_liv = $_POST['id_liv'];
        $date_liv =$_POST['date_liv'];

        $_SESSION['liv']=$id_liv;
        $_SESSION['dt'] = $date_liv;
        
    }
    
     $liv = $_SESSION['liv'];
     $date = $_SESSION['dt']; 

          

            
       


?>
<!doctype html>
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
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center mb-0">DETAILS ACHAT</h6>
                </div>
                <div class="card-body"> 
                
               <div class="table-responsive">
                 
                <table class="table table-bordered table-sm">
                    <form method="post" id="form_achat">
                      <tr>
                        <td style="padding: 15px 20px;">Achat N°</td>
                        <td>                  
                    <input type="" class="form-control" readonly="" name="liv_id" id="liv_id" value="<?php echo $liv ?>" >
                        </td>
                        <td style="padding: 15px 20px;">Date</td>
                        <td><input type="" class="form-control" readonly="" name="date_liv" value="<?php echo $date ?>"></td>
                      </tr>
                      <tr>     
                        <td style="padding: 15px 20px;">Produit</td>
                        <td>  
                              <select   class="form-control" name="id_prod" id="id_prod" >
                                <option id="prod" value=""></option>
                                <?php
                                      $rqp = $db->query("SELECT * FROM produits");
                                      while($rsp=$rqp->fetch()){  ?>
                                <option value="<?php echo $rsp['id_prod'] ?>"><?php echo $rsp['description'] ?> (<?php echo $rsp['stock'] ?>)</option>        

                                      <?php } ?>  
                              </select>
                              <span id="erreur_produit" class="text-danger"></span> 
                        </td>
                        <td style="padding: 15px 20px;">Quantité</td>
                        <td>
                          <input type="number"  class="form-control" name="qte" id="qte" >
                          <span id="erreur_qte" class="text-danger"></span>
                        </td>          
                      </tr>
                      <tr>
                        <td colspan="4" align="right" style="padding: 5px">
                          <input type="hidden" name="action" id="action" value="ajout">
                          <input type="hidden" name="hidden_id" id="hidden_id">
                          <input type="submit" name="produit" id="produit" class="btn btn-success btn-sm" value="Ajouter">
                        </td>
                      </tr>                     
                    </form>
                  </table>       
                </div>
                    
                   <div id="message"></div>

                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr>
                          <th width="80">IP PROD</th><th>DESIGNATION</th><th>QTE</th><th>PU</th><th>PT</th><th width="120">OPERATION</th>
                        </tr>
                      </thead>
                      <tbody id="liste"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div id="delete_message" title="confirmation suppression">
              <p>Etes vous sûr de vouloir supprimer cette entrée ?</p>
            </div>
          </div>
           
                
            
      </div>
      <?php include('footer.php') ?>
      <script src="assets/js/detail-ach.js"></script>
    </body>
</html>



        
 
               