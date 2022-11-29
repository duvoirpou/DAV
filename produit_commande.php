<?php

include('controle.php');

include('connexion.php');

$request = $_REQUEST;

$col = array(
    0 =>'id_prod',
    1 => 'description',
    2 => 'libelle_cat',
    3 =>'prix',
    4 =>'stock'
); // créer les colonnes comme dans la base de données

$sql ="SELECT  produits.id_prod, produits.description, categories.libelle_cat, produits.prix, produits.stock FROM produits JOIN categories ON produits.id_cat=categories.id_cat ";
$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

$totalFilter = $totalData;

$sql ="SELECT  produits.id_prod, produits.description, categories.libelle_cat, produits.prix, produits.stock FROM produits JOIN categories ON produits.id_cat=categories.id_cat WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND ( produits.description LIKE '".$request['search']['value']."%' ";
    $sql.=" OR  categories.libelle_cat LIKE '".$request['search']['value']."%' )";
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
    $subdata[]=$row[1];
    $subdata[]=$row[2];
    $subdata[]=$row[3];
    $subdata[]=$row[4];
    $subdata[]='<button class="btn btn-primary btn-sm commander" id="'.$row[0].'">Ajoutez dans le panier</button>';
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
