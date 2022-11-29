<?php 
session_start();
include('connexion.php');

$id_user = $_SESSION['id'];

  if(isset($_POST['action'])){

  
        $noms_client = $_POST['noms_client'];
        $prenoms_client = htmlentities(trim(strip_tags($_POST['prenoms_client'])));
        $num_client = $_POST['num_client'];
        $ville = $_POST['ville'];
        $commune = $_POST['commune'];
        $quartier = $_POST['quartier'];
        $rue = $_POST['rue'];
        
       

        $req = $db->prepare("INSERT INTO clients (noms_client, prenoms_client, num_client, ville, commune,quartier,rue) VALUES('$noms_client', '$prenoms_client', '$num_client', '$ville', '$commune','$quartier','$rue')");

        if($req->execute()){

           echo  '<div class="text-center text-success">Client ajouté avec succès</div>'; 
        }
        else
        {
             echo  'echec d\'enregistrement';  
        }
  
	}  
?>