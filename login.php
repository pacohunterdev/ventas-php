<?php
include_once "encabezado.php";
?>
<div class="container">
    <div class="row m-5 no-gutters shadow-lg">
        <div class="col-md-6 d-none d-md-block">
            <img src="logo_principal.png" class="img-fluid" style="min-height:100%;" />
        </div>
        <div class="col-md-6 bg-white p-5">
            <h3 class="pb-3">Iniciar sesión</h3>
            <div>
                <form action="iniciar_sesion.php" method="post">
                    <div class="form-group pb-3">
                        <input type="text" placeholder="Usuario" class="form-control" name="usuario" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group pb-3">
                        <input type="password" placeholder="Contraseña" class="form-control" name="password" id="exampleInputPassword1">
                    </div>

                    <div class="pb-2">
                        <button type="submit" name="ingresar" class="btn btn-primary w-100 font-weight-bold mt-2">Ingresar</button>
                    </div>
                </form>
             </div>
        </div>
    </div>
</div>
