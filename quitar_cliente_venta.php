<?php
session_start();
$_SESSION['clienteVenta'] = "";
header("location: vender.php");
?>