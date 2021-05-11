<?php
if (isset($_POST['usuario_log']) || isset($_POST['usuario_log'])) {
    require_once "./controladores/loginControlador.php";
    $ins_login = new loginControlador();
    echo $ins_login->iniciar_sesion_controlador();
}
?>
<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>DIDADPOL </b>BIENES</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <form action="" method="POST">
                    <div class="col-sm-12">
                        <div class="col text-center">
                            <img src=" <?php echo SERVERURL . '/vistas/dist/img/User_icono2.png'; ?>" width="100" height="100" />
                        </div>
                    </div>
                    <p class="login-box-msg">Inicia sesión</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" style="text-transform:lowercase" placeholder="Nombre de usuario" name="usuario_log">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" id="contra" name="clave_log">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <button id="show_password" class="btn btn-xs btn-primary" type="button" onclick="mostrarPassword_login()"><span class="fas fa-eye-slash mostrar"></span></button> 
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 forgot">
                        <div style="float:center;margin:auto;width:195px;">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                    </div>
                    <!-- /.col -->

                </form>
                <br>
                <p class="mb-1">
                    <a href="<?php echo SERVERURL;?>restablecer-contraseña-correo/">Olvidé mi contraseña</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</div>