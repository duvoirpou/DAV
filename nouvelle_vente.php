 <?PHP
session_start();
    require 'connexion.php';
    $requette = $db->query("SELECT * FROM clients");
    $rep = $requette->fetchAll();

    if(isset($_POST['id_cl'],$_POST['date'])){

        $id = $_POST['id_cl'];
        $date = $_POST['date'];

        $req = $db->exec("INSERT INTO commande (id_cl,date_cmd) VALUES('$id','$date') ");

        $sel = $db->query("SELECT * FROM commande WHERE id_cl= ");
       
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
    <body >
        <div class="container">

            <?PHP include('menu.php') ?>
        <div  style="border: solid 1px #000; border-radius: 5px; padding: 20px 40px; margin-top:15px;">
            
                   <form method="post" action="" >
                  <div class="form-group">
                        <label for="id_cl">Client</label>
                        <select  name="id_cl" id="id_cl"  class="form-control">
                            <option value=""></option>
                            <?php foreach ($rep as $row) { ?>
                                <option value="<?php echo $row['id_cl'] ?>"><?php echo $row['noms_cl'] ?></option>
                          <?php  } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" />
                    </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Enregister</button>
                  </div>
                </form>
                  

                           <?php if(isset($id) && isset($date)) {?>
                  <div class="text-center"><a class="btn btn-primary" href="details_vente.php?id=<?php echo $id; ?>"><i class="fa fa-chevron-right"></i> suivant</a></div>

              <?php } ?>
        </div>
            
            <?php include('footer.php') ?>
        </div>
    </body>
</html>



        
 
               