<?php
include_once "encabezado.php";

if(isset($_POST['ingresar'])){
    if(empty($_POST['usuario']) || empty($_POST['password'])){
        echo'
        <div class="alert alert-warning mt-3" role="alert">
            Debes completar todos los datos.
            <a href="login.php">Regresar</a>
        </div>';
        return;
    }

    include_once "funciones.php";

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    session_start();

    $datosSesion = iniciarSesion($usuario, $password);

    if(!$datosSesion){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Nombre de usuario y/o contraseña incorrectas.
            <a href="login.php">Regresar</a>
        </div>';
        return;
    }

    $_SESSION['usuario'] = $datosSesion->usuario;
    $_SESSION['idUsuario'] = $datosSesion->id;
    header("location: index.php");
}
?>