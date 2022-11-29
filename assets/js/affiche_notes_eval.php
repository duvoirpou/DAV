<?php

include('controle.php');
include('connexion.php');

if (isset($_POST['choix'])) {

    $id = $_POST['id'];
    $_SESSION['id'] = $id_matiere;
}

$id_cont = $_POST['id_cont'];
$note = 'note' . $id_cont;



$id_trim = $_SESSION['trimestre'];
$id_classe = $_SESSION['classe'];
$annee_scolaire = $_SESSION['annee_scolaire'];

if ($id_cont == 1) {
    $req = $db->prepare("SELECT eleve.matricule, eleve.noms, eleve.prenoms, releve_note.$note FROM releve_note JOIN eleve ON eleve.matricule = releve_note.matricule_eleve ");
    $req->execute(array(':id_niv' =>  $_SESSION['id_niv']));
    while ($row = $req->fetch()) { ?>
        <tr>
            <td><?= $row['matricule'] ?></td>
            <td><?= $row['noms'] ?></td>
            <td><?= $row['prenoms'] ?></td>
            <td><?= $row['".$note."'] ?></td>
            <td>
                <a class="btn btn-primary btn-sm" target="_blank" href="impr_bulletin.php?matricule=<?= $row['matricule'] ?>">Bulletin</a>
            </td>
        </tr>
    <?php }
} elseif ($id_cont == 2) {
    $req = $db->prepare("SELECT eleve.matricule, eleve.noms, eleve.prenoms, releve_note.note2 FROM releve_note JOIN eleve ON eleve.matricule = releve_note.matricule_eleve ");
    $req->execute(array(':id_niv' =>  $_SESSION['id_niv']));
    while ($row = $req->fetch()) { ?>
        <tr>
            <td><?= $row['matricule'] ?></td>
            <td><?= $row['noms'] ?></td>
            <td><?= $row['prenoms'] ?></td>
            <td><?= $row['note1'] ?></td>
            <td>
                <a class="btn btn-primary btn-sm" target="_blank" href="impr_bulletin.php?matricule=<?= $row['matricule'] ?>">Bulletin</a>
            </td>
        </tr>
    <?php }
} elseif ($id_cont == 3) {
    $req = $db->prepare("SELECT eleve.matricule, eleve.noms, eleve.prenoms, releve_note.note3 FROM releve_note JOIN eleve ON eleve.matricule = releve_note.matricule_eleve ");
    $req->execute(array(':id_niv' =>  $_SESSION['id_niv']));
    while ($row = $req->fetch()) { ?>
        <tr>
            <td><?= $row['matricule'] ?></td>
            <td><?= $row['noms'] ?></td>
            <td><?= $row['prenoms'] ?></td>
            <td><?= $row['note1'] ?></td>
            <td>
                <a class="btn btn-primary btn-sm" target="_blank" href="impr_bulletin.php?matricule=<?= $row['matricule'] ?>">Bulletin</a>
            </td>
        </tr>
    <?php }
} elseif ($id_cont == 4) {
    $req = $db->prepare("SELECT eleve.matricule, eleve.noms, eleve.prenoms, releve_note.note4 FROM releve_note JOIN eleve ON eleve.matricule = releve_note.matricule_eleve ");
    $req->execute(array(':id_niv' =>  $_SESSION['id_niv']));
    while ($row = $req->fetch()) { ?>
        <tr>
            <td><?= $row['matricule'] ?></td>
            <td><?= $row['noms'] ?></td>
            <td><?= $row['prenoms'] ?></td>
            <td><?= $row['note1'] ?></td>
            <td>
                <a class="btn btn-primary btn-sm" target="_blank" href="impr_bulletin.php?matricule=<?= $row['matricule'] ?>">Bulletin</a>
            </td>
        </tr>
    <?php }
}


?>