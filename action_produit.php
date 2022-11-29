<?php 

include('connexion.php');

  if(isset($_POST['action'])){

    if($_POST['action']=="insert"){
        $description = htmlentities(trim(addslashes(strip_tags($_POST['desc']))));
        $id_cat = htmlentities(trim(addslashes(strip_tags($_POST['id_cat']))));
        $prix = htmlentities(trim(addslashes(strip_tags($_POST['prix']))));
        $stock = 0;

        $req = $db->prepare("INSERT INTO produits (description,id_cat,prix,stock) VALUES('$description',$id_cat,$prix,$stock)");

        if($req->execute()){

           echo  '<div class="text-center text-success">produit ajouté avec succès</div>'; 
        }
        else
        {
             echo  'echec d\'enregistrement';  
        }
    }

        if($_POST['action']=='afficher'){
        $id_prod = $_POST['id'];
        $rp = $db->query("SELECT * FROM produits WHERE id_prod=$id_prod");
        $rep = $rp->fetchAll();

        foreach($rep AS $row){

          $data['desc']=$row['description'];
          $data['id_cat']=$row['id_cat'];
          $data['prix']=$row['prix'];
        }

        echo json_encode($data);
  
      }

       if($_POST['action']=='modifier'){
        $id_prod = $_POST['hidden_id'];
        $desc = htmlentities(trim(addslashes(strip_tags($_POST['desc']))));
        $id_cat = htmlentities(trim(addslashes(strip_tags($_POST['id_cat']))));
        $prix = htmlentities(trim(addslashes(strip_tags($_POST['prix']))));

        $req = $db->exec("UPDATE produits SET description='$desc',id_cat=$id_cat,prix=$prix WHERE id_prod=$id_prod ");

          echo  '<div class="text-center text-success"><i class="fa fa-check"></i> modification effectuée....'; 
        
      }
	}

  


	 ?>