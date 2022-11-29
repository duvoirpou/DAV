<?php

include('connexion.php');

if(isset($_POST['action'])&& $_POST['action']=='ok')
{
    $date_sel = $_POST['date_sel'];
    $req_vent = $db->query("SELECT cl.id_cl,cl.noms_cl,jour.id_cmd,jour.montant,DATE_FORMAT(jour.date_jour,'%d/%m/%Y') AS date_fr FROM clients AS cl INNER JOIN journal_caisse AS jour ON cl.id_cl=jour.id_cl WHERE jour.date_jour = '".$date_sel."' ORDER BY jour.ref DESC");
}
else
{
   $req_vent = $db->query("SELECT cl.id_cl,cl.noms_cl,jour.id_cmd,jour.montant,DATE_FORMAT(jour.date_jour,'%d/%m/%Y') AS date_fr FROM clients AS cl INNER JOIN journal_caisse AS jour ON cl.id_cl=jour.id_cl WHERE jour.date_jour = current_date() ORDER BY jour.ref DESC");
    
}

        
        $nbl = $req_vent->rowCount();
        
        if($nbl!=0)
        {
            
            while($resul=$req_vent->fetch())
            { ?>
            
                <tr>
                    <td><?= $resul['id_cl'] ?></td>
                    <td><?= $resul['noms_cl'] ?></td>
                    <td><?= $resul['cmd'] ?></td>
                    <td><?= $resul['montant'] ?></td>
                    <td><?= $resul['date_fr'] ?></td>
                </tr>
        <?php }  
                  
        }
        else
        { ?>
            <tr><td colspan="5" align="center" class="text-primary">vous n'avez rien encaissé aujourd'hui</td></tr>
        <?php }

?>
