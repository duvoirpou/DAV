<?PHP
    include('controle.php');
    require 'connexion.php';
    /* $requette = $db->query("SELECT * FROM produits WHERE stock BETWEEN 1 AND 5 ");
    $pa = $requette->rowcount(); */

?>

<!doctype html>
<html>
    <head>
        <title>accueil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body class="bg-info">
    <?php   include('menu.php');  ?>
    <div class="container"  style="margin-top: 7%;margin-bottom:7%;">
        <div class="card border-primary" style="color:rgb(7,7,7);margin-top: 2%;">
            <div class="card-header">
                <h5 class="text-center mb-0">CREER UN AGENT</h5>
            </div>
            <div class="card-body">
            <div align='right'>
                <a href='liste_agent.php' class="btn btn-primary btn-sm">Liste des agents</a>
            </div><br />
            <form method="post" id="inscription_form" enctype="multipart/form-data" action="save_agent.php">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="noms_ag">Nom(s)</label>
                                        <input type='text' name='noms_ag' class="form-control form-control-sm" placeholder="Nom agent" id="noms_ag" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="prenoms_ag">Prenom(s)</label>
                                        <input type='text' name='prenoms_ag' placeholder="Prenom agent" class="form-control form-control-sm" id="prenoms_ag" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_naiss">Date de naissance</label>
                                        <input type='date' name='date_nais' placeholder="Date de naissance agent" class="form-control form-control-sm" id="date_naiss" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lieu_nais">Lieu de naissance</label>
                                        <input type='text' name='lieu_nais' placeholder="Lieu de naissance agent" class="form-control form-control-sm" id="lieu_nais" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sexe_ag">Sexe</label>
                                        <select name='sexe_ag' class="form-control form-control-sm" id="sexe_ag">
                                            <option value=''></option>
                                            <option value='M'>Masculin</option>
                                            <option value='F'>Feminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nationalite">Nationalité</label>
                                        <input type='text' name='nationalite' placeholder="nationalite" class="form-control form-control-sm" id="nationalite" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <input type='text' name='adresse' placeholder="Adresse de l'agent" class="form-control form-control-sm" id="adresse" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tele">Télephone</label>
                                        <input type='text' name='tele' placeholder="Télephone agent" class="form-control form-control-sm" id="tele" />
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sitfam_ag">Situation familiale</label>
                                        <select name='sitfam_ag' class="form-control form-control-sm" id="sitfam_ag">
                                            <option value=''></option>
                                            <option value='celibataire'>Célibataire</option>
                                            <option value='fiance'>Fiancé(e)</option>
                                            <option value='marie'>Marié(e)</option>
                                            <option value='divorce'>Divorcé(e)</option>
                                            <option value='veuf'>Veuf(ve)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="charge">Charge</label>
                                        <input type='numerique' name='charge' placeholder="Enfant à charge" class="form-control form-control-sm" id="charge" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_eg">Date d'engagement</label>
                                        <input type='date' name='date_eng' placeholder="Date d'engagement agent" class="form-control form-control-sm" id="date_eng" />
                                    </div>
                                </div>
                                <div class="col">
                                <div class="form-group">
                                        <label for="contrat_ag">Contrat agent</label>
                                        <select name='contrat_ag' class="form-control form-control-sm" id="contrat_ag">
                                            <option value=''></option>
                                            <option value='CDI'>CDI</option>
                                            <option value='CDD'>CDD</option>
                                            <option value='Stage'>Stage</option>
                                            <option value='Autres'>Autres</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fonction">Fonction agent</label>
                                        <input type='text' name='fonction' placeholder="Fonction agent" class="form-control form-control-sm" id="fonction" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sal_base">Salaire de base</label>
                                        <input type='number' name='sal_base' placeholder="Salaire de base agent" class="form-control form-control-sm" id="sal_base" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="prime_fct">Prime de fonction</label>
                                        <input type='number' name='prime_fct' placeholder="Prime de fonction agent" class="form-control form-control-sm" id="prime_fct" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="prime_autre">Autre prime</label>
                                        <input type='number' name='prime_autre' placeholder="Autre prime agent" class="form-control form-control-sm" id="prime_autre" />
                                    </div>
                                </div>
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="pull-right">
                                    <input type="hidden" name="matricule" id="matricule" />
                                    <input type="hidden" name="operation" id="operation" value="ajouter" />
                                    <input type="submit" name="action" id="action" value="Enregistrer" class="btn btn-success btn-sm" />
                                </div>
                            </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>
        <?php include('footer.php') ?>
        <script src="assets/js/saisir_recette.js"></script>
        <script src="assets/js/saisir_recette.js"></script>
    </body>
</html>