<?php
    
    session_start();

	include('connexion.php');

if (isset($_POST['action'])){

	if($_POST['action']=="select"){

		$id_prod = $_POST['id_prod'];
		$req = $db->prepare("SELECT id_prod, description FROM produits WHERE id_prod=?");
		$req->execute(array($id_prod));
    $resultat = $req->fetchAll();

    foreach($resultat AS $row){

      $donnee['id_prod']=$row['id_prod'];
      $donnee['desc']=$row['description']; 
    }

    echo json_encode($donnee);

	}

	if($_POST['action']=="ajout"){

		$id_cmd = $_POST['id_cmd'];
            $id_prod = $_POST['id_prod'];
            $qte = $_POST['qte'];

         
             $rp = $db->query("SELECT prix, stock FROM produits WHERE id_prod=$id_prod");
             $np = $rp->fetch();
             $prix = $np['prix'];
             $stock = $np['stock'];
            
             $cont = $db->query("SELECT * FROM facture_vent WHERE id_cmd=$id_cmd AND id_prod=$id_prod ");
             $verif = $cont->rowcount();

             if($verif==0){

                      if($stock<$qte){

                        echo '<div class="alert alert-danger text-center">stock insuffisant</div>';

                      }
                      else
                      {
                        $id_liv = 0;
                        $entree =0;
                        $sortie = $qte;
                        $solde = ($stock + $entree) - $sortie;
                        $pt = $prix * $qte;
                        
                        
                        $maj = $db->exec("UPDATE produits SET stock=$solde WHERE id_prod=$id_prod");
                        $rd = $db->exec("INSERT INTO facture_vent (id_cmd,id_prod,qte,pu,pt) VALUES($id_cmd,$id_prod,$qte,$prix,$pt) ") ;
                        $st = $db->exec("INSERT INTO stock (id_prod,stock,entree,sortie,solde,date_st,id_liv,id_cmd) VALUES($id_prod,$stock,$entree,$sortie,$solde,current_date(),$id_liv,$id_cmd) ");
                        echo '<div class="alert alert-success text-center">Produit ajouté à la facture avec succès</div>';

                      }
               
              }
              else
              {
                echo '<div class="alert alert-danger text-center">le produit est déja selectionné dans la facture</div>';
              }
          }    
        
        	if($_POST['action']=="afficher"){
        	$id = $_POST['id'];
	        $rst = $db->query("SELECT fac.id_prod,fac.qte,prod.description FROM facture_vent AS fac INNER JOIN produits AS prod ON fac.id_prod=prod.id_prod WHERE fac.id=$id");
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
        	$id_cmd = $_POST['id_cmd'];
           	$nv_id_prod = $_POST['id_prod'];
          	$nv_qte = $_POST['qte'];
        
        	$rst = $db->query("SELECT id_prod, qte FROM facture_vent  WHERE id=$id");
	        $rep = $rst->fetch();	         
	        $qte = $rep['qte'];
	        $id_prod = $rep['id_prod'];

	        $rqt = $db->query("SELECT prix,stock FROM produits  WHERE id_prod=$id_prod");
	        $resul = $rqt->fetch();
	        $prix = $resul['prix'];
	        $stock = $resul['stock'];

	        	//si la nouvelle quantité est  superieure à l'ancienne pour le meme produit
	          if($nv_qte > $qte AND $nv_id_prod==$id_prod){
	          	$marge = $nv_qte - $qte;
	          	$solde = $stock - $marge;
	          	$maj = $db->exec("UPDATE produits SET stock=$solde, date_maj=current_date() WHERE id_prod=$id_prod");

	          	$pt = $nv_qte * $prix;

	          	$qr = $db->exec("UPDATE facture_vent SET qte=$nv_qte, pu = $prix, pt=$pt WHERE id=$id");

	               
	              $sortie = $nv_qte;
	             
	              $pt = $prix * $qte;
	             

	          	 $st = $db->exec("UPDATE stock SET sortie=$sortie, solde=$solde, date_st=current_date() WHERE id_cmd=$id_cmd AND id_prod=$id_prod");

	          }

	          //si la nouvelle quantité est  inferieure à l'ancienne pour le meme produit	
	          if($nv_qte < $qte AND $nv_id_prod==$id_prod){
	          	$marge =  $qte - $nv_qte;
	          	$solde = $stock + $marge;
	          	$maj = $db->exec("UPDATE produits SET stock=$solde, date_maj=current_date() WHERE id_prod=$id_prod");

	          	$pt = $nv_qte * $prix;

	          	$qr = $db->exec("UPDATE facture_vent SET qte=$nv_qte, pu = $prix, pt=$pt WHERE id=$id");

	          	       
	              $sortie = $nv_qte;
	             
	              $pt = $prix * $qte;
	             

	          	 $st = $db->exec("UPDATE stock SET sortie=$sortie, solde=$solde, date_st=current_date() WHERE id_cmd=$id_cmd AND id_prod=$id_prod");

	          }
	          	

          echo  '<div class="text-center text-success"><i class="fa fa-check"></i> modification effectuée....'; 
        
      }

      //suppression des elements de la facture
      if($_POST['action']=='supprimer'){

      	$id = $_POST['id'];

        $id_cmd = $_SESSION['id_cmd'];

      	$requ = $db->query("SELECT * FROM facture_vent  WHERE id=$id");

      	$data = $requ->fetch();

      	$id_prod = $data['id_prod'];
      	$qte = $data['qte'];

      	$requet = $db->query("SELECT stock FROM produits  WHERE id_prod=$id_prod");

      	$rsp = $requet->fetch();

      	$stock = $rsp['stock'];

      	$maj_stock = $stock  + $qte;

      	$maj3 = $db->exec("UPDATE produits SET stock=$maj_stock  WHERE id_prod=$id_prod");


      	$del = $db->exec("DELETE FROM facture_vent WHERE id=$id");

      	$maj4 = $db->exec("DELETE FROM stock WHERE id_prod=$id_prod AND id_cmd=$id_cmd");


      }
            
        //validation facture
        if($_POST['action']=="valider"){

         
            $id_cmd = $_POST['id_cmd'];
             $id_cl = $_POST['id_cl'];
            $pay = $_POST['pay'];
            $mont_ch = $_POST['mont_ch'];
            $mont_let = $_POST['mont_let'];
            $reste = $mont_ch - $pay;

          $vrf=$db->query("SELECT id_cmd FROM caisse WHERE id_cmd=$id_cmd");
          $ctrl=$vrf->rowcount();

          if($ctrl==0){

              if($pay<=$mont_ch){
                    
                  $maj = $db->exec("INSERT INTO caisse (id_cmd,id_cl,mont_ch,mont_let,payer,reste,date_ca) VALUES ($id_cmd,$id_cl,$mont_ch,'$mont_let',$pay,$reste,current_date()) ");

                  $maj = $db->exec("UPDATE commande SET montant=$mont_ch WHERE id_cmd=$id_cmd");

                  echo '<div class="alert alert-success text-center text-success">Validation effectuée</div>';


              }
              else
              {
                  echo '<div class="alert alert-danger text-center text-danger">vous avez entré un montant trop élevé</div>';
              }


            //mise à jour journal de caisse
                if($pay>0 && $pay<=$mont_ch)
                {

                    $jca=$db->exec("INSERT INTO journal_caisse(id_cmd,id_cl,montant,date_jour) VALUES($id_cmd,$id_cl,$pay,current_date())");


                } 
          }
          else
          {
            echo '<div class="alert alert-danger text-center text-danger">La facture a été déjà validée</div>';
          }
          
          

          }

       
}


?>