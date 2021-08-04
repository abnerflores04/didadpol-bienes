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
                    <h1>Información completa proceso penal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Información completa proceso penal</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <?php
	require_once "./controladores/penalControlador.php";
	$ins_penal = new penalControlador();
	$datos_proc_penal = $ins_penal->datos_proc_penal_controlador("Unico", $pagina[1]);
	if ($datos_proc_penal->rowCount() == 1) {
		$campos = $datos_proc_penal->fetch();
	?>
            <div class="card card-info card-outline">
                <!-- /.card-body -->
                <div class="card-body">
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/penalAjax.php" method="POST" data-form="update" autocomplete="off">
                        <div class="row">
                        <input type="hidden" name="proc_penal_id_up" value="<?php echo $pagina[1];?>">
                        <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombres Completo del procesado </label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="nombre_c_up" id="nombre_c_up" value="<?php echo $campos['nombre_investigado']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>N° de expediente interno</label>
                                <!-- /.card-body 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">DPL-</span>
                                    </div>
                                    -->
                                <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000-000" name="n_exp_i_up" id="n_exp_i_up" value="<?php echo $campos['n_exp_interno']; ?>" readonly>
                            </div>

                           

                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Delito(s)</label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="delitos_up" id="delitos_up" value="<?php echo $campos['delitos']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Victima(s)</label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="victimas_up" id="victimas_up" value="<?php echo $campos['victimas']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fiscalia </label>
                                    <select class="form-control" name="fiscalia_up" id="fiscalia_up" disabled>
                                    <option value="">Seleccione fiscalia:</option>
                                        <?php
                                         require_once './modelos/conectar.php';
                                         $resultado = $conexion->query("SELECT * FROM tbl_fiscalia");
                                         while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                         ?>
                                         <option value="<?php echo $registro['fiscalia_id']; ?>" 
                                         <?php if($registro['fiscalia_id']==$campos['fiscalia_id']) {
                                         echo 'selected'; } 
                                         ?>
                                         ><?php echo $registro['descrip_fiscalia']; ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Juzgado/Tribunal </label>
                                    <select class="form-control lista_j" name="juzg_tribu_up" id="juzg_tribu_up"  style="width:100%;" disabled>
                                    <option value="" selected></option>
                                    <option value="">Seleccione Juzgado/Tribunal:</option>
                                        <?php
                                         $resultado = $conexion->query("SELECT * FROM tbl_juzg_tribu");
                                         while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                         ?>
                                         <option value="<?php echo $registro['juzg_tribu_id']; ?>" 
                                         <?php if($registro['juzg_tribu_id']==$campos['juzg_tribu_id']) {
                                         echo 'selected'; } 
                                         ?>
                                         ><?php echo $registro['descrip_juzg_tribu']; ?></option>
                                         <?php } ?>
                                    </select>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Expediente Judicial</label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder=" " name="exp_j_up" id="exp_j_up" value="<?php echo $campos['exp_judicial']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado laboral</label>
                                    <select class="form-control" name="est_lab_up" id="est_lab_up" disabled>
                                        <option value="" >Seleccione estado laboral</option>
                                        <?php
                                         $resultado = $conexion->query("SELECT * FROM tbl_est_lab");
                                         while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                         ?>
                                         <option value="<?php echo $registro['est_lab_id']; ?>" 
                                         <?php if($registro['est_lab_id']==$campos['est_lab_id']) {
                                         echo 'selected'; } 
                                         ?>
                                         ><?php echo $registro['descrip_est_l']; ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripcion de estado laboral</label>
                                    <textarea class="form-control" name="descrip_est_up" id="descrip_est_up" cols="30" rows="5" readonly><?php echo $campos['descrip_est_lab']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de los hechos</label>
                                    <input type="date" autocomplete="off" class="form-control nombres" placeholder=" " name="fec_hechos_up" id="fec_hechos_up" value="<?php echo $campos['fec_hechos']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha ultima actualización</label>
                                    <input type="date" autocomplete="off" class="form-control nombres" placeholder=" " name="fec_ult_act_up" id="fec_ult_act_up" value="<?php echo $campos['fec_ultima_act']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripción de la fecha actualización</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="descrip_ult_act_up" id="descrip_ult_act_up" cols="30" rows="5" readonly><?php echo $campos['descrip_ultima_act']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Estado del proceso</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="est_proc_up" id="est_proc_up" cols="30" rows="5" readonly><?php echo $campos['est_proceso']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Oficio de solicitud de DIDADPOL</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">DIDADPOL D-</span>
                                    </div>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="000-0000" name="oficio_up" id="oficio_up" value="<?php echo $campos['oficio_solicitud']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <a href="<?php echo SERVERURL.'lista-proc-penales/'?>" class="btn btn bg-red" ><i class="fa fa-times-circle-o" aria-hidden="true"></i> CANCELAR</a>
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
<script>
    $(function() {
        $("#n_exp_i_up").mask("0000-0000-000");
        $("#oficio_up").mask("000-0000");
        $('.lista_j').select2();
        $('.lista_j').select2({
            width: 'resolve',
            theme: 'bootstrap4',
            placeholder: "Seleccione Juzgado/Tribunal",
            allowClear: true

        });
    });
</script>