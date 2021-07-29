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
                    <h1>Registro de procesos penales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Registro de procesos penales</li>
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
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/penalAjax.php" method="POST" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>N° de expediente interno<span class="text-danger">*</span></label>
                                <!-- /.card-body 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">DPL-</span>
                                    </div>
                                    -->
                                <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000-000" name="n_exp_i_reg" id="n_exp_i_reg">
                            </div>

                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombres Completo del procesado <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="nombre_c_reg" id="nombre_c_reg">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Delito(s)<span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="delitos_reg" id="delitos_reg">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Victima(s)<span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="victimas_reg" id="victimas_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fiscalia <span class="text-danger">*</span></label>
                                    <select class="form-control" name="fiscalia_reg" id="fiscalia_reg">
                                        <option value="" selected="">Seleccione fiscalia:</option>
                                        <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_fiscalia");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["fiscalia_id"] . '">' . $registro["descrip_fiscalia"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Juzgado/Tribunal <span class="text-danger">*</span></label>
                                    <select class="form-control lista_j" name="juzg_tribu_reg" id="juzg_tribu_reg"  style="width:100%;" required>
                                    <option value="" selected></option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_juzg_tribu");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["juzg_tribu_id"] . '">' . $registro["descrip_juzg_tribu"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Expediente Judicial<span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder=" " name="exp_j_reg" id="exp_j_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado laboral <span class="text-danger">*</span></label>
                                    <select class="form-control" name="est_lab_reg" id="est_lab_reg">
                                        <option value="" selected="">Seleccione estado laboral</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_est_lab");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["est_lab_id"] . '">' . $registro["descrip_est_l"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripcion de estado laboral<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="descrip_est_reg" id="descrip_est_reg" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de los hechos<span class="text-danger">*</span></label>
                                    <input type="date" autocomplete="off" class="form-control nombres" placeholder=" " name="fec_hechos_reg" id="fec_hechos_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha ultima actualización<span class="text-danger">*</span></label>
                                    <input type="date" autocomplete="off" class="form-control nombres" placeholder=" " name="fec_ult_act_reg" id="fec_ult_act_reg">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripción de la fecha actualización<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <textarea class="form-control" style="text-transform:uppercase" name="descrip_ult_act_reg" id="descrip_ult_act_reg" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Estado del proceso</label>
                                    <div class="form-group">
                                        <textarea class="form-control" style="text-transform:uppercase" name="est_proc_reg" id="est_proc_reg" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Oficio de solicitud de DIDADPOL<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">DIDADPOL D-</span>
                                    </div>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="000-0000" name="oficio_reg" id="oficio_reg">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Crear</button>
                                        <a href="<?php echo SERVERURL . 'lista-proc-penales/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
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
<script>
    $(function() {
        $("#n_exp_i_reg").mask("0000-0000-000");
        $("#oficio_reg").mask("000-0000");
        $('.lista_j').select2();
        $('.lista_j').select2({
            width: 'resolve',
            theme: 'bootstrap4',
            placeholder: "Seleccione Juzgado/Tribunal",
            allowClear: true

        });
    });
</script>