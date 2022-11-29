<?PHP
session_start();
require 'connexion.php';

if(isset($_POST['login'])){

$user = htmlentities(trim($_POST['user']));
$pass = htmlentities(trim($_POST['pass']));

    if(empty($user)){

        $erreur_user= 'indiquez le nom d\'utilisateur';
    }

    if(empty($pass)){
        $erreur_pass='indiquez le mot de passe';
    }

    if (!empty($user) && !empty($pass)) {

        $req = $db->query("SELECT * FROM users WHERE login='$user' AND password='$pass' ");
        $data = $req->fetch();
        $user2 = $data['login'];
        $pass2 = $data['password'];
        $type = $data['type'];
        $id_user = $data['id_users'];

            if($user!=$user2){

                $erreur_user2= 'nom d\'utilisateur incorrect';
            }

            if($pass!=$pass2){

                $erreur_pass2='mot de passe incorrect';
            }

            if($user==$user2 && $pass==$pass2){

                $_SESSION['user']=$user2;
                $_SESSION['type'] = $type;
                $_SESSION['id'] = $id_user;

                header('location:accueil.php');
            }
    }
}

?>
<!doctype html>
<html>
<head>
    <title>LGC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body  style="background-image: url(assets/img/IMG-20191226-WA0043.jpg); background-repeat: no-repeat; background-size: cover">
    <div class="container" style="margin-top: 10%;margin-bottom: 7%;" >
        <div class="rows">
            <div class="col-4" style="margin: auto;">
                <div class="card" >
                    <div class="card-header">
                        <h6 class="text-center mb-0">AUTHENTIFICATION</h6>
                    </div>
                    <div class="card-body">
                        <form  method="post" action="index.php" id="login_form">
                            <div class="form-group" style="margin-top:20px;">
                                <input class="form-control form-control-sm" type="text" name="user"  placeholder="nom d'utilisateur" id="user" value="<?php if(!empty($user)){echo $user;}?>" style="text-align: center;">
                                <span id="erreur_user" class="text-danger"><?php if(isset($erreur_user)){ echo $erreur_user; } ?></span>
                                <span id="erreur_user" class="text-danger"><?php if(isset($erreur_user2)){ echo $erreur_user2; }  ?></span>
                            </div>
                            <div class="form-group" style="margin-top:20px;">
                                <input class="form-control form-control-sm" type="password" name="pass"  placeholder="mot de passe" id="pass" value="<?php if(!empty($pass)){echo $pass;}?>" style="text-align: center;">
                                <span id="erreur_pass" class="text-danger"><?php if(isset($erreur_pass)){ echo $erreur_pass; }  ?></span>
                                <span id="erreur_user" class="text-danger"><?php if(isset($erreur_pass2)){ echo $erreur_pass2; }  ?></span>
                            </div>
                            <div class="form-group" style="margin-top:20px;">
                                 <button type="submit" name="login" id="login" class="btn btn-info btn-block btn-sm">se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>
</html>