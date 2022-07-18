<?php
$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el producto';
    exit;
}
include_once "funciones.php";

$resultado = eliminarProducto($id);
if(!resultado){
    echo "Error al eliminar";
    return;
}

header("Location: productos.php");
?>