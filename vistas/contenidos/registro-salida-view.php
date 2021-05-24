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
                    <h1>Registro de salidas</h1>
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
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/salidaAjax.php" method="POST" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Motorista <span class="text-danger">*</span></label>
                                    <select class="form-control" name="motorista_sal_reg" id="motorista_sal_reg">
                                        <option value="" selected="">Seleccione motorista</option>
                                        <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_usuario WHERE rol_id=2");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["usu_id"] . '">' . $registro["usu_nombre"] . " " . $registro["usu_apellido"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Colaborador / Colaboradores <span class="text-danger">*</span></label>
                                    <select class="form-control colaboradores_sal_reg" multiple style="width: 100%;" id="colaboradores_sal_reg" name="colaboradores_sal_reg[]" data-placeholder="Seleccione Colaborador / Colaboradores">
                                    <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_usuario WHERE rol_id!=2");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["usu_id"] . '">' . $registro["usu_nombre"] . " " . $registro["usu_apellido"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo de salida <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tipo_sal_reg" id="tipo_sal_reg">
                                        <option value="" selected="">Seleccione tipo de salida</option>
                                        <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_tipo_salida");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["tipo_salida_id"] . '">' . $registro["tipo_salida_descripcion"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Fecha de salida <span class="text-danger">*</span></label>
                                    <input type="date" autocomplete="off" class="form-control apellidos" placeholder="" name="fecha_sal_reg" id="fecha_sal_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p class="font-weight-bold"> Observación <span class="text-danger">*</span></p>
                                    <textarea name="observacion_sal_reg" id="observacion_sal_reg" cols="57" style="text-transform:uppercase" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> CREAR</button>
                                        <a href="<?php echo SERVERURL . 'home/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> VOLVER ATRÁS</a>
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