<?php 
	session_start();
  
	include('connexion.php');

 if (isset($_POST['action'])){

 		if($_POST['action']=="ajout"){

           $id_liv = $_POST['liv_id'];

           $id_prod = $_POST['id_prod'];
           $qte = $_POST['qte'];

           $rp = $db->query("SELECT prix, stock FROM produits WHERE id_prod=$id_prod");
           $np = $rp->fetch();
           $prix = $np['prix'];
           $stock = $np['stock'];
        
           $cont = $db->query("SELECT * FROM facture_ach WHERE id_liv=$id_liv AND id_prod=$id_prod ");
           $verif = $cont->rowcount();

           if($verif==0){

              $id_cmd = 0;
      
              $entree = $qte;
              $sortie =0;
              $pt = $prix * $qte;
              $solde = ($stock + $entree) - $sortie;

            $maj = $db->exec("UPDATE produits SET stock=$solde, date_maj=current_date() WHERE id_prod=$id_prod");

           $rd = $db->exec("INSERT INTO facture_ach (id_liv,id_prod,qte,pu,pt) VALUES($id_liv,$id_prod,$qte,$prix,$pt) ");

           $st = $db->exec("INSERT INTO stock (id_prod,stock,entree,sortie,solde,date_st,id_liv,id_cmd) VALUES($id_prod,$stock,$entree,$sortie,$solde,current_date(),$id_liv,$id_cmd) ");

               echo '<div class="text-success text-center">Produit ajouté à la facture avec succès</div>';

            
           
          }
          else
          {
            echo '<div class="text-danger text-center">Le produit existe déja dans la facture</div>';
          }

        }


        if($_POST['action']=="afficher"){
        	$id = $_POST['id'];
	        $rst = $db->query("SELECT fac.id_prod,fac.qte,prod.description FROM facture_ach AS fac INNER JOIN produits AS prod ON fac.id_prod=prod.id_prod WHERE fac.id=$id");
	        $rep = $rst->fetchAll();

	        foreach($rep AS $row){

	          $data['id_prod']=$row['id_prod'];
	          $data['desc']=$row['description'];
	          $data['qte']=$row['qte'];
	        }
        		echo json_encode($data);

        }


        if($_POST['action']=='modifier'){
        	$id = $_POST['hidden_id'];
        	$id_liv = $_POST['liv_id'];
           	$nv_id_prod = $_POST['id_prod'];
          	$nv_qte = $_POST['qte'];
        
        	$rst = $db->query("SELECT id_prod, qte FROM facture_ach  WHERE id=$id");
	        $rep = $rst->fetch();	         
	        $id_prod=$rep['id_prod'];
	        $qte=$rep['qte'];

	        $rqt = $db->query("SELECT prix,stock FROM produits  WHERE id_prod=$id_prod");
	        $resul = $rqt->fetch();
	        $prix = $resul['prix'];
	        $stock = $resul['stock'];

	        	//si la nouvelle quantité est  superieure à l'ancienne pour le meme produit
	          if($nv_qte > $qte AND $nv_id_prod==$id_prod){
	          	$marge = $nv_qte - $qte;
	          	$solde = $stock + $marge;
	          	$maj = $db->exec("UPDATE produits SET stock=$solde, date_maj=current_date() WHERE id_prod=$id_prod");

	          	$pt = $nv_qte * $prix;

	          	$qr = $db->exec("UPDATE facture_ach SET qte=$nv_qte, pu = $prix, pt=$pt WHERE id=$id");

	          	       
	              $entree = $nv_qte;
	             
	              $pt = $prix * $qte;
	             

	          	 $st = $db->exec("UPDATE stock SET entree=$entree, solde=$solde, date_st=current_date() WHERE id_liv=$id_liv AND id_prod=$id_prod");

	          }

	          //si la nouvelle quantité est  inferieure à l'ancienne pour le meme produit	
	          if($nv_qte < $qte AND $nv_id_prod==$id_prod){
	          	$marge =  $qte - $nv_qte;
	          	$solde = $stock - $marge;
	          	$maj = $db->exec("UPDATE produits SET stock=$solde, date_maj=current_date() WHERE id_prod=$id_prod");

	          	$pt = $nv_qte * $prix;

	          	$qr = $db->exec("UPDATE facture_ach SET qte=$nv_qte, pu = $prix, pt=$pt WHERE id=$id");

	          	       
	              $entree = $nv_qte;
	             
	              $pt = $prix * $qte;
	             

	          	 $st = $db->exec("UPDATE stock SET entree=$entree, solde=$solde, date_st=current_date() WHERE id_liv=$id_liv AND id_prod=$id_prod");

	          }
	          	

          echo  '<div class="text-center text-success"><i class="fa fa-check"></i> modification effectuée....'; 
        
      }

      //suppression des elements de la facture
      if($_POST['action']=='supprimer'){

      	$id = $_POST['id'];
        $id_liv = $_SESSION['liv'];

      	$requ = $db->query("SELECT * FROM facture_ach  WHERE id=$id");

      	$data = $requ->fetch();

      	$id_prod = $data['id_prod'];
      	$qte = $data['qte'];

      	$requet = $db->query("SELECT stock FROM produits  WHERE id_prod=$id_prod");

      	$rsp = $requet->fetch();

      	$stock = $rsp['stock'];

      	$maj_stock = $stock  - $qte;

      	$maj3 = $db->exec("UPDATE produits SET stock=$maj_stock  WHERE id_prod=$id_prod");


      	$del = $db->exec("DELETE FROM facture_ach WHERE id=$id");

        $del = $db->exec("DELETE FROM stock WHERE id_liv=$id_liv  AND id_prod=$id_prod");


      }
    }    

?>