<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>DIDADPOL </b>BIENES</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                

                <form action="" method="post">
             
                <p class="login-box-msg">Cambio de Contraseña</p>
                <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre de usuario" name="usuario_log">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" id="cambio_contra" name="clave_log">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <button id="show_password" class="btn btn-xs btn-primary" type="button" onclick="mostrarPassword_login()"><span class="fas fa-eye-slash icon"></span></button> 
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirmar Contraseña" id="conf_contra" name="clave_log">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <button id="show_password" class="btn btn-xs btn-primary" type="button" onclick="mostrarPassword_login()"><span class="fas fa-eye-slash icon3"></span></button> 
                            </div>
                        </div>
                    </div>
                    
                        
                        <!-- /.col -->
                        <div class="col-12 forgot">
                        <div style="float:center;margin:auto;width:195px;">
                            <button type="submit" class="btn btn-primary btn-block">Reestablecer Contraseña</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    
                </form>

                
<br>
                <p class="mb-1">
                    <a href="<?php echo SERVERURL;?>login/">Login</a>
                </p>
                
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->


</div>