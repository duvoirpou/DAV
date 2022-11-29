<?php

session_start();
include('connexion.php');
include('assets/fpdf/fpdf.php');

$mois_rec = $_GET["m"];



$req = $db->query("SELECT details_recette.libelle, SUM(details_recette.qte) AS qte, details_recette.pu,SUM(details_recette.pt) AS pt FROM details_recette JOIN recette ON details_recette.id_recette=recette.id WHERE recette.mois_recette='$mois_rec' GROUP BY details_recette.libelle ");
$resultat = $req->fetchAll();
$nb = $req->rowcount();

$requet = $db->query("SELECT SUM(montant) AS mt FROM recette  WHERE mois_recette='$mois_rec'  ");
$rep=$requet->fetch();
$total = $rep['mt'];

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
$pdf->Image('assets/img/mie.png',250,8,25);
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
$pdf->cell(100,8, utf8_decode(mb_strtoupper('RECETTE DU MOIS DE '.$mois_rec)),1,1,'C');
$pdf->Ln(10);



$pdf->cell(90,6, utf8_decode('Libellé'),1,0,'C');
$pdf->cell(20,6, utf8_decode('Qté'),1,0,'C');
$pdf->cell(40,6, utf8_decode('PU'),1,0,'C');
$pdf->cell(40,6, utf8_decode('PT'),1,1,'C');

if ($nb == 0) {
    $pdf->setFont('Times','',12);
    $pdf->cell(191,6, utf8_decode('Aucun enregistrement trouvé'),1,1,'C');

} else {
    foreach ($resultat AS $rows ) {
        $pdf->setFont('Times','',12);
       
        $pdf->cell(90,6, utf8_decode($rows["libelle"]),1,0);
        $pdf->cell(20,6, utf8_decode($rows["qte"]),1,0,'C');
        $pdf->cell(40,6, utf8_decode(number_format($rows["pu"],0,'',' ').' FCFA'),1,0,'R');
        $pdf->cell(40,6, utf8_decode(number_format($rows["pt"],0,'',' ').' FCFA'),1,1,'R');
        
    }     
    $pdf->setFont('Times','B',12);
    $pdf->cell(150,6, utf8_decode("TOTAL"),1,0,'C');
    $pdf->cell(40,6, utf8_decode(number_format($total,0,'',' ').' FCFA'),1,1,'R');
}



$pdf->Output();
