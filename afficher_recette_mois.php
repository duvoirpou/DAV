<?php

    include("connexion.php");

    $mois_rec = $_POST["mois_rec"];

    $req = $db->query("SELECT details_recette.libelle, SUM(details_recette.qte) AS qte, details_recette.pu,SUM(details_recette.pt) AS pt FROM details_recette JOIN recette ON details_recette.id_recette=recette.id WHERE recette.mois_recette='$mois_rec' GROUP BY details_recette.libelle");
    $resultat = $req->fetchAll();
    $nb = $req->rowcount();

    $requet = $db->query("SELECT SUM(montant) AS mt FROM recette  WHERE mois_recette='$mois_rec'");
    $rep=$requet->fetch();
    $total = $rep['mt'];

    $sortie = '';

    $sortie.= '<div class="text-center font-weight-bold">Recette du mois de '.$mois_rec.'</div><br />';
    $sortie.='<div class="table-responsive"><table class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="65%">Libelle</th>
                        <th width="5%">Qté</th>
                        <th width="15%">Pu</th>
                        <th width="15%">Pt</th>
                    </tr>
                </thead>
                <tbody>';
    if($nb==0)
    {
        $sortie.='<tr><td colspan="4" style="text-align:center;">Aucun enregistrement trouvé</td></tr>';
    }
    else
    {
        foreach($resultat AS $row)
        {
            $sortie.='<tr>
                        <td>'.$row["libelle"].'</td> 
                        <td>'.$row["qte"].'</td> 
                        <td>'.number_format($row["pu"],0,'',' ').' FCFA</td>  
                        <td>'.number_format($row["pt"],0,'',' ').' FCFA</td>  
                    </tr>';
        }
        
        $sortie.='<tr>
                        <td colspan="3">Total</td>  
                        <td>'.number_format($total,0,'',' ').' FCFA</td>  
                    </tr>';
    }

    $sortie.='</tbody>
            </table></div>
            <br />
            <div class="text-center"><a class="btn btn-success" href="print_rec_mois.php?m='.$mois_rec.'" target="_blank"><i class="fa fa-print"></i> Imprimer</a></div>
            ';

    echo json_encode($sortie);           