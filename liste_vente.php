<?php
include('controle.php');
include('connexion.php');
    

$sql ="SELECT cmd.id_cmd,cl.id_cl,cl.noms_cl,DATE_FORMAT(cmd.date_cmd, '%d-%m-%Y') AS date_fr,cmd.montant FROM commande AS cmd INNER JOIN clients AS cl ON cmd.id_cl=cl.id_cl";
$req = $db->prepare($sql);
$req->execute();
$ligne=$req->rowcount();

if($ligne==0){ ?>

<tr><td colspan="5" align="center"><h6 class="text-dark">Aucune donnée trouvée</h6></td></tr>

 <?php }
 
    else{
        while($row = $req->fetch()){ ?>

        <tr>
            <td><?= $row['id_cmd'] ?></td>
            <td><?= $row['noms_cl'] ?></td>
            <td><?= $row['date_fr'] ?></td>
            <td><?= $row['montant'] ?></td>
            <td>
                <form method="post" action="details_vente.php">
                    <input type="hidden" name="cmd" value="<?= $row['id_cmd'] ?>" />
                    <input type="hidden" name="client" value="<?= $row['noms_cl'] ?>" />
                    <input type="hidden" name="cl" value="<?= $row['id_cl'] ?>" />
                    <input type="submit" name="vente" value="detail vente" class="btn btn-info btn-sm">
                </form>
            </td>
        </tr>

      <?php  }
    }


?>