<?php
require_once('tcpdf/tcpdf.php');
require_once('reportesPDF/fpdf/fpdf.php');
include_once "funciones.php";

session_start();

$productos = isset($_SESSION['lista']) ? $_SESSION['lista'] : [];
$idUsuario = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;
$total = calcularTotalLista($productos);
$idCliente = isset($_SESSION['clienteVenta']) ? $_SESSION['clienteVenta'] : null;

//$idCliente = $_SESSION['clienteVenta'];
$resultado = registrarVenta($productos, $idUsuario, $idCliente, $total);

if (!$resultado) {
    echo "Error al registrar la venta";
    return;
}

$nombreUsuario = obtenerNombreUsuario($idUsuario);

$pdf = new TCPDF();
$nombreEmpresa = "Iténez";
$numeroCelular = "63461474";
$logoEmpresa = 'img/Logo4.png';

// Configura el PDF
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();

// Agrega contenido al PDF
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Recibo de Venta', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, 'Fecha: ' . date('Y-m-d H:i:s'), 0, 1, 'L');

$pdf->Cell(0, 10, 'Cliente: ' . ($idCliente ? obtenerNombreCliente($idCliente) : 'Mostrador'), 0, 1, 'L');
$pdf->Cell(0, 10, 'Atendido por: ' . (isset($nombreUsuario) ? $nombreUsuario : 'Anónimo'), 0, 1, 'R');

$pdf->SetY($pdf->GetY() - 10);
$pdf->Cell(0, 10, 'Empresa: ' . $nombreEmpresa, 0, 1, 'L'); 
$pdf->Cell(0, 10, 'Celular: ' . $numeroCelular, 0, 1, 'R'); 

$logoWidth = 30; 
$logoHeight = 20; 
$pdf->Image($logoEmpresa, 150, 15, $logoWidth, $logoHeight);

$pdf->Cell(0, 10, '', 0, 1); 

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(30, 10, 'Código', 1, 0, 'C');
$pdf->Cell(70, 10, 'Producto', 1, 0, 'C');
$pdf->Cell(30, 10, 'Precio', 1, 0, 'C');
$pdf->Cell(20, 10, 'Cantidad', 1, 0, 'C');
$pdf->Cell(40, 10, 'Subtotal', 1, 1, 'C');

foreach ($productos as $producto) {
    $pdf->Cell(30, 10, $producto->codigo, 1, 0, 'C');
    $pdf->Cell(70, 10, $producto->nombre, 1, 0, 'C');
    $pdf->Cell(30, 10, '$' . $producto->venta, 1, 0, 'C');
    $pdf->Cell(20, 10, $producto->cantidad, 1, 0, 'C');
    $pdf->Cell(40, 10, '$' . number_format($producto->cantidad * $producto->venta, 2), 1, 1, 'C');
}

$pdf->Cell(0, 10, '', 0, 1); 

$pdf->Ln(10);

        $pdf->setX(95);
        $pdf->Cell(40,6,'Total',1,0);
        $pdf->Cell(60,6,'$'.number_format($total, 2), 1, 0, 'R');
$pdf->Output();

$pdf->Output('recibo_ventas.pdf', 'I');

$_SESSION['lista'] = [];
$_SESSION['clienteVenta'] = "";

echo "<script type='text/javascript'>alert('Venta realizada con éxito');</script>";
echo "<script type='text/javascript'>window.location.href = 'vender.php';</script>";

?>
?>
