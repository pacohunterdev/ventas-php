<?php
session_start();
$cliente = $_POST['idCliente'];
$_SESSION['clienteVenta'] = $cliente;
header("location: vender.php");
?>