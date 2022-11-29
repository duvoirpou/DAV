<?php
	
	include ('connexion.php');
	$requet = "SELECT * FROM commande";
	$trait = $db->prepare($requet);
	$trait->execute();

	$result = $trait->fetchAll();
	$ligne = $trait->rowCount();

	$sortie = '
		<table class="table table-striped table-bordered table-sm">
			<tr>
				<th>id client</th>
				<th>date cmd</th>
				<th>modif</th>
				<th>suppr</th>
			</tr>	
	';

	if($ligne > 0)
	{
		foreach ($result as $row)
		{
			$sortie .='
				<tr>
					<td>'.$row['id_cl'].'</td>
					<td>'.$row['date_cmd'].'</td>
					<td>
						<button type="button" name="modif" class="btn btn-primary btn-sm modif" id="'.$row['id_cmd'].'"><i class="fa fa-edit"></i></button>
					</td>
					<td>
						<button type="button" name="suppr" class="btn btn-danger btn-sm suppr" id="'.$row['id_cmd'].'"><i class="fa fa-trash"></i></button>
					</td>
				</tr>

			';
		}
	}
	else
	{
		$sortie .= '
			<tr>
				<td colspan="4" align="center">aucune entrée</td>
			</tr>
		';
	}

	$sortie .= '</table>';
	echo $sortie;
?>