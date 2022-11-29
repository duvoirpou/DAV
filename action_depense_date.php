<?php

include("connexion.php");


$date_dep = $_POST["date_dep"];

$date_fr = strftime('%d/%m/%Y', strtotime($date_dep));


$req = $db->query("SELECT * FROM depense WHERE date_dep='$date_dep' ");
$resultat = $req->fetchAll();
$nb = $req->rowcount();


$sortie = '';

$sortie.= '<div class="text-center font-weight-bold">Dépense du '.$date_fr.'</div><br />';
$sortie.='<div class="table-responsive"><table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="100">Libelle</th>
                                            <th width="100">Montant</th>
                                            <th width="100">Caissière</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
if($nb==0)
{
    $sortie.='<tr><td colspan="3" style="text-align:center;">Aucun enregistrement trouvé</td></tr>';
}
else
{
    foreach($resultat AS $row)
    {
        $sortie.='<tr>
                       <td>'.$row["libelle"].'</td> 
                       <td>'.number_format($row["montant"],0,'',' ').' FCFA</td> 
                       <td>'.$row["caissiere"].'</td> 
                  </tr>';
    }
}

$sortie.='</tbody>
           </table></div>
           <br />
           <div class="text-center"><a class="btn btn-success" href="print_dep_date.php?d='.$date_dep.'" target="_blank"><i class="fa fa-print"></i> Imprimer</a></div>
           ';




echo json_encode($sortie);           