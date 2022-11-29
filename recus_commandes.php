<?php
session_start();
include('connexion.php');
include('assets/fpdf/fpdf.php');

$id_cmd = $_GET['p'];
$req = $db->query("SELECT * FROM commande JOIN clients ON commande.id_client=clients.id_client WHERE commande.id_cmd=$id_cmd");


$re = $req->fetch();

//On définie la date du jour
$date_jour = date('d/m/Y H:i:s');

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
        $this->SetFont('Arial','I',12);
        // Numéro de page
       // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation de la classe dérivée
$pdf = new PDF('p','mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();

// Logo
//$pdf->Image('assets/img/logo_galilee.png',115,6,21);
// Police Arial gras 15
$pdf->SetFont('Times','B',12);
// Décalage à droite

// Titre
$pdf->Image('assets/img/IMG-20191226-WA0033.jpg',10,10,20);
$pdf->Cell(200,5,"DAV Osez le pagne",0,1,'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,utf8_decode('Boutique en ligne : vente de vêtements Afritude haut de gamme'),0,1,'C');
$pdf->SetFont('Times','',11);
$pdf->Cell(200,5,utf8_decode('Rue Franceville - Poto-poto'),0,1,'C');
$pdf->Cell(200,5,utf8_decode('Tél. : +(242) 05 595 36 64 / 06 468 57 93'),0,1,'C');
$pdf->Cell(200,5,utf8_decode('E-mail. : davybrice30@gmail.com'),0,1,'C');
$pdf->setLineWidth(0.2);
$pdf->Line(6,37,200,37);
$pdf->Ln(5);
$pdf->Cell(90);
$pdf->Cell(100,4,"Brazzaville, le $date_jour",0,1,'R');
// Saut de ligne
$pdf->Ln(10);

$pdf->setFont('Times','B',14);
$pdf->setLineWidth(0);
$pdf->Multicell(0, 5, utf8_decode("REÇU DE CAISSE N° $id_cmd"), 0, "C");

$pdf->Ln(5);
$pdf->setFont('Times','B',12);
//$pdf->SetFillColor(199, 199, 199);
$pdf->cell(32,6,utf8_decode('Client'),0,0);
$pdf->cell(100,6,utf8_decode($re['noms_client'].' '.$re['prenoms_client']),0,1);
$pdf->Ln(5);
$pdf->cell(148,6,utf8_decode('Modele'),1,0);
$pdf->cell(42,6,utf8_decode('Nombre de tissus'),1,1, 'C');

$pdf->setFont('Times','',12);
$pdf->cell(148,6,utf8_decode($re['modele']),1,0);
$pdf->cell(42,6,$re['nbre_tissus'],1,1,'C');
$pdf->Ln(5);
$pdf->cell(30,6,utf8_decode('Montant : '),0,0);
$pdf->cell(42,6,$re['montant'],0,1);
$pdf->cell(30,6,utf8_decode('Avance : '),0,0);
$pdf->cell(42,6,$re['avance'],0,1);


$pdf->cell(30,6,utf8_decode('Reste : '),0,0);
$pdf->cell(42,6,$re['montant']-$re['avance'],0,0);
$pdf->cell(50);
$pdf->cell(68,6,utf8_decode('Caissier(e)'),0,1,'C');



$pdf->cell(30,6,utf8_decode('Date de depot : '),0,0);
$pdf->cell(42,6,strftime('%d/%m/%Y', strtotime($re['date_depot'])),0,1);
$pdf->cell(30,6,utf8_decode('Date de retrait : '),0,0);
$pdf->cell(42,6,strftime('%d/%m/%Y', strtotime($re['date_retrait'])),0,1);
$pdf->cell(122);
$pdf->cell(68,6,$re['caissiere'],0,1,'C');









$pdf->Output();