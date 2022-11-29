<?php 
	
	require 'connexion.php';

	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		

	
			
		$in = $db->query("SELECT * categories WHERE id_cat=$id ");
		
		
?>
<div class="form-group">
    <input class="form-control" type="text" id="id_cat" value=""> 
</div>
<div class="form-group">
    <input class="form-control" type="text" id="nom_cat" value=""> 
</div>