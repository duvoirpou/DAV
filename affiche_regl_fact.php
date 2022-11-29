<?php
include ('connexion.php');

$req_vent = $db->query("SELECT ca.id,ca.id_cmd,ca.mont_ch,ca.payer,ca.reste,date_format(ca.date_ca,'%d/%m/%Y') AS date_fr,cl.noms_cl FROM caisse AS ca INNER JOIN clients AS cl ON ca.id_cl=cl.id_cl WHERE ca.mont_ch!=0 AND ca.reste!=0 ORDER BY ca.id DESC");
$resul = $req_vent->fetchAll();

$tvent = $db->query("SELECT SUM(reste) FROM caisse");
$vent = $tvent->fetch();
$total_vent = $vent['0'];


foreach ($resul as $data){ ?>
    <tr>
        <td align="center"><?php echo $data['id_cmd'] ?></td>
        <td align="center"><?php echo $data['noms_cl'] ?></td>
        <td align="center"><?php echo $data['date_fr'] ?></td>
        <td align="center"><?php echo $data['mont_ch'] ?></td>
        <td align="center"><?php echo $data['payer'] ?></td>
        <td align="center"><?php echo $data['reste'] ?></td>
        <td align="center"><button  id="<?php echo $data['id'] ?>" class="btn btn-primary btn-sm regler">Regler</button>

            <div class="modal fade" id="Modregle" tabindex="-1" role="dialog" aria-labelledby="reglerLabel-<?php echo $data['id_cmd'] ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="reglerLabel">versement</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form method="post" id="form_vrmt">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-3">
                                    <label>Facture N° :</label>
                                </div>
                                <div class="col-9">
                                    <input name="id_cmd" readonly="readonly" id="id_cmd" class="form-control form-control-sm" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label>Montant :</label>
                                </div>
                                <div class="col-9">
                                    <input name="mont_ch" readonly="readonly" id="mont_ch" class="form-control form-control-sm" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label>avance :</label>
                                </div>
                                <div class="col-9">
                                    <input name="payer" readonly="readonly" id="payer" class="form-control form-control-sm" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label>reste :</label>
                                </div>
                                <div class="col-9">
                                    <input name="reste" readonly="readonly" id="reste" class="form-control form-control-sm" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="versement" class="col-form-label">versement :</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="versement" id="versement" class="form-control form-control-sm"  />
                                    <span id="erreur_vers" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span id="message" style="margin-right: 30px;"></span>
                            <input type="hidden" name="id_cache" id="id_cache" />
                            <input type="hidden" name="id_cl" id="id_cl" />
                            <input type="hidden" name="action" id="action" />
                            <input type="submit" class="btn btn-primary btn-sm" value="valider" />
                        </div>
                            </form>
                    </div>
                </div>
            </div>
         </div>
        </td>
    </tr>
<?php } ?>

    <tr>
        <td colspan="5"><div class="text-center alert-info" style="font-weight: bold;">MONTANT TOTAL DES FACTURES A REGLER </div></td>
        <td><div class="text-center alert-info" style="font-weight: bold;"><?php echo $total_vent; ?></div></td>
    </tr>


