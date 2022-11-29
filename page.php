<?PHP
       include('controle.php');
       include('connexion.php');
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
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body  class="bg-info">
    <?PHP include('menu.php') ?>
    <div class="container" style="margin-top: 7%; margin-bottom:7%">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mb-0">JOURNAL DE STOCK <span id="date"></span></h5>
                    </div>
                    <div class="card-body">
                    <div class="text-right" style="margin-bottom: 10px;">
                       <!-- <button type="button" id="add" name="add" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Ajouter</button> -->
                        <a href="#modal1" class="btn btn-success btn-sm js-modal"><i class="fa fa-plus"></i> Ajouter en stock</a>
                        <a href="#modal2" class="btn btn-danger btn-sm js-modal"><i class="fa fa-m"></i> Sortir du stock</a>
                    </div>                      
                    
                    <!-- Début modal ajout stock -->
                    <aside id="modal1" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Ajouter en stock</h5>
                            <hr />
                            <form method="POST" action="ajout_stock.php">
                                <label for="matiere">Matière première</label><br />
                                <select name="matiere" id="matiere">
                                    <option value="">--</option>
                                    <?php 
                                        $mat_prem = "SELECT * FROM matiere_premiere";
                                        $find_mat = $db -> query($mat_prem);
                                        while($data = $find_mat -> fetch()){ ?>
                                            <option value="<?php echo$data['id_mat']; ?>"><?php echo$data['libelle']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />

                                <label for="categorie">Catégorie(s)</label><br />
                                <select name="categorie" id="categorie">
                                    <option value="">--</option>
                                    <?php 
                                        $cat = "SELECT * FROM categories";
                                        $find_cat = $db -> query($cat);
                                        while($data = $find_cat -> fetch()){ ?>
                                            <option value="<?php echo$data['id_cat']; ?>"><?php echo$data['libelle_cat']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />
                            
                                <label for="quantite">Quantité</label><br />
                                <input class="form-control" type="number" name="quantite" id="quantite" /><br />

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Enregistrer</button>
                                    <button class="btn btn-danger" type="reset"><i class="fa fa-remove"></i> Annuler</button>
                                    <button class="btn btn-success js-modal-close">Quitter</button>
                                </div>
                            </form>
                         </div>
                    </aside>
                    <!-- Fin modal ajout stock -->

                    <!-- Début modal sortie stock -->
                    <aside id="modal2" class="modal" aria-hidden="true" role="dialog" aria-labelledby="titlemodal" style="display:none;">
                        <div class="modal-wrapper js-modal-stop" >
                            <h5 id='titlemodal'>Sortie en stock</h5>
                            <hr />
                            <form method="POST" action="ajout_stock.php">
                                <label for="matiere">Matière première</label><br />
                                <select name="matiere" id="matiere">
                                    <option value="">--</option>
                                    <?php 
                                        $mat_prem = "SELECT * FROM matiere_premiere";
                                        $find_mat = $db -> query($mat_prem);
                                        while($data = $find_mat -> fetch()){ ?>
                                            <option value="<?php echo$data['id_mat']; ?>"><?php echo$data['libelle']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />

                                <label for="categorie">Catégorie(s)</label><br />
                                <select name="categorie" id="categorie">
                                    <option value="">--</option>
                                    <?php 
                                        $cat = "SELECT * FROM categories";
                                        $find_cat = $db -> query($cat);
                                        while($data = $find_cat -> fetch()){ ?>
                                            <option value="<?php echo$data['id_cat']; ?>"><?php echo$data['libelle_cat']; ?></option>
                                            <?php  } ?>
                                </select><br /><br />
                            
                                <label for="quantite">Quantité</label><br />
                                <input class="form-control" type="number" name="quantite" id="quantite" /><br />

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Enregistrer</button>
                                    <button class="btn btn-danger" type="reset"><i class="fa fa-remove"></i> Annuler</button>
                                    <button class="btn btn-success js-modal-close">Quitter</button>
                                </div>
                            </form>
                         </div>
                    </aside>
                    <!-- Fin modal sortie stock -->

                        <div>
                            <table class="table table-sm table-bordered table-striped" id="stock">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Ref</th>
                                        <th style="text-align:center">Matière</th>
                                        <th style="text-align:center">Catégorie</th>
                                        <th style="text-align:center">Stock initial</th>
                                        <th style="text-align:center">Entrée</th>
                                        <th style="text-align:center">Sortie</th>
                                        <th style="text-align:center">Solde</th>
                                        <th style="text-align:center">Date</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    $req = $db->query('SELECT ref FROM stock');
	
	$nb_total_stock = $req->rowCount();
	$nb_stock_par_page = 25;
	
	$nb_page_avant_et_apres = 4;
	
	$nb_pages = ceil($nb_total_stock / $nb_stock_par_page);
	
	if(isset($_GET['page']) && is_numeric($_GET['page']))
		{
			$page_num = $_GET['page'];
		}
	else
		{
			$page_num = 1;
		}

	if($page_num < 1)
		{
			$page_num = 1;
		}
	else if($page_num > $nb_pages)
		{
			$page_num = $nb_pages;
		}
	
	$page_num = $last_page;
	
	$limit = 'LIMIT '.($page_num - 1) * $nb_stock_par_page. ',' .$nb_stock_par_page;


	$sql = "SELECT matricule, noms, prenoms, niveau FROM eleve";
	
	$pagination = '';
	
	if($last_paage != 1)
		{
			if($page_num > 1)
				{
					$previous = $page_num - 1;
					$paginatioin = '<a href = "index.php?page='.$previous.'>Precendent</a> &nbsp;&nbsp;';
	
					for($i = $page_num - nb_page_avant_et_apres; $i < $page_num; $i++)
						{
							if($i > 0)
								{
									$pagination = '<a href = "index.php?page = '.$i.'">'.$i.'</a> &nbsp;';
								}
						}
				}
			
			$pagination = '<span class="active">'.$page_num.'</span>&nbsp;';
			
			for($i = $page_num + 1; $i <= $last_page; $i++)
				{
					$pagination = '<a href = "index.php?page'.$i.'">'.$i.'</a>';
				
					if($i >= $page_num + $nb_page_avant_et_apres)
						{
							break;
						}
				}
			
			if($page_num != $last_page)
				{
					$next = $apge_num + 1;
					$pagination = '<a href="index.php?page='.$next.'">Suivant</a>';
				}
		}

                                        //On affiche la table matiere première
                                        
                                        $mat = "SELECT stock.ref,stock.stock,stock.entree,stock.sortie,stock.solde,stock.date_st,
                                        matiere_premiere.libelle,categories.libelle_cat FROM matiere_premiere INNER JOIN stock ON 
                                        matiere_premiere.id_mat = stock.id_mat INNER JOIN categories ON stock.id_cat = 
                                        categories.id_cat";
                                        
                                       // $mat="SELECT * FROM stock";
                                        $find_mat = $db -> query($mat);
                                        $nombre = $find_mat -> rowCount();
                                        if($nombre == 0)
                                            {
                                                echo"Il n'y a aucun enregistrement trouvé.";
                                            }
                                         else
                                            { 
                                                while($data = $find_mat -> fetch()) { ?>
                                                    <tr>
                                                        <td style="text-align:center"><?php echo$data['ref']; ?></td>
                                                        <td><?php echo$data['libelle']; ?></td>
                                                        <td><?php echo$data['libelle_cat']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['stock']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['entree']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['sortie']; ?></td>
                                                        <td style="text-align:center"><?php echo$data['solde']; ?></td>
                                                        <td><?php echo$data['date_st']; ?></td>                                                  
                                                    </tr>
                                    <?php  }  } ?>
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <?php include('footer.php') ?>
   <!-- <script src="assets/js/journ-stock.js"></script> -->
    <script src="assets/js/app.js"></script>
</body>
</html>
