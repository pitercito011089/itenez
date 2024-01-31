<?php
include_once "funciones.php";
session_start();

if (empty($_SESSION['usuario'])) {
    header("location: login.php");
    exit();
}

if (isset($_POST['actualizarVenta'])) {
    $idVenta = $_POST['idVenta'];
    $idProducto = $_POST['idProducto'];
    $precioProducto = $_POST['precioProducto'];

    // Puedes realizar las validaciones necesarias antes de actualizar la venta
    // ...

    // Actualizar los detalles de la venta
    $actualizado = actualizarDetallesVenta($idVenta, $idProducto, $precioProducto);

    if ($actualizado) {
        // Redireccionar a la página de detalles de la venta o a donde lo necesites
        header("location: detalle_venta.php?id=" . $idVenta);
        exit();
    } else {
        // Manejar el caso en el que la actualización no fue exitosa
        echo "Error al actualizar la venta.";
    }
} else {
    // Manejar el caso en el que no se haya enviado el formulario
    echo "Acceso no autorizado.";
}
?>
