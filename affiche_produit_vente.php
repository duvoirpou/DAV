<?php

include('controle.php');
include('connexion.php');


$request = $_REQUEST;

$col = array(
    0 =>'id_prod',
    1 => 'description',
    3 =>'prix',
    4 =>'stock'
); // créer les colonnes comme dans la base de données

$sql ="SELECT * FROM produits";
$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

$totalFilter = $totalData;

$sql ="SELECT * FROM produits WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND ( description LIKE '".$request['search']['value']."%' ";
    $sql.=" OR prix LIKE '".$request['search']['value']."%' ";
    $sql.=" OR stock LIKE '".$request['search']['value']."%' ) ";



}

$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

// ordre trie

$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".$request['start']."  ,".$request['length']."  ";
$req = $db->prepare($sql);
$req->execute();

$data = array();

while($row=$req->fetch()){

    $subdata = array();
    $subdata[]=$row[1];
    $subdata[]=$row[3];
    $subdata[]=$row[4];
    $subdata[]='<button class="btn btn-primary btn-sm edit" id="'.$row[0].'"><i class="fa fa-plus-circle"></i></button>';
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