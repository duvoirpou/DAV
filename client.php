<?PHP

  include('controle.php');

    require 'connexion.php';
    $limit = 7;
    $req_page = $db->query("SELECT * FROM clients  ORDER BY id_cl DESC");
  $nb_page = $req_page->rowcount();
  $total_page = ceil($nb_page / $limit);
?>
<!doctype html>
<html>
<head>
    <title>gestock</title>
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
      <?PHP include('menu.php'); ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;" >
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h5 class="text-center mb-0">LISTE DES CLIENTS</h5>
                </div>
                <div class="card-body">
                      <?php if($_SESSION['type']=='admin'){ ?>
                    <div class="text-right"><button  class="btn btn-success btn-sm" id="ajouter" name="ajouter" ><i class="fa fa-plus"></i> Ajouter</button></div>
                      <?php } ?>
                                <div id="client_dialog" title="Ajout client">
                                    <form method="post" id="client_form">
                                       <div class="form-group">
                                           <label for="nom" class="col-form-label">Nom</label>
                                           <input type="text"  class="form-control" name="nom" id="nom" >
                                           <span id="erreur_nom" class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                           <label for="tel" class="col-form-label">Téléphone</label>
                                           <input type="text"  class="form-control" name="tel" id="tel" >
                                           <span id="erreur_tel" class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                          <input type="hidden" name="action" id="action" value="insert">
                                          <input type="hidden" name="hidden_id" id="hidden_id">
                                          <input type="submit" name="form_action" id="form_action" class="btn btn-primary btn-sm" value="ajouter"/>
                                          <span id="action_alert" title="message"></span>
                                        </div>
                                    </form>
                                </div>

                                

                  <div id="result"></div>
                      <p></p> 
                  <div class="table-responsive">
                      <table class="table table-sm table-bordered table-striped">
                          <thead align="center">
                              <tr>
                                  <th width="80">Id</th>
                                  <th>Noms</th>
                                  <th>Téléphone</th>
                                     <?php if($_SESSION['type']=='admin'){ ?>
                                  <th width="160">Modifier</th>
                                     <?php } ?>
                                  <th width="160">Compte client</th>
                              </tr>
                          </thead>
                          <tbody align="center" id="target-content"></tbody>
                      </table>
                      
                  </div>
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center" id="pagination">
                      <?php if(!empty($total_page)): for($i=1; $i<=$total_page; $i++):
                       if($i==1): ?>
                      <li class="page-item active" id="<?php echo $i; ?>"><a class="page-link" href="affiche_client.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                      <?php else: ?>
                      <li class="page-item" id="<?php echo $i; ?>"><a class="page-link" href="affiche_client.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li> 
                      <?php endif; ?>
                      <?php endfor;endif; ?>
                    </ul>
                  </nav>      
                </div>
              </div>
            </div>
          </div>
                
            

    </div>
       <?php include('footer.php') ?>
        <script src="assets/js/client.js"></script>
    </body>
</html>



