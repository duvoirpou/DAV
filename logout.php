<?PHP
session_start();

if(isset($_GET['log'])==1){

	unset($_SESSION['user']);
	session_destroy();
    header('location:index.php');
    
}
