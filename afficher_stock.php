<?php
include('controle.php');
require 'connexion.php';

$request = $_REQUEST;

$col = array(
    0 =>'id',
    1 =>'id_pdt',
    2 => 'description',
    3 => 'libelle_cat',
    4 =>'qnte_init',
    5 =>'qnte_ent',
    6 =>'qnte_vend',
    7 =>'qnte_rest',
    8 =>'prix_uni',
    9 =>'prix_tot',
    10 =>'date_fr'

); // créer les colonnes comme dans la base de données

$sql ="SELECT production.id, production.id_pdt, produits.description, categories.libelle_cat, production.qnte_init, production.qnte_ent, production.qnte_vend, production.qnte_rest, production.prix_uni, production.prix_tot, date_format(production.date_production, '%d-%m-%Y') AS date_fr FROM production INNER JOIN produits ON production.id_pdt = produits.id_prod INNER JOIN categories ON production.id_cat = categories.id_cat ";
$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

$totalFilter = $totalData;

$sql ="SELECT production.id, production.id_pdt, produits.description, categories.libelle_cat, production.qnte_init, production.qnte_ent, production.qnte_vend, production.qnte_rest, production.prix_uni, production.prix_tot, date_format(production.date_production, '%d-%m-%Y') AS date_fr FROM production INNER JOIN produits ON production.id_pdt = produits.id_prod INNER JOIN categories ON production.id_cat = categories.id_cat  WHERE 1=1 ";
if(!empty($request['search']['value'])){
    $sql.=" AND ( production.id_pdt LIKE '".$request['search']['value']."%' ";
    $sql.=" OR produits.description LIKE '".$request['search']['value']."%' ";
    $sql.=" OR date_format(production.date_production, '%d-%m-%Y') LIKE '".$request['search']['value']."%' ";
    $sql.=" OR categories.libelle_cat LIKE '".$request['search']['value']."%') ";

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


    $subdata[]=$row[2];
    $subdata[]=$row[3];
    $subdata[]=$row[4];
    $subdata[]=$row[5];
    $subdata[]=$row[6];
    $subdata[]=$row[7];
    $subdata[]=$row[8];
    $subdata[]=$row[9];
    $subdata[]=$row[10];

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