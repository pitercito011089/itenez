<?php
require_once('tcpdf/tcpdf.php');
session_start();

$pdf = new TCPDF();
$nombreEmpresa = "Iténez";
$numeroCelular = "63461474";
$logoEmpresa = 'img/Logo4.png';

// Configura el PDF
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Agrega contenido al PDF

$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, 'Fecha: ' . date('Y-m-d H:i:s'), 0, 1, 'L');

$pdf->SetY($pdf->GetY() - 10);
$pdf->Cell(0, 10, 'Empresa: ' . $nombreEmpresa, 0, 1, 'L'); 
$pdf->Cell(0, 10, 'Celular: ' . $numeroCelular, 0, 1, 'R'); 

$logoWidth = 30; 
$logoHeight = 20; 
$pdf->Image($logoEmpresa, 150, 15, $logoWidth, $logoHeight);

$pdf->Cell(0, 10, '', 0, 1);

$clientes = [
    ["nombre" => "Juna Zambrana Mojica", "telefono" => "69327498", "direccion" => "Calle Bolivar #23"],
    ["nombre" => "Diana Vargas Ceballo", "telefono" => "70238409", "direccion" => "Plan 3000"],
    ["nombre" => "Pablo Suarez", "telefono" => "60993249", "direccion" => "Montero"],
    ["nombre" => "Alejandra Soliz Justiniano", "telefono" => "69397473", "direccion" => "La Guardia"],
    ["nombre" => "Jose Castro Segundo", "telefono" => "70208983", "direccion" => "Camiri"],
];

$pdf = new TCPDF();
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Listado de Clientes', 0, 1, 'C');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(70, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(30, 10, 'Teléfono', 1, 0, 'C');
$pdf->Cell(90, 10, 'Dirección', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 10);

foreach ($clientes as $cliente) {
    $pdf->Cell(70, 10, $cliente['nombre'], 1, 0, 'L');
    $pdf->Cell(30, 10, $cliente['telefono'], 1, 0, 'C');
    $pdf->Cell(90, 10, $cliente['direccion'], 1, 1, 'L');
}

$pdf->Output('listado_clientes.pdf', 'I');
?>
?>