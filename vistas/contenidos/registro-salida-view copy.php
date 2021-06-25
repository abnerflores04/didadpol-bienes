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
                                    <label for="">Departamento solicitante</label>
                                    <select class="form-control" name="seccion" id="seccion">
                                        <?php

                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_seccion");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["seccion_id"] . '">' . $registro["seccion_nombre"] . '</option>';
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
                            <div class="col-12">

                                <p class="font-weight-bold ">Insumos a solicitar <span class="text-danger">*</span></p>
                            </div>

                            <div class="col-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <?php

                                    require_once './modelos/conectar.php';
                                    $resultado = $conexion->query("SELECT * FROM tbl_insumo");
                                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<label>
                                        <input type="checkbox" name="insumo[]" id="insumo" value="' . $registro["insumo_id"] . '">   ' . ucfirst(strtolower($registro["insumo_descripcion"])) . '
                                         </label><br>';
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="col-12">
                                <p class="font-weight-bold ">Lugar a visitar <span class="text-danger">*</span></p>
                            </div>
                            <table class="table table-bordered" id="lugar">

                                <tr>
                                    <td><input type="checkbox" name="item_index[]"></td>
                                    <td width="25%">
                                        <label for="">Municipio/Departamento</label>
                                        <select class="form-control municipio" name="municipio[]">
                                            <option value="" selected>Seleccione lugar:</option>
                                            <?php

                                            require_once './modelos/conectar.php';
                                            $resultado = $conexion->query("SELECT * FROM tbl_municipio tm INNER JOIN tbl_depto td ON td.depto_id=tm.depto_id");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $registro["municipio_id"] . '">' . $registro["municipio_nombre"]   . ', ' . $registro["depto_nombre"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><label for="">Noches</label><input type="text" class="form-control" WID></td>
                                </tr>
                            </table>
                            <div class="table-responsive" id="lugar">

                                <?php require_once("e.php") ?>

                            </div>
                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <input class="btn btn-success" type="button" name="agregar_registros" value="Agregar" onClick="AgregarMas();" />
                                        <input class="btn btn-danger" type="button" name="borrar_registros" value="Borrar" onClick="BorrarRegistro();" />
                                    </div>
                                </div>
                            </div>




                            <div class="col-12">
                                <div class="form-group">
                                    <label>Información de Viajeros <span class="text-danger">*</span></label>
                                    <select class="form-control colaboradores_sal_reg" multiple style="width: 100%;" id="viajeros_sal_reg" name="viajeros_sal_reg[]" data-placeholder="Seleccione viajero / viajeros">
                                        <?php

                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_usuario WHERE puesto_id!=26 and usu_id!=1");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["usu_id"] . '">' . $registro["usu_nombre"] . " " . $registro["usu_apellido"] . '</option>';
                                        }
                                        ?>
                                    </select>
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
<script>
    function AgregarMas() {
        $("<div>").load("e.php", function() {
            $("#lugar").append($(this).html());
        });
    }

    function BorrarRegistro() {
        $('div.lista-lugar').each(function(index, item) {
            jQuery(':checkbox', this).each(function() {
                if ($(this).is(':checked')) {
                    $(item).remove();
                }
            });
        });
    }
    $(function() {
        $('.departamento').select2();
        $('.departamento').select2({
            theme: 'bootstrap4'
        });
        $('.municipio').select2();
        $('.municipio').select2({
            theme: 'bootstrap4'
        });
    });
</script>