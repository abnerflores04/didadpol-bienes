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
                    <h1>Actualizar rol</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Actualizar rol</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning card-outline">
            <?php
	require_once "./controladores/rolControlador.php";
	$ins_rol = new rolControlador();
	$datos_rol = $ins_rol->datos_rol_controlador("Unico", $pagina[1]);
	if ($datos_rol->rowCount() == 1) {
		$campos = $datos_rol->fetch();
	?>
                <!-- /.card-body -->
                <div class="card-body">
                <p class="text-danger ">Campos obligatorios *</p>
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/rolAjax.php" method="POST" data-form="update" autocomplete="off">
                        <div class="row">
                        <input type="hidden" name="rol_id_up" value="<?php echo $pagina[1]; ?>">
                        <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre del rol <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="rol_nombre_up" id="rol_nombre_up" value="<?php echo $campos['rol_nombre']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder=" " name="rol_descrip_up" id="rol_descrip_up" value="<?php echo $campos['rol_descripcion']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> ACTUALIZAR</button>
                                        <a href="<?php echo SERVERURL.'lista-roles/'?>" class="btn btn bg-red" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> CANCELAR</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
        <?php } else {  ?>

<div class="alert alert-danger text-center" role="alert">
    <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
    <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
    <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
</div>
<?php } ?>
    </section>

</div>
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://didadpol.gob.hn">DIDADPOL</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>