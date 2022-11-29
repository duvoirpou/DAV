<?php
        include('controle.php');
        include('connexion.php');


$request = $_REQUEST;

$col = array(
    0 =>'id_prod',
    1 => 'description',
    2 =>'libelle_cat',
    3 =>'prix',
    
); // créer les colonnes comme dans la base de données

$sql ="SELECT prod.id_prod, prod.description, cat.libelle_cat, prod.prix  FROM categories AS cat INNER JOIN produits AS prod ON cat.id_cat=prod.id_cat";
$req = $db->prepare($sql);
$req->execute();
$totalData=$req->rowcount();

$totalFilter = $totalData;

$sql ="SELECT prod.id_prod, prod.description, cat.libelle_cat, prod.prix FROM categories AS cat INNER JOIN produits AS prod ON cat.id_cat=prod.id_cat";
if(!empty($request['search']['value'])){
    $sql.=" AND ( prod.id_prod LIKE '".$request['search']['value']."%' ";
    $sql.=" OR prod.description LIKE '".$request['search']['value']."%' ";
    $sql.=" OR  cat.libelle_cat LIKE '".$request['search']['value']."%' ";
    $sql.=" OR  prod.prix LIKE '".$request['search']['value']."%' ) ";
    


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
    $subdata[]='<?php if($_SESSION["type"]=="admin"){?>
                <button class="btn btn-primary btn-sm edit" id="'.$row[0].'"><i class="fa fa-edit"></i></button>
  <?php  } ?>';
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