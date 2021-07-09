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
                    <h1>Actualizar expediente de investigación</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Actualizar expediente de investigación</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Datos del expediente</h3>
                </div>
                <?php
                require_once "./controladores/expedienteControlador.php";

                $ins_exp = new expedienteControlador();
                $datos_exp = $ins_exp->datos_expediente_controlador("Unico", $pagina[1]);
                if ($datos_exp->rowCount() == 1) {
                    $campos = $datos_exp->fetch();



                ?>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <p class="text-danger ">Campos obligatorios *</p>
                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="update" autocomplete="off">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="font-weight-bold text-uppercase">Datos del denunciante</h5>
                                    <hr>
                                </div>
                                <input type="hidden" class="form-control" name="exp_id_up" id="exp_id_up" value="<?php echo $pagina[1]; ?>">

                                <div class="col-sm-6" id="contenedor">
                                    <div class="form-group">
                                        <label>Nombre completo</label>
                                        <input type="text" class="form-control" style="text-transform:uppercase" name="nombre_d_up" id="nombre_d_up" value="<?php echo $campos['nombre_denunciante']; ?>">
                                    </div>

                                </div>

                                <div class="col-sm-6" id="contenedor2">
                                    <div class="form-group">
                                        <label>Identidad</label>
                                        <input type="text" class="form-control" name="identidad_d_up" id="identidad_d_up" value="<?php echo $campos['identidad_denunciante']; ?>">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Sexo <span class="text-danger">*</span></label>
                                        <select class="form-control" name="genero_up" id="genero_up" >
                                            <option value="">Seleccione sexo:</option>
                                            <?php
                                            require_once './modelos/conectar.php';
                                            $resultado = $conexion->query("SELECT * FROM tbl_genero");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['genero_id']; ?>" <?php if ($registro['genero_id'] == $campos['genero_id']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>><?php echo $registro['genero_descrip']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Departamento <span class="text-danger">*</span></label>

                                        <select class="form-control" name="depto_up" id="depto" >

                                            <option value="">Seleccione departamento</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_depto");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['depto_id']; ?>" <?php if ($registro['depto_id'] == $campos['depto_id']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>><?php echo $registro['depto_nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Municipio <span class="text-danger">*</span></label>
                                        <select class="form-control" name="municipio_up" id="municipio" >
                                            <option value="">Seleccione municipio</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_municipio");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['municipio_id']; ?>" <?php if ($registro['municipio_id'] == $campos['municipio_id']) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                            ?>><?php echo $registro['municipio_nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h5 class="font-weight-bold text-uppercase">Datos del expediente</h5>
                                    <hr>
                                </div>

                                <div class="col-sm-6">
                                    <label>N° de expediente<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">DPL-</span>
                                        </div>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000-00000" name="n_exp_up" id="n_exp_reg" value="<?php echo $campos['num_exp']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha conocimiento DIDADPOL<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" value="<?php echo $campos['fecha_inicio_exp']; ?>" name="fecha_inicio_exp_up" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha final expediente<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_final_exp_up" id="fecha_final_exp_up" value="<?php echo $campos['fecha_final_exp']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <label>Diligencias preliminares realizadas<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="diligencia_pre_up" id="diligencia_pre_up" style="text-transform:uppercase" cols="30" rows="10"><?php echo $campos['diligencia_pre']; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <label for="">Investigador</label>
                                        <select class="form-control" name="investigador_up" id="investigador_up" >
                                            <option value="">Seleccione investigador</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_usuario WHERE rol_id=2");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['usu_id']; ?>" <?php if ($registro['usu_id'] == $campos['investigador_id']) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                    ?>><?php echo $registro['usu_nombre'] . " " . $registro['usu_apellido']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha inicial de investigación<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_inicio_i_up" id="fecha_inicio_i_up" value="<?php echo $campos['fecha_inicio_i']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha finalizacion de expediente preliminar<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_final_i_pre_up" id="fecha_final_i_pre_up" value="<?php echo $campos['fecha_final_i_pre']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha finalizacion investigación<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_final_i_up" id="fecha_final_i_up" value="<?php echo $campos['fecha_final_i']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Diligencias investigativas realizadas<span class="text-danger">*</span></label>

                                        <textarea class="form-control" name="diligencias_invest_up" id="diligencias_invest_up" style="text-transform:uppercase" cols="30" rows="10"><?php echo $campos['diligencias_invest']; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Fecha remisión a secretaria<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_remision_up" id="fecha_remision_up" value="<?php echo $campos['fec_remision_secretaria']; ?>" readonly>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Técnico Legal</label>
                                        <select class="form-control" name="tec_legal_up" id="tec_legal_up" >
                                            <option value="">Seleccione técnico legal</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_usuario WHERE rol_id=3");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['usu_id']; ?>" <?php if ($registro['usu_id'] == $campos['tecnico_legal']) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                    ?>><?php echo $registro['usu_nombre'] . " " . $registro['usu_apellido']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha asignación técnico legal<span class="text-danger">*</label>

                                        <input type="date" autocomplete="off" class="form-control" name="fecha_asignacion_up" id="fecha_asignacion_up" value="<?php echo $campos['fec_asigna_legal']; ?>" readonly>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha audiencia de descargo<span class="text-danger">*</label>

                                        <input type="date" autocomplete="off" class="form-control" name="fecha_aud_desc_up" id="fecha_aud_desc_up" value="<?php echo $campos['fecha_aud_desc']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-6 text-center">
                                    <div class="col">
                                        <label for="text">Comparecio</label>

                                    </div>
                                    <div class="col">
                                        <div class="checkbox checkbox-primary pull-left p-t-0">
                                            <input id="checkbox-comparecio" type="checkbox" class="filled-in chk-col-light-blue" value="<?php echo $campos['comparecio']; ?>" >
                                            <label for="checkbox-comparecio"></label>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Diligencias legal realizadas<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="diligencias_legal_up" id="diligencias_legal_up" style="text-transform:uppercase" cols="30" rows="10"><?php echo $campos['diligencias_legal']; ?></textarea>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Finalización 3 días técnico legal<span class="text-danger">*</label>

                                        <input type="date" autocomplete="off" class="form-control" name="fecha_dias_tec_legal_up" id="fecha_dias_tec_legal_up" value="<?php echo $campos['fecha_dias_tec_legal']; ?>" readonly>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Seleccione resolución</label>
                                        <select class="form-control" name="resolucion_up" id="resolucion_up" >
                                            <option value="">Seleccione opcion</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_resoluciones");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['resolve_id']; ?>"><?php echo $registro['resolve']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6" id="contenedor">
                                    <div class="form-group">
                                        <label>N° Documento</label>

                                        <input type="text" class="form-control" style="text-transform:uppercase" name="num_resolve_up" id="num_resolve_up" value="<?php echo $campos['num_resolve']; ?>">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Recomendación</label>
                                        <select class="form-control" name="recomendacion_up" id="recomendacion_up" >
                                            <option value="">Seleccione recomendación</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_recomen");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['recomen_id']; ?>" <?php if ($registro['recomen_id'] == $campos['recomen_id']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>><?php echo $registro['recomen']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha devolución de expediente<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_devolucion_up" id="fecha_devolucion_up" value="<?php echo $campos['fec_devolucion']; ?>" readonly>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Folios</label>
                                        <input type="number" class="form-control" name="folios_up" id="folios_up" value="<?php echo $campos['folio']; ?>">
                                    </div>
                                </div>


                                <div class="col-6 text-center">
                                    <div class="col">
                                        <label for="text">Ministerio Público y/o Tribunal Supremo de Cuentas</label>
                                    </div>
                                    <div class="col">
                                        <div class="checkbox checkbox-primary pull-left p-t-0">

                                            <input id="checkbox-mp_tsc_up" type="checkbox" class="filled-in chk-col-light-blue" value="<?php echo $campos['remision_mp_tsc']; ?>" >

                                            <label for="checkbox-mp_tsc_up"></label>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Observación<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="observacion_up" id="observacion_up" style="text-transform:uppercase" cols="30" rows="10"><?php echo $campos['observacion']; ?></textarea>
                                    </div>
                                </div>

                                <!-- Datos Investigado -->
                                <div class="col-sm-12">
                                    <h5 class="font-weight-bold text-uppercase">Datos del investigado</h5>
                                    <hr>
                                </div>



                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""> Nombre completo del investigado <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" style="text-transform:uppercase" name="investigado_up" id="investigado" value="<?php echo $campos['nombre_investigado']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Rango</label>
                                        <select class="form-control" name="tecnico_l_id" id="tecnico_l_id" >
                                            <option value="">Seleccione rango</option>
                                            <?php
                                            require_once './modelos/conectar.php';
                                            $resultado = $conexion->query("SELECT * FROM tbl_rango");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['rango_id']; ?>" <?php if ($registro['rango_id'] == $campos['rango_id']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>><?php echo $registro['rango_descripcion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Tipo de falta</label>
                                        <select class="form-control" name="tipo_falta_up" id="lista_f" >
                                            <option value="">Seleccione tipo de falta</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_tipo_falta");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['tipo_falta_id']; ?>" <?php if ($registro['tipo_falta_id'] == $campos['tipo_falta_id']) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                            ?>><?php echo $registro['tipo_falta_descrip']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php
                                        $query = "SELECT * FROM tbl_exp_art WHERE exp_id=$campos[exp_id]";
                                        $resultado_articulos = $conexion->query($query);
                                        $articulos = $resultado_articulos->fetchAll(PDO::FETCH_ASSOC);
                                        $us_array = [];
                                        foreach ($articulos as $articulo) {
                                            $us_array[] = $articulo['art_id'];
                                        }
                                        ?>
                                        <label for="">Articulos <span class="text-danger">*</span></label>
                                        <select class="form-control lista_a" name="articulos_up[]" id="lista_a" multiple="multiple" style="width:100%;" >
                                            <?php
                                            $query2 = "SELECT * FROM tbl_articulo";
                                            $resultado_articulo = $conexion->prepare($query2);
                                            $resultado_articulo->execute();
                                            if ($resultado_articulo->rowCount() > 0) {
                                                foreach ($resultado_articulo as $a) {
                                            ?>
                                                    <option value="<?php echo $a['art_id'] ?>" <?php echo in_array($a['art_id'], $us_array) ? 'selected' : '' ?>>
                                                        <?php echo $a['n_art'] . ') ' . $a['art_descrip'] ?>
                                                    </option>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">No se encontro ningun dato</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label for="">Estado del proceso <span class="text-danger">*</span></label>
                                        <select class="form-control" name="estado_up" id="estado_up" >
                                            <option value="">Seleccione el estado del proceso</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_est_proceso");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['est_proceso_id']; ?>" <?php if ($registro['est_proceso_id'] == $campos['est_proceso_id']) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                            ?>><?php echo $registro['est_proceso_descrip']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="col text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Actualizar</button>
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                        </div>
                                    </div>
                                </div>
                        </form>
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

        $("#n_exp_reg").mask("0000-0000-000000");

    });
</script>