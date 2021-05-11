<?php
session_start();
if (!isset( $_SESSION['token_spm']) || !isset( $_SESSION['usuario_spm']) || !isset( $_SESSION['id_spm'])) {
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}else {
    require_once "./controladores/loginControlador.php";
    $lc = new loginControlador();
}
?>
<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>DIDADPOL </b>BIENES</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update_c" autocomplete="off">
                
                    <p class="login-box-msg">Cambio de Contraseña</p>
                    <div class="alert alert-warning alert-dismissible fade show text-justify" role="alert">
                        La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial de estos $@$!%*?.#-_+ con mínimo de 8 y un máximo de 20 caracteres.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" class="form-control" name="id_c" value="<?php echo $lc->encryption($_SESSION['id_spm']);?>">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" id="contra" name="clave_c">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <button  class="btn btn-xs btn-primary" type="button" onclick="mostrarPassword_login()"><span class="fas fa-eye-slash mostrar"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirmar Contraseña" id="conf_contra" name="conf_clave_c">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <button  class="btn btn-xs btn-primary" type="button" onclick="mostrarConfPassword_login()"><span class="fas fa-eye-slash confmostrar"></span></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 forgot">
                        <div style="float:center;margin:auto;width:195px;">
                            <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </form>
                <br>
                <p class="mb-1">
                    <a href="<?php echo SERVERURL; ?>login/">Login</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->


</div>