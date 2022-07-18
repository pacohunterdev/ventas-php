<?php
session_start();
if(empty($_SESSION['usuario'])) header("location: login.php");

include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
$idUsuario = $_SESSION['idUsuario'];
?>
<div class="container">
	<h1>Cambiar contraseña</h1>
	<form action="" method="post">
		<div class="mb-3">
            <label for="actual" class="form-label">Contraseña actual</label>
            <input type="password" name="actual" class="form-control" id="actual" placeholder="Escribe tu contraseña actual">
        </div>

        <div class="mb-3">
            <label for="nueva" class="form-label">Contraseña nueva</label>
            <input type="password" name="nueva" class="form-control" id="nueva" placeholder="Escribe tu contraseña nueva">
        </div>

        <div class="mb-3">
            <label for="repite" class="form-label">Repite la nueva contraseña</label>
            <input type="password" name="repite" class="form-control" id="repite" placeholder="Escribe la contraseña nueva de nuevo">
        </div>

        <div class="text-center">
        	<input type="submit" name="cambiar" class=" btn btn-primary btn-lg" value="Cambiar contraseña">
        	<a href="perfil.php" class="btn btn-danger btn-lg">
        		Cancelar
        	</a>
        </div>
	</form>
</div>
<?php
if(isset($_POST['cambiar'])){
	if(empty($_POST['actual']) || empty($_POST['nueva']) || empty($_POST['repite'])){
		echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
	}

	$actual = $_POST['actual'];
	$nueva = $_POST['nueva'];
	$repite = $_POST['repite'];

    if(strlen($nueva) < 8){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            La contraseña nueva debe tener al menos 8 caracteres.
        </div>';
        return;
    }

	if($nueva !== $repite) {
		echo'
        <div class="alert alert-danger mt-3" role="alert">
            La contraseña repetida debe coincidir con la nueva.
        </div>';
        return;
	}

	$passwordVerificada = verificarPassword($idUsuario, $actual);
	if(!$passwordVerificada){
		echo'
        <div class="alert alert-danger mt-3" role="alert">
            La contraseña actual es incorrecta.
        </div>';
        return;
	}

    $resultado = cambiarPassword($idUsuario, $repite);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Contraseña actualizada.
        </div>';
        return;
    }

    
}
?>