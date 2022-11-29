<nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark">
    <div class="container-fluid"><a class="navbar-brand" href="accueil.php"><b>LGC</b></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav mx-auto">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="categorie.php">CATEGORIES</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="produit.php">PRODUITS</a></li>
                <!--<li class="nav-item" role="presentation"><a class="nav-link active" href="recette.php">RECETTE</a></li>-->
                <!--  <li class="nav-item" role="presentation"><a class="nav-link active" href="depense.php">DEPENSE</a></li> -->

                <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle active" data-toggle="dropdown" aria-expanded="false" href="#">DOC CAISSE</a>
                    <div class="dropdown-menu" role="menu" style="background-color:rgb(71,70,70);margin-top:8px;width:155px;padding:1px;max-width:0px;min-width:106px;">
                    <a class="dropdown-item text-white bg-dark" role="presentation" href="afficher_recette.php">RECETTE</a>
                
                    <a class="dropdown-item text-white bg-dark" role="presentation" href="afficher_depense.php">DEPENSES</a>
                    <!--  <a class="dropdown-item text-white bg-dark" role="presentation" href="afficher_caisse.php">CAISSE</a> -->
                    </div>
                </li>
               <!-- <li class="nav-item" role="presentation"><a class="nav-link active" href="agent.php">AGENT</a></li>
                    <?php if($_SESSION['type']=='admin'){ ?>
                <li class="nav-item" role="presentation"><a class="nav-link active" href="user.php">UTILISATEUR</a></li>-->
                    <?php } ?>
                <li class="dropdown" style="margin-left: 50px;"><a class="dropdown-toggle nav-link dropdown-toggle active" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fa fa-user"></i> <span class="text-uppercase text-warning"style="font-style: italic;" ><?php if(isset($_SESSION['user']) && isset($_SESSION['type'])){echo $_SESSION['user'].' ('.$_SESSION['type'].')';} ?></span></a>
                    <div class="dropdown-menu" role="menu" style="background-color:rgb(71,70,70);margin-top:8px;width:155px;padding:1px;max-width:0px;min-width:160px;"><a class="dropdown-item text-white bg-dark" role="presentation" href="logout.php?log=1">se deconnecter</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>