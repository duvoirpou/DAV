<?php 
include('connexion.php');

if(isset($_POST['motclef'])){
	$motclef = $_POST['motclef'];

	$tab = array('motclef'=>$motclef. '%');

	$req = $db->prepare("SELECT * FROM produits WHERE description LIKE :motclef");
	$req->execute($tab);
	$nbl = $req->rowcount();
	

	if($nbl>0){ 
			echo 'Resultat : '.$nbl.' produit(s) trouvé(s)'; ?>
			<table class="table table-sm">
				<tr>
					<th>Produit</th>
					<th>Qté</th>
					<th>Prix</th>
				</tr>
							
	<?php	while($reponse = $req->fetch(PDO::FETCH_OBJ)){ ?>
						
				<tr>
					<td><a href="" class="produit text-primary" id="<?= $reponse->id_prod ?>" style="text-decoration:none;"><?= $reponse->description ?></a></td>
					<td><?= $reponse->stock ?></td>
					<td><?= $reponse->prix ?></td>
				</tr>
			
		<?php } ?>

			</table>
		
<?php	}
	else
	{
		echo "aucun produit trouvé pour <span class='text-danger'>".$motclef."</span>";
	}
  
}          
