<?php 
require 'connexion.php';

$page = isset($_GET['p'])?$_GET['p']:'';
if($page=='select'){

		$id_cmd = $_POST['id_cmd'];
		$id_prod = $_POST['id_prod'];
		$qte = $_POST['qte'];
		
	    $sel_prod = $db->query("SELECT prix FROM produits WHERE id_prod=$id_prod ");
        $result=$sel_prod->fetch();

       $prix_prod = $result['prix'];
       $pt = $qte * $prix_prod;

		$fact = $db->prepare("INSERT INTO detail_vent (id_cmd,id_prod,qte,pu,pt) VALUES(?,?,?,?,?)");
        $fact->execute(array($id_cmd,$id_prod,$qte,$prix_prod,$pt));


    }
    else if($page=='modif'){
    	$id_vent = $_POST['id_vent'];
		$id_prod = $_POST['id_prod'];
		$qte = $_POST['qte'];
		
	    $sel_prod = $db->query("SELECT prix FROM produits WHERE id_prod=$id_prod ");
        $result=$sel_prod->fetch();

       
       $prix = $result['prix'];
       $pt = $qte * $prix;

		$fact = $db->prepare("UPDATE detail_vent SET id_prod=?,qte=?,pu=?,pt=? WHERE id_vent=? ");
        $fact->execute(array($id_prod,$qte,$prix,$pt,$id_vent));

	}else if($page=='suppr') {
			$id_vent = $_GET['id_vent'];
			$req = $db->prepare("DELETE FROM detail_vent  WHERE id_vent=? ");
			$req->execute(array($id_vent));

	}else if($page=='valid') {
			$id_cmd = $_GET['id_cmd'];
			$req = $db->query("SELECT SUM(pt) FROM detail_vent  WHERE id_cmd=$id_cmd ");
			$st = $req->fetch();
			$montant = $st['0'];

			$req1 = $db->query("SELECT date_cmd FROM commande  WHERE id_cmd=$id_cmd ");
			$st1 = $req1->fetch();
			$date = $st1['date_cmd'];

			$cont = $db->query("SELECT * FROM facture_vent WHERE id_cmd = $id_cmd");

			$verif = $cont->rowCount();

			if($verif == 0)
			{
				$cach = $db->prepare("INSERT INTO facture_vent (id_cmd,date_cmd,montant) VALUES(?,?,?)");
                $cach->execute(array($id_cmd,$date,$montant));
			}
			else
			{
				$maj = $db->prepare("UPDATE facture_vent SET date_cmd=?, montant=? WHERE id_cmd=? ");
				$maj->execute(array($date,$montant,$id_cmd));
			}

			

			
	
}else{

	

    
	
}

?>


		