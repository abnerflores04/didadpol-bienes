<?php
if (!isset($_SESSION['id_spm'])) {
		echo $lc->forzar_cierre_sesion_controlador();
		exit();
}	
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registro de Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registro Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
           
                <!-- /.card-body -->
                <div class="card-body">
                <p class="text-danger ">Campos obligatorios *</p>
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombres <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="usu_nombres_reg" id="usu_nombres_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Apellidos<span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder=" " name="usu_apellidos_reg" id="usu_apellidos_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>DNI<span class="text-danger">*</label>
                                    <input type="text" autocomplete="off" class="form-control" placeholder="INGRESE DNI SIN GUIONES O ESPACIOS" name="usu_identidad_reg" id="usu_identidad_reg">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre de usuario <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:lowercase" class="form-control nombres" placeholder=" " name="usu_usuario_reg" id="usu_usuario_reg">
                                </div>
                            </div>
                          
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Rol <span class="text-danger">*</span></label>
                                    <select class="form-control" name="usu_rol_reg" id="usu_rol_reg">
                                        <option value="" selected="" >Seleccione rol:</option>
                                        <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_rol");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["rol_id"] . '">' . $registro["rol_nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Puesto <span class="text-danger">*</span></label>
                                    <select class="form-control" name="usu_puesto_reg" id="usu_puesto_reg">
                                        <option value="" selected="" >Seleccione puesto:</option>
                                        <?php
                                        
                                        $resultado = $conexion->query("SELECT * FROM tbl_puesto");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["puesto_id"] . '">' . $registro["puesto_nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>SECCIÓN <span class="text-danger">*</span></label>
                                    <select class="form-control" name="usu_seccion_reg" id="lista1">
                                        <option value="0" selected="" >Seleccione sección:</option>
                                        <?php
                                       
                                        $resultado = $conexion->query("SELECT * FROM tbl_seccion");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["seccion_id"] . '">' . $registro["seccion_nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                          
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>UNIDAD <span class="text-danger">*</span></label>
                                <select class="form-control" name="usu_unidad_reg" id="lista2">
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Correo pesonal <span class="text-danger">*</span></label>
                                    <input type="email" style="text-transform:lowercase" autocomplete="off" class="form-control correo" placeholder="" name="usu_correo_reg" id="usu_correo_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" autocomplete="off" class="form-control" placeholder="INGRESE CELULAR SIN GUIONES O ESPACIOS" name="usu_celular_reg" id="usu_celular_reg">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> CREAR</button>
                                        <a href="<?php echo SERVERURL.'lista-usuarios/'?>" class="btn btn bg-red" ><i class="fas fa-arrow-circle-left"></i> VOLVER ATRÁS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
    </section>

</div>
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://didadpol.gob.hn">DIDADPOL</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>
