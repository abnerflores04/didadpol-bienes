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
                    <h1>Actualizar feriado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Actualizar feriado</li>
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
	require_once "./controladores/feriadosControlador.php";
	$ins_feriado = new feriadosControlador();
	$datos_feriado = $ins_feriado->datos_feriado_controlador("Unico", $pagina[1]);
	if ($datos_feriado->rowCount() == 1) {
		$campos = $datos_feriado->fetch();
	?>
                <!-- /.card-body -->
                <div class="card-body">
                <p class="text-danger ">Campos obligatorios *</p>
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/feriadosAjax.php" method="POST" data-form="update" autocomplete="off">
                        <div class="row">
                        <input type="hidden" class="form-control" name="id_feriado_up" id="id_feriado_up" value="<?php echo $pagina[1]; ?>">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha del feriado<span class="text-danger">*</span></label>
                                    <input type="date" autocomplete="off"  class="form-control"  name="fecha_feriado_up" id="fecha_feriado_up" value="<?php echo $campos['feriado_fecha']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Descripción del feriado <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="" name="descrip_feriado_up" id="descrip_feriado_up" value="<?php echo $campos['feriado_descrip']; ?>">
                                </div>
                            </div>
                            
                           

                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Actualizar</button>
                                        <a href="<?php echo SERVERURL.'lista-feriados/'?>" class="btn btn bg-red" ><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
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