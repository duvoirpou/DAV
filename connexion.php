<?PHP	//connexion à la base de données par PDO
	try
		{
			$db = new PDO('mysql:host=localhost;dbname=db_dav;charset=utf8', 'root', '');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
			catch(PDOException $e)
		{
			die('Erreur : '.$e->getMessage());
		}
?>
