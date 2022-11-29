<?PHP
  include('controle.php');
  require 'connexion.php';
?>
<!doctype html>
<html>
<head>
    <title>LGC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.theme.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
    <body class="bg-info">
         <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h5 class="text-center mb-0">LISTE DES AGENTS</h5>
                </div>
                <div class="card-body">

                   <div class="text-right" style="margin-bottom: 10px;">
                      <a href="#modal1" class="btn btn-primary btn-sm js-modal">Accompte sur salaire</a>
                      <a href="#modal2" class="btn btn-success btn-sm js-modal">Masse salariale</a>
                    </div> 

                      <!-- Début modal 1 -->
                      <aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                          <h5 id='titlemodal'>Prendre une avance sur salaire</h5>
                          <hr />
                          <form method="POST" action="dette.php">
                            <label for="montant">Montant emprunt</label><br />
                            <input class="form-control" type="number" name="montant" id="montant" /><br />

                            <label for="mois_engage">Mois engagé</label><br />
                            <select name="mois_engage" id="mois_engage">
                              <option value="">--</option>
                              <option value="janvier">Janvier</option>
                              <option value="fevrier">Février</option>
                              <option value="mars">Mars</option>
                              <option value="avril">Avril</option>
                              <option value="mai">Mai</option>
                              <option value="juin">Juin</option>
                              <option value="juin">Juillet</option>
                              <option value="juillet">Juillet</option>
                              <option value="aout">Août</option>
                              <option value="septembre">Semptembre</option>
                              <option value="octobre">Octobre</option>
                              <option value="novembre">novembre</option>
                              <option value="decembre">Décembre</option>
                            </select><br /><br />
                                                  
                            <label for="annee_engage">Année</label><br />
                          <!--  <input class="form-control" type="number" name="annee_engage" id="annee_engage" /><br /> -->
                            <select name="annee_engage" id="annee_engage">
                              <option value="">--</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2024">2023</option>
                            </select>
                            <br /><br />

                            <label for="agent">Agent</label><br />
                            <select name="agent" id="agent">
                              <option value="">--</option>
                              <?php 
                                $agt = $db -> query("SELECT * FROM agent");
                                while($data = $agt -> fetch()) { ?>
                                <option value="<?php echo $data['matricule'] ; ?>"><?php echo $data['prenoms']." ".$data['noms'] ; ?></option>
                              <?php } ?>
                            </select><br /><br />

                            <div class="form-group">
                              <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Valider</button>
                              <button class="btn btn-danger" type="reset"><i class="fa fa-remove"></i> Annuler</button>
                              <button class="btn btn-success js-modal-close">Quitter</button>
                            </div>
                          </form>
                        </div>
                      </aside>
                      <!-- Fin modal 1 -->

                       <!-- Début modal 2 -->
                       <aside id="modal2" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                          <h5 id='titlemodal'>Entree le mois et l'année</h5>
                          <hr />
                          <form method="POST" action="salaire_agent.php">
                            <label for="mois">Mois</label><br />
                            <select name="mois" id="mois">
                              <option value="">--</option>
                              <option value="janvier">Janvier</option>
                              <option value="fevrier">Février</option>
                              <option value="mars">Mars</option>
                              <option value="avril">Avril</option>
                              <option value="mai">Mai</option>
                              <option value="juin">Juin</option>
                              <option value="juin">Juillet</option>
                              <option value="juillet">Juillet</option>
                              <option value="aout">Août</option>
                              <option value="septembre">Semptembre</option>
                              <option value="octobre">Octobre</option>
                              <option value="novembre">novembre</option>
                              <option value="decembre">Décembre</option>
                            </select><br /><br />
                                                  
                            <label for="annee">Année</label><br />
                            <input class="form-control" type="number" name="annee" id="annee" /><br />

                            <div class="form-group">
                              <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Consulter</button>
                              <button class="btn btn-danger" type="reset"><i class="fa fa-remove"></i> Annuler</button>
                              <button class="btn btn-success js-modal-close">Quitter</button>
                            </div>
                          </form>
                        </div>
                      </aside>
                      <!-- Fin modal 2 -->

                    <?php if($_SESSION['type']=='admin'){?> 
                   <div class="text-right" style="margin-bottom: 10px;">
                  <!--<button type="button" id="add" name="add" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Ajouter</button></div>-->
                      <?php } ?> 
                        <!--
                        <div id="user_dialog" title="Ajout produit" >
                          <form method="post" id="user_form">
                            <div class="form-group">
                              <label for="matricule" class="col-form-label">MATRICULE:</label>
                              <input type="text" name="matricule" id="matricule" class="form-control" />
                              <span id="erreur_matricule" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                              <label for="identite" class="col-form-label">IDENTITE:</label>
                              <select type="text" name="identite" id="identite" class="form-control" >
                                  <option value=""></option>
                                      <?php
                                          $sel_ag = $db->query("SELECT * FROM agent");                      
                                          while($resultat = $sel_ag -> fetch()) { ?>  
                                              <option value="<?php echo $resultat['noms'] ; ?>"><?php echo $resultat['prenoms'] ; ?></option>
                                      <?php } ?>
                              </select>
                               <span id="erreur_identite" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                              <label for="sexe" class="col-form-label">SEXE:</label>
                              <input type="texte" name="sexe" id="sexe" class="form-control"/>
                               <span id="erreur_sexe" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                              <label for="nation" class="col-form-label">NATIONALITE:</label>
                              <input type="text" name="nation" id="nation" class="form-control"/>
                               <span id="erreur_nation" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                              <label for="contact" class="col-form-label">CONTACT:</label>
                              <input type="text" name="contact" id="contact" class="form-control"/>
                               <span id="erreur_contact" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                              <label for="engagement" class="col-form-label">DATE ENG:</label>
                              <input type="text" name="engagement" id="engagement" class="form-control"/>
                               <span id="erreur_engagement" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                              <label for="contrat" class="col-form-label">CONTRAT:</label>
                              <input type="text" name="contrat" id="contrat" class="form-control"/>
                               <span id="erreur_contrat" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                              <label for="fonction" class="col-form-label">FONCTION:</label>
                              <input type="number" name="fonction" id="fonction" class="form-control"/>
                               <span id="erreur_fonction" class="text-danger"></span>
                            </div>
                                            -->
                            <div class="form-group">
                              <input type="hidden" name="action" id="action" value="insert">
                              <input type="hidden" name="hidden_id" id="hidden_id">
                            <!--  <input type="submit" name="form_action" id="form_action" class="btn btn-primary btn-sm" value="ajouter"/>-->
                              <span id="action_alert" title="message"></span>
                            </div>
                          </form>
                        </div>
                   <div class="table-responsive">
                   <table class="table table-bordered table-sm table-striped" style="margin-top: 10px;width: 100%;" id="produits" >
                          <thead>
                              <tr>
                                  <th>N° MAT</th>
                                  <th>IDENTITE</th>
                                  <th>SEXE</th>
                                  <th>NATIONALITE</th>
                                  <th>CONTACT</th>
                                  <th>DATE D'ENG</th>
                                  <th>CONTRAT</th>
                                  <th>FONCTION</th>
                              </tr>
                          </thead>                
                          <tbody>
                            <?php //On recherche les donnés dans la bd
                              $check = "SELECT * FROM agent";
                              $find_agent = $db -> query($check);
                              $nbre_find = $find_agent -> rowCount();
                                while($data = $find_agent -> fetch()) {
                                  if($nbre_find == 0)
                                    {
                                      echo"Il n'y a aucun agent trouvé. Merci de contacter le gestionnaire.";
                                    }
                                  else{ ?>
                                    <tr>
                                        <td><?php echo$data['matricule']; ?></td>
                                        <td><?php echo$data['noms']." ".$data['prenoms']; ?></td>
                                        <td><?php echo$data['sexe']; ?></td>
                                        <td><?php echo$data['nationalite']; ?></td>
                                        <td><?php echo$data['contrat']; ?></td>
                                        <td><?php echo$data['date_eng']; ?></td>
                                        <td><?php echo$data['tele']; ?></td>
                                        <td><?php echo$data['fonction']; ?></td>
                                      </tr>
                                <?php } } ?>
                          </tbody>
                    </table>
                   </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <?php include('footer.php') ?>
        <script src="assets/js/app.js"></script>
        <!--
        <script src="assets/js/produit.js"></script>
        <script src="assets/js/prod.js"></script>
        -->
    </body>
</html>