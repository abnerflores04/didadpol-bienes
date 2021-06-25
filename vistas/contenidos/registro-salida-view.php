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
                    <h1>Solicitud de gira</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Registro salidas</li>
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
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/solicitudAjax.php" method="POST" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <p class="font-weight-bold ">Datos del solicitante<span class="text-danger">*</span></p>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">tipo de solicitud</label>
                                    <select class="form-control" name="tipo_solicitud_reg" id="tipo_solicitud_reg">
                                        <?php

                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_tipo_solicitud ");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["tipo_solicitud_id "] . '">' . $registro["tipo_solicitud_descripcion"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="font-weight-bold ">Período de realización del viaje<span class="text-danger">*</span></p>
                            </div>

                            <div class="col-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Fecha de salida </label>
                                    <input class="form-control" type="datetime-local" name="fecha_inicio_reg" id="fecha_inicio_reg">
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Fecha de retorno </label>
                                    <input class="form-control" type="datetime-local" name="fecha_final_reg" id="fecha_final_reg">
                                </div>
                            </div>
                           

                            

                            
                            
                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> CREAR</button>
                                        <a href="<?php echo SERVERURL . 'lista-giras/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> VOLVER ATRÁS</a>
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
