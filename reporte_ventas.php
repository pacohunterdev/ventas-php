<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();
if(empty($_SESSION['usuario'])) header("location: login.php");

if(isset($_POST['buscar'])){
    if(empty($_POST['inicio']) || empty($_POST['fin'])) header("location: reporte_ventas.php");
}

if(isset($_POST['buscarPorUsuario'])){
    if(empty($_POST['idUsuario'])) header("location: reporte_ventas.php");
}

if(isset($_POST['buscarPorCliente'])){
    if(empty($_POST['idCliente'])) header("location: reporte_ventas.php");
}

$fechaInicio = (isset($_POST['inicio'])) ? $_POST['inicio'] : null;
$fechaFin = (isset($_POST['fin'])) ? $_POST['fin'] : null;
$usuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : null;
$cliente = (isset($_POST['idCliente'])) ? $_POST['idCliente'] : null;

$ventas = obtenerVentas($fechaInicio, $fechaFin, $cliente, $usuario);

$cartas = [
    ["titulo" => "No. ventas", "icono" => "fa fa-shopping-cart", "total" => count($ventas), "color" => "#A71D45"],
    ["titulo" => "Total ventas", "icono" => "fa fa-money-bill", "total" => "$".calcularTotalVentas($ventas), "color" => "#2A8D22"],
    ["titulo" => "Productos vendidos", "icono" => "fa fa-box", "total" =>calcularProductosVendidos($ventas), "color" => "#223D8D"],
    ["titulo" => "Ganancia", "icono" => "fa fa-wallet", "total" => "$". obtenerGananciaVentas($ventas), "color" => "#D55929"],
];

$clientes = obtenerClientes();
$usuarios = obtenerUsuarios();
?>
<div class="container">
    <h2>Reporte de ventas : 
        <?php 
        if(empty($fechaInicio)) echo HOY;
        if(isset($fechaInicio) && isset($fechaFin)) echo $fechaInicio ." al ". $fechaFin;
        ?>
    </h2>
    <form class="row mb-3" method="post">
        <div class="col-5">
            <label for="inicio" class="form-label">Fecha busqueda inicial</label>
            <input type="date" name="inicio" class="form-control" id="inicio" >
        </div>
        <div class="col-5">
            <label for="fin" class="form-label">Fecha busqueda final</label>
            <input type="date" name="fin" class="form-control" id="fin" >
        </div>
        <div class="col">
            <input type="submit" name="buscar" value="Buscar" class="btn btn-primary mt-4">
        </div>
    </form>
    <div class="row mb-2">
        <div class="col">
            <form action="" method="post" class="row">
                <div class="col-6">
                <select class="form-select" aria-label="Default select example" name="idUsuario">
                    <option selected value="">Selecciona un usuario</option>
                    <?php foreach($usuarios as $usuario) {?>
                    <option value="<?= $usuario->id?>"><?= $usuario->usuario?></option>
                    <?php }?>
                </select>
                </div>
                <div class="col-1">
                    <input type="submit" name="buscarPorUsuario" value="Buscar por usuario" class="btn btn-secondary">
                </div>
            </form>
        </div>
        <div class="col">
            <form action="" method="post" class="row">
                <div class="col-6">
                <select class="form-select" aria-label="Default select example" name="idCliente">
                    <option selected value="">Selecciona un cliente</option>
                    <?php foreach($clientes as $cliente) {?>
                    <option value="<?= $cliente->id?>"><?= $cliente->nombre?></option>
                    <?php }?>
                </select>
                </div>
                <div class="col-1">
                    <input type="submit" name="buscarPorCliente" value="Buscar por cliente" class="btn btn-secondary">
                </div>
            </form>
        </div>

    </div>
    <?php include_once "cartas_totales.php"?>
    <?php if(count($ventas) > 0){?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Usuario</th>
                <th>Productos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ventas as $venta) {?>
                <tr>
                    <td><?= $venta->id;?></td>
                    <td><?= $venta->fecha;?></td>
                    <td><?= $venta->cliente;?></td>
                    <td>$<?= $venta->total;?></td>
                    <td><?= $venta->usuario;?></td>
                    <td>
                        <table class="table">
                            <?php foreach($venta->productos as $producto) {?>
                                <tr>
                                    <td><?= $producto->nombre;?></td>
                                    <td><?= $producto->cantidad;?></td>
                                    <td> X </td>
                                    <td>$<?=  $producto->precio ;?></td>
                                    <th>$<?= $producto->cantidad * $producto->precio ;?></th>
                                </tr>
                                <?php }?>
                        </table>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
    <?php }?>
    <?php if(count($ventas) < 1){?>
        <div class="alert alert-warning mt-3" role="alert">
            <h1>No se han encontrado ventas</h1>
        </div>
    <?php }?>
</div>