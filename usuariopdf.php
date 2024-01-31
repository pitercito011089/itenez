<?php
require_once('tcpdf/tcpdf.php');

$usuarios = [
    ["usuario" => "paco", "nombre" => "PacoHunter", "telefono" => "6667771234", "direccion" => "Nowhere"],
    ["usuario" => "alex", "nombre" => "Alexander Zabala Vargas", "telefono" => "63461474", "direccion" => "Colpa-Belgica"],
    ["usuario" => "fer", "nombre" => "Fernando Castro", "telefono" => "63023824", "direccion" => "Av. Pirai 3er Anillo # 23"],
    ["usuario" => "gabi", "nombre" => "Gabriela Gomez Fernandez", "telefono" => "64929232", "direccion" => "Calle Seoane # 43"],
    ["usuario" => "jesus", "nombre" => "Jesus Quiroga Mendez", "telefono" => "66398410", "direccion" => "Av. Virgen de Cotoca 4to Anillo # 67"],
];

$pdf = new TCPDF();
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Listado de Usuarios', 0, 1, 'C');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(30, 10, 'Usuario', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(30, 10, 'Teléfono', 1, 0, 'C');
$pdf->Cell(90, 10, 'Dirección', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 10);

foreach ($usuarios as $usuario) {
    $pdf->Cell(30, 10, $usuario['usuario'], 1, 0, 'C');
    $pdf->Cell(40, 10, $usuario['nombre'], 1, 0, 'L');
    $pdf->Cell(30, 10, $usuario['telefono'], 1, 0, 'C');
    $pdf->Cell(90, 10, $usuario['direccion'], 1, 1, 'L');
}

$pdf->Output('listado_usuarios.pdf', 'I');
?>
