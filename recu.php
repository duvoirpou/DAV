<?php
session_start();
include('connexion.php');
include('assets/fpdf/fpdf.php');

$id_recette = $_GET['p'];
$req = $db->query("SELECT libelle, qte, pu,pt FROM details_recette WHERE id_recette=$id_recette");

$req_t = $db->query("SELECT  SUM(pt) AS total FROM details_recette WHERE id_recette=$id_recette");
$re = $req_t->fetch();
$total = $re['total'];

//On définie la date du jour
$date_jour = date('d-n-Y H:i:s');

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
        $this->SetFont('Arial','I',9);
        // Numéro de page
       // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation de la classe dérivée
$pdf = new PDF('p','mm', array(80,150));
$pdf->setMargins(5,5,5);
$pdf->AliasNbPages();
$pdf->AddPage();

// Logo
//$pdf->Image('assets/img/logo_galilee.png',115,6,21);
// Police Arial gras 15
$pdf->SetFont('Times','B',9);
// Décalage à droite

// Titre
$pdf->Image('assets/img/mie.jpg',2,3,15);
$pdf->Cell(70,4,"MIE D'ANGE",0,1,'C');
$pdf->SetFont('Times','B',8);
$pdf->Cell(70,4,utf8_decode('Boulangerie - Patisserie - Salon de thé'),0,1,'C');
$pdf->SetFont('Times','',6);
$pdf->Cell(70,3,utf8_decode('102 Avenue de France - Poto-poto / P13.C1132 - Moukondo sonaco '),0,1,'C');
$pdf->Cell(70,3,utf8_decode('Tél. : +(242) 06 408 74 79 / 05 382 02 95 - 06 408 27 24 / 05 382 06 96'),0,1,'C');
$pdf->Cell(70,3,utf8_decode('E-mail. : mie.dangecongo@gmail.com'),0,1,'C');
$pdf->setLineWidth(0.1);
$pdf->Line(6,23,74,23);
$pdf->Ln(2);
$pdf->Cell(100,4,"Brazzaville, le $date_jour",0,1,'C');
// Saut de ligne
$pdf->Ln(10);

$pdf->setFont('Times','B',8);
$pdf->setLineWidth(0);
$pdf->Multicell(0, 5, utf8_decode("REÇU DE CAISSE N° $id_recette"), 0, "C");

$pdf->Ln(5);
$pdf->setFont('Times','B',8);
//$pdf->SetFillColor(199, 199, 199);

$pdf->cell(32,6,utf8_decode('Libelle'),0,0);
$pdf->cell(8,6,utf8_decode('Qté'),0,0, 'C');
$pdf->cell(15,6,utf8_decode('Pu'),0,0, 'R');
$pdf->cell(15,6,utf8_decode('Pt'),0,1, 'R');
$pdf->setFont('Times','',8);

while ($mtp = $req->fetch()) {
    
$pdf->cell(32,6,utf8_decode($mtp['libelle']),0,0);
$pdf->cell(8,6,$mtp['qte'],0,0,'C');
$pdf->cell(15,6,number_format($mtp['pu'], 0, '', ' ').' F',0,0,'R');
$pdf->cell(15,6, number_format($mtp['pt'], 0, '', ' ').' F',0,1,'R');

}

$pdf->setFont('Times','B',8);
$pdf->cell(55,6,'Total',0,0);
$pdf->cell(15,6,number_format($total, 0, '', ' ').' F',0,0,'R');

$pdf->Output();