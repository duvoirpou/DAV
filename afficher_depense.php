<?PHP

        session_start();
 
    if(!isset($_SESSION['user'])){
        header('location:index.php');
    } 

        
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
    <body class="bg-info">

         <?PHP include('menu.php') ?>
        <div class="container" style="margin-top: 7%;margin-bottom: 7%;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">DEPENSES</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="col">
										<input type="date" name='date_dep' onchange="selectDate();" class="form-control form-control-sm" id="date_dep">
											
									</div>
                                    <div class="col">
										<select name='id_classe' onchange="selectMois();" class="form-control form-control-sm" id="id_classe">
											<option value=''>Selection le mois</option>
											<option value="janvier">Janvier</option>
											<option value="decembre">Décembre</option>
										</select>
									</div>
                                    <div class="col">
										<select name='id_classe' onchange="selectAnnee();" class="form-control form-control-sm" id="id_classe">
											<option value=''>Selection l'année</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
										</select>
									</div>
								</div>
							</form>
                             <br />   
                            <div id="content">
                                
                            </div> 
						</div>
                               
                        </div>
                    </div>
                </div>
            </div>
                                    
       
    </div>
        <?php include('footer.php') ?>
        <script src="assets/js/depense.js"></script>
        
    </body>
</html>



