<?php
include ('controle.php');
include('connexion.php');


$request = $_REQUEST;

$col = array(
    0 =>'id_users',
    1 => 'login',
    2 =>'password',
    3 =>'type'

); // créer les colonnes comme dans la base de données

$sql ="SELECT * FROM users";
$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

$totalFilter = $totalData;

$sql ="SELECT * FROM users WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND ( id_users LIKE '".$request['search']['value']."%' ";
    $sql.=" OR  login LIKE '".$request['search']['value']."%' ";
    $sql.=" OR  password LIKE '".$request['search']['value']."%'  ";
    $sql.=" OR  type LIKE '".$request['search']['value']."%' )";


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
    $subdata[]=$row[0];
    $subdata[]=$row[1];
    $subdata[]=$row[2];
    $subdata[]=$row[3];
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

