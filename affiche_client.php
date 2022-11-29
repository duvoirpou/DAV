<?php
include('controle.php');
require 'connexion.php';
$limit = 7;
if(isset($_GET['page'])){

	$page = $_GET['page'];

}
else
{
	$page = 1;
};

$demarre = ($page - 1) * $limit;

	$req = $db->query("SELECT * FROM clients  ORDER BY noms_cl ASC LIMIT $demarre,$limit");


	while($row = $req->fetch()){
		?>
			<tr>
				<td><?php echo $row['id_cl']?></td>
				<td><?php echo $row['noms_cl']?></td>
				<td><?php echo $row['tel_cl']?></td>
							<?php if($_SESSION['type']=='admin'){ ?>
				<td>
					<button type="button" class="btn btn-primary btn-sm edit" name="edit" id="<?php echo $row['id_cl'] ?>" ><i class="fa fa-edit"></i></button>	
				</td>
							<?php } ?>		
				<td><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#show-<?php echo $row['id_cl'] ?>"><i class="fa fa-eye"></i></button>

					<div class="modal fade" id="show-<?php echo $row['id_cl'] ?>" tabindex="-1" role="dialog" aria-labelledby="showLabel-<?php echo $row['id_cl'] ?>" aria-hidden="true">
						  <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="showLabel">Compte client client</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
                                 
						        <div class="modal-body">
						        	<?php $id_cl = $row['id_cl']; 

						        	include('compte_client.php');

						        	?>
						          
				                  
                  				</div>
							    <div class="modal-footer">
							       
							    </div>
						        
						    </div>
						  </div>
						</div>

				</td>
			</tr>

	<?php } 
