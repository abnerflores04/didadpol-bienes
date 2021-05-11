<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>DIDADPOL </b>BIENES</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            
                <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="res_contra" autocomplete="off">
                    
                    <p class="login-box-msg">Restablecer su contraseña</p>
                    <div class="alert alert-warning alert-dismissible fade show text-justify" role="alert">
                    Ingrese la dirección de correo electrónico personal de su cuenta de usuario y le enviaremos un enlace para restablecer la contraseña.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ingrese su correo electrónico" name="correo_res">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                   
                    <!-- /.col -->
                    <div class="col-12 forgot">
                        <div style="float:center;margin:auto;width:195px;">
                            <button type="submit" class="btn btn-primary btn-block">Enviar correo</button>
                        </div>
                    </div>
                    <!-- /.col -->
                    <br>
                <p class="mb-1">
                    <a href="<?php echo SERVERURL; ?>login/">Login</a>
                </p>

                </form>
                
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</div>