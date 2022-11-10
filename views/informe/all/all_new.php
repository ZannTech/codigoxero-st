<?php

use Fpdf\Fpdf;

class PDF extends Fpdf
{
    function Header()
    {
    }
    function Footer()
    {
    }
}
//
$pdf = new Fpdf('L', 'mm', array(200, 400));
$pdf->AliasNbPages();
$pdf->AddFont('Anton-Regular', '', 'Anton-Regular.php');
$pdf->AddPage();
$pdf->SetFont('Anton-Regular', '', 25);
$pdf->Write(10, "Reporte General CodigoXero");
$pdf->Image('');
$pdf->Output('');
