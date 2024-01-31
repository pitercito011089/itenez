<?php
require_once('tcpdf/tcpdf.php');
include_once "funciones.php";

$productos = obtenerProductos();

$pdf = new TCPDF();
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Listado de Productos', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(20, 10, 'Código', 1, 0, 'C');
$pdf->Cell(70, 10, 'Nombre', 1, 0, 'C'); // Aumentado el ancho de la celda para el nombre
$pdf->Cell(25, 10, 'Precio compra', 1, 0, 'C');
$pdf->Cell(25, 10, 'Precio venta', 1, 0, 'C');
$pdf->Cell(25, 10, 'Ganancia', 1, 0, 'C');
$pdf->Cell(25, 10, 'Existencia', 1, 1, 'C');

foreach ($productos as $producto) {
    $pdf->Cell(20, 10, $producto->codigo, 1, 0, 'C');
    $pdf->Cell(70, 10, $producto->nombre, 1, 0, 'C'); // Aumentado el ancho de la celda para el nombre
    $pdf->Cell(25, 10, '$' . $producto->compra, 1, 0, 'C');
    $pdf->Cell(25, 10, '$' . $producto->venta, 1, 0, 'C');
    $pdf->Cell(25, 10, '$' . number_format($producto->venta - $producto->compra, 2), 1, 0, 'C');
    $pdf->Cell(25, 10, $producto->existencia, 1, 1, 'C');
}

$pdf->Output('listado_productos.pdf', 'I');
?>
?>