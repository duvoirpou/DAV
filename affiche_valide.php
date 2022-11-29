<?php
include ('controle.php');
include ('connexion.php');

$id_cl = $_SESSION['id_cl'];
$id_cmd = $_SESSION['id_cmd'];
$total = $_SESSION['montant'];
$client = $_SESSION['client'];

$req = $db->prepare("SELECT id_cmd FROM caisse WHERE id_cmd=$id_cmd");
$req->execute();
$imp = $req->rowcount(); ?>



                            <form  method="post" id="form_valide">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width: 30%;margin: auto;">
                                        <tr>
                                            <td> Client : <?= $client ?></td>
                                        </tr>
                                        <tr>
                                           <td>Facture N° : <?= $id_cmd ?></td>
                                        </tr>
                                        <tr>
                                            <td>Montant total (en chiffre)</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-control form-control-sm" type="" readonly name="mont_ch" value="<?= $total ?>" id="mont_ch">
                                                <input type="hidden" name="id_cl" id="id_cl" value="<?= $id_cl; ?>">
                                                <input type="hidden" name="id_cmd" id="id_cmd" value="<?= $id_cmd; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Montant total (en lettre)</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-control form-control-sm" type="text"  name="mont_let" id="mont_let">
                                                <span id="erreur_lettre" class="text-danger"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Montant à verser (en chiffre)</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-control form-control-sm" type="number"  name="pay" id="pay" >
                                                <span id="erreur_pay" class="text-danger"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                                    <input type="hidden" name="action" id="action" value="valider">
                                <div class="text-center"><button type="submit"  name="valider" id="valider" class="btn btn-success btn-sm" >valider la vente</button></div>

                            </form>

                            <br>
                            <div class="text-center"><a href="print_vente.php?id=<?=  $id_cmd ?>" target="_blank" class="btn btn-success btn-sm <?php if($imp==0){ echo 'disabled';}?>">Imprimer</a></div>

