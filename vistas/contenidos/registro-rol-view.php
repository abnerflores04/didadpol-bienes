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
                    <h1>Registro de roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Registro roles</li>
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
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/rolAjax.php" method="POST" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre del rol <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="rol_nombre_reg" id="rol_nombre_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder=" " name="rol_descrip_reg" id="rol_descrip_reg">
                                </div>
                            </div>
                            

                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> CREAR</button>
                                        <a href="<?php echo SERVERURL.'lista-roles/'?>" class="btn btn bg-red" ><i class="fas fa-arrow-circle-left"></i> VOLVER ATRÁS</a>
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