<?php

session_start();
if(empty($_SESSION['usuario'])) header("location: login.php");
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
$nombreUsuario = $_SESSION['usuario'];
$idUsuario = $_SESSION['idUsuario'];

$cartas = [
    ["titulo" => "Total ventas", "icono" => "fa fa-money-bill", "total" => "$".obtenerTotalVentas($idUsuario), "color" => "#F11337"],
    ["titulo" => "Ventas hoy", "icono" => "fa fa-calendar-day", "total" => "$".obtenerTotalVentasHoy($idUsuario), "color" => "#133CF1"],
    ["titulo" => "Ventas semana", "icono" => "fa fa-calendar-week", "total" => "$".obtenerTotalVentasSemana($idUsuario), "color" => "#4A64D5"],
    ["titulo" => "Ventas mes", "icono" => "fa fa-calendar-alt", "total" => "$".obtenerTotalVentasMes($idUsuario), "color" => "#6985FF"],
];
?>

<div class="container">
	<div class="alert alert-primary text-center shadow-sm rounded" role="alert">
		<h1>
		<h1><?= $nombreUsuario?></h1>
		</h1>
	</div>
	
	<?php include_once "cartas_totales.php"?>
	<div class="text-center mt-3">
		<a href="cambiar_password.php" class="btn btn-lg btn-primary">
			<i class="fa fa-key"></i>
			Cambiar contraseña
		</a>
	</div>
</div>