<?php

include('controle.php');

include('connexion.php');

$request = $_REQUEST;

$col = array(
    0 =>'id_cat',
    1 => 'libelle_cat'
); // créer les colonnes comme dans la base de données

$sql ="SELECT * FROM categories";
$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

$totalFilter = $totalData;

$sql ="SELECT * FROM categories WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND ( id_cat LIKE '".$request['search']['value']."%' ";
    $sql.=" OR  libelle_cat LIKE '".$request['search']['value']."%' )";


}

$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

// ordre trie

$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT  ".$request['start']."  ,".$request['length']."  ";
$req = $db->prepare($sql);
$req->execute();

$data = array();

while($row=$req->fetch()){
    $subdata = array();
    $subdata[]=$row[0];// id_cat                $row[0] est id de la table categorie
    $subdata[]=$row[1];
    $subdata[]='<button class="btn btn-primary btn-sm edit" id="'.$row[0].'"><i class="fa fa-edit"></i></button>';
    $data[]=$subdata;
}

$json_data = array(
    "draw" => intval($request['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFilter),
    "data" => $data

);

echo json_encode($json_data);




?>
