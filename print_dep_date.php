<?php

session_start();
include('connexion.php');
include('assets/fpdf/fpdf.php');

$date_dep = $_GET["d"];

$date_fr = strftime('%d/%m/%Y', strtotime($date_dep));


$req = $db->query("SELECT * FROM depense WHERE date_dep='$date_dep' ");
$resultat = $req->fetchAll();
$nb = $req->rowcount();

$dep_t = $db->query("SELECT SUM(montant) AS total FROM depense WHERE date_dep='$date_dep' ");
$reponse = $dep_t->fetch();

$total = $reponse["total"];

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
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

}

// Instanciation de la classe dérivée
$pdf = new PDF('P','mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
// Logo
//$pdf->Image('assets/img/logohp.png',250,8,25);
// Police Arial gras 15
$pdf->SetFont('Times','B',14);
// Décalage à droite

// entete
$pdf->Cell(200,6,"MIE D'ANGE",0,1,'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,utf8_decode('Boulangerie - Patisserie - Salon de thé'),0,1,'C');
$pdf->Cell(200,5,utf8_decode('102 Avenue de France - Poto-poto / P13.C1132 - Moukondo sonaco'),0,1,'C');
$pdf->Cell(200,5,utf8_decode('Tél. : +(242) 06 408 74 79 / 05 382 02 95 - 06 408 27 24 / 05 382 06 96'),0,1,'C');
$pdf->Cell(200,5,utf8_decode('E-mail. : mie.dangecongo@gmail.com'),0,1,'C');
$pdf->setLineWidth(0.3);
$pdf->Line(10,40,200,40);

// Saut de ligne
$pdf->Ln(15);

$pdf->setFont('Times','B',12);
$pdf->setLineWidth(0);
$pdf->SetFillColor(199, 199, 199);

$pdf->cell(50);
$pdf->cell(100,8, utf8_decode('DEPENSE DU '.$date_fr),1,1,'C');
$pdf->Ln(10);



$pdf->cell(90,6, utf8_decode('Libellé'),1,0,'C');
$pdf->cell(40,6, utf8_decode('Montant'),1,0,'C');
$pdf->cell(60,6, utf8_decode('Caissière'),1,1,'C');

if ($nb == 0) {
    $pdf->setFont('Times','',11);
    $pdf->cell(191,6, utf8_decode('Aucun enregistrement trouvé'),1,1,'C');

} else {
    foreach ($resultat AS $rows ) {
        $pdf->setFont('Times','',11);
       
        $pdf->cell(90,6, utf8_decode($rows["libelle"]),1,0);
        $pdf->cell(40,6, utf8_decode(number_format($rows["montant"],0,'',' ').' FCFA'),1,0,'R');
        $pdf->cell(60,6, utf8_decode($rows["caissiere"]),1,1);
    }     
    $pdf->setFont('Times','B',11);
    $pdf->cell(90,6, utf8_decode("TOTAL"),1,0,'C');
    $pdf->cell(40,6, utf8_decode(number_format($total,0,'',' ').' FCFA'),1,1,'R');
}



$pdf->Output();
