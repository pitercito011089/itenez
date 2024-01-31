<?php
include_once "funciones.php";

if (isset($_GET['id'])) {
    $idVenta = $_GET['id'];

    // Eliminar venta por ID
    if (eliminarVenta($idVenta)) {
        header("Location: reporte_ventas.php");
        exit();
    } else {
        die("Error al intentar eliminar la venta.");
    }
} else {
    header("Location: reporte_ventas.php");
    exit();
}
?>
