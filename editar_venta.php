<?php
include_once "funciones.php";
session_start();
if (empty($_SESSION['usuario'])) header("location: login.php");

// Obtener el ID de la venta a editar desde la URL
$idVenta = isset($_GET['id']) ? $_GET['id'] : null;

// Obtener los detalles de la venta a partir del ID
$venta = obtenerDetallesVenta($idVenta);

// Obtener lista de productos para el desplegable
$productos = obtenerProductos();

// Obtener lista de clientes para el desplegable
$clientes = obtenerClientes();

?>

<div class="container">
    <h2>Editar Venta #<?= $venta->id ?></h2>

    <form id="editarVentaForm" action="actualizar_venta.php" method="post">
        <!-- Campos del formulario para la edición de detalles de la venta -->
        <input type="hidden" name="idVenta" value="<?= $venta->id ?>">
        
        <div class="mb-3">
            <label for="productoSelect" class="form-label">Producto</label>
            <select class="form-select" id="productoSelect" name="idProducto">
                <?php foreach ($productos as $producto) { ?>
                    <option value="<?= $producto->id ?>" data-precio="<?= $producto->venta ?>">
                        <?= $producto->nombre ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="precioProducto" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precioProducto" name="precioProducto" readonly>
        </div>

        <!-- Desplegable para seleccionar cliente -->
        <div class="mb-3">
            <label for="idCliente" class="form-label">Cliente</label>
            <select class="form-select" id="idCliente" name="idCliente">
                <?php foreach ($clientes as $cliente) { ?>
                    <option value="<?= $cliente->id ?>" <?= ($cliente->id == $venta->idCliente) ? 'selected' : '' ?>>
                        <?= $cliente->nombre ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Campos adicionales para la edición -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="<?= date('Y-m-d\TH:i', strtotime($venta->fecha)) ?>">
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" class="form-control" id="total" name="total" value="<?= $venta->total ?>">
        </div>

        <!-- Resto de los campos para editar -->
        <input type="submit" name="actualizarVenta" value="Actualizar Venta" class="btn btn-primary">
    </form>
</div>

<script>
    // Script para manejar cambios en el formulario
    document.addEventListener('DOMContentLoaded', function () {
        var productoSelect = document.getElementById('productoSelect');
        var precioProducto = document.getElementById('precioProducto');

        // Evento al cambiar la selección de producto
        productoSelect.addEventListener('change', function () {
            // Obtener el precio del producto seleccionado
            var precioSeleccionado = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio');
            
            // Actualizar el campo de precio
            precioProducto.value = precioSeleccionado;
        });
    });
</script>
