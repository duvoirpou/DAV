<?php

    function affiche_client(){
        global $db;
        $requet = $db->prepare("SELECT * FROM clients ");
        $requet->execute();
        $option = "";
        $option.="<option>Selectionnez le client</option>";
        while($data = $requet->fetch()){
            $option.="<option value='".$data['id_client']."'>".$data['noms_client']." ".$data['prenoms_client']."</option>";
        }

        return $option;
    }

?>

