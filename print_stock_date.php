<?php

session_start();
include('connexion.php');
include('assets/fpdf/fpdf.php');

  //Onn récupère les données du formulaire modale vente
  $date_entrer = $_GET['d'];

  $date_fr = strftime('%d/%m/%Y', strtotime($date_entrer));

  $req = $db->query("SELECT * FROM categories");

  $sr = $req->fetchAll(PDO::FETCH_OBJ);


  $requette=$db->query("SELECT  SUM(stock) AS ts, SUM(entree)AS te, SUM(sortie) AS tsort, SUM(solde) AS tsolde FROM stock WHERE  date_st='$date_entrer' ");
  $reponse = $requette->fetch(PDO::FETCH_OBJ);

  $i=1;
 

class PDF extends FPDF
{
// En-tête
    function Header()
    {



    }

// Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,utf8_decode('Edité le '.date('d/m/Y').' à '.date('H:m:i')),0,0);
    }

}

// Instanciation de la classe dérivée
$pdf = new PDF('P','mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
// Logo
//$pdf->Image('assets/img/mie.png',10,9,40);
// Police Arial gras 15
$pdf->SetFont('Times','B',14);
// Décalage à droite

// entete
$pdf->Cell(200,6,"MIE D'ANGE",0,1,'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,utf8_decode('Boutique - vente de vêtement haut de gamme'),0,1,'C');
$pdf->Cell(200,5,utf8_decode(''),0,1,'C');
$pdf->Cell(200,5,utf8_decode('Tél. : +(242) 06 595 36 64 / 06 468 57 93'),0,1,'C');
$pdf->Cell(200,5,utf8_decode('E-mail. : davybrice30@gmail.com'),0,1,'C');
$pdf->setLineWidth(0.2);
$pdf->Line(10,39,200,39);

$pdf->setLineWidth(0.5);
$pdf->Line(10,40,200,40);

// Saut de ligne
$pdf->Ln(15);

$pdf->setFont('Times','B',12);
$pdf->setLineWidth(0);
$pdf->SetFillColor(199, 199, 199);

$pdf->cell(40);
$pdf->cell(120,8, utf8_decode('TABLEAUX RECAPITULATIFS DU STOCK DU '.$date_fr),1,1,'C');
$pdf->Ln(5);


foreach($sr AS $data) {

    $pdf->Ln(10);

    $pdf->cell(190,8, utf8_decode($data->libelle_cat),0,1,'C');


    $tt=$db->query("SELECT matiere_premiere.libelle, categories.libelle_cat, SUM(stock.stock) AS stock, SUM(stock.entree)AS entree, SUM(stock.sortie) AS sortie,SUM(stock.solde) AS solde FROM stock JOIN matiere_premiere ON stock.id_mat=matiere_premiere.id_mat JOIN categories ON stock.id_cat=categories.id_cat WHERE stock.id_cat=$data->id_cat AND stock.date_st='$date_entrer' GROUP BY matiere_premiere.libelle");
    $fd = $tt->fetchAll(PDO::FETCH_OBJ);
    $ligne= $tt->rowCount();

    $requet=$db->query("SELECT  SUM(stock) AS ts, SUM(entree)AS te, SUM(sortie) AS tsort, SUM(solde) AS tsolde FROM stock WHERE id_cat=$data->id_cat AND date_st='$date_entrer' ");
    $resultat = $requet->fetch(PDO::FETCH_OBJ);


    $pdf->cell(15,6, utf8_decode('N°'),1,0,'C');
    $pdf->cell(75,6, utf8_decode('Matière'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Stock Init.'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Entrée'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Sortie'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Solde'),1,1,'C');

    
    if($ligne==0){
        

        $pdf->cell(190,6, utf8_decode('Aucun enregistrement trouvé'),1,0,'C');

    }
    else
    {
        foreach( $fd AS $recap) { 

            $pdf->cell(15,6, utf8_decode($i++),1,0,'C');
            $pdf->cell(75,6, utf8_decode($recap->libelle),1,0,'C');
            $pdf->cell(25,6, utf8_decode($recap->stock),1,0,'C');
            $pdf->cell(25,6, utf8_decode($recap->entree),1,0,'C');
            $pdf->cell(25,6, utf8_decode($recap->sortie),1,0,'C');
            $pdf->cell(25,6, utf8_decode($recap->solde),1,1,'C');

        }

            $pdf->cell(90,6, utf8_decode('SOUS TOTAL'),1,0,'C');
            $pdf->cell(25,6, utf8_decode($resultat->ts),1,0,'C');
            $pdf->cell(25,6, utf8_decode($resultat->te),1,0,'C');
            $pdf->cell(25,6, utf8_decode($resultat->tsort),1,0,'C');
            $pdf->cell(25,6, utf8_decode($resultat->tsolde),1,1,'C');
    }

}

    $pdf->Ln(15);
    $pdf->cell(90,12, utf8_decode('TOTAL GENERAL'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Stock Init.'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Entrée'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Sortie'),1,0,'C');
    $pdf->cell(25,6, utf8_decode('Solde'),1,1,'C');
    $pdf->cell(90);
    $pdf->cell(25,6, utf8_decode($reponse->ts),1,0,'C');
    $pdf->cell(25,6, utf8_decode($reponse->te),1,0,'C');
    $pdf->cell(25,6, utf8_decode($reponse->tsort),1,0,'C');
    $pdf->cell(25,6, utf8_decode($reponse->tsolde),1,1,'C');



$pdf->Output();
