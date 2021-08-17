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
                    <h1>Ver información del expediente</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/didadpol-bienes/home/">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver información del expediente</li>
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

                        <div class="row">
                            <div class="col">
                                <p class="text-danger ">Campos obligatorios *</p>
                            </div>

                        </div>

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
                                        <input type="text" class="form-control" style="text-transform:uppercase" name="nombre_d_up" id="nombre_d_up" value="<?php echo $campos['nom_d']; ?>" readonly>
                                    </div>

                                </div>

                                <div class="col-sm-6" id="contenedor2">
                                    <div class="form-group">
                                        <label>Identidad</label>
                                        <input type="text" class="form-control" name="identidad_d_up" id="identidad_d_up" value="<?php echo $campos['id_d']; ?>" readonly>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Sexo <span class="text-danger">*</span></label>
                                        <select class="form-control" name="genero_up" id="genero_up" disabled>
                                            <option value="">Seleccione sexo:</option>
                                            <?php
                                            require_once './modelos/conectar.php';
                                            $resultado = $conexion->query("SELECT * FROM tbl_sexos");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['sexo_id']; ?>" <?php if ($registro['sexo_id'] == $campos['sex_d']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>><?php echo $registro['descripcion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Departamento <span class="text-danger">*</span></label>

                                        <select class="form-control" name="depto_up" id="depto" disabled>

                                            <option value="">Seleccione departamento</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_deptos d LEFT JOIN tbl_municipios m ON d.depto_id = m.depto_id");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['tbl_deptos.depto_id']; ?>" <?php if ($registro['municipio_id'] == $campos['mun_d']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>><?php echo $registro['tbl_deptos.nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Municipio <span class="text-danger">*</span></label>
                                        <select class="form-control" name="municipio_up" id="municipio" disabled>
                                            <option value="">Seleccione municipio</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_municipios");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['municipio_id']; ?>" <?php if ($registro['municipio_id'] == $campos['mun_d']) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                            ?>><?php echo $registro['nombre']; ?></option>
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
                                    <label>Tipo de caso<span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="Tipo de caso" name="tipo_caso_up" id="tipo_casoreg" value="<?php echo $campos['tipo_exp']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha conocimiento DIDADPOL<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" value="<?php echo $campos['fec_inicio_exp']; ?>" name="fecha_inicio_exp_up" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fecha final expediente<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_final_exp_up" id="fecha_final_exp_up" value="<?php echo $campos['fec_final_exp']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <label>Diligencias preliminares realizadas<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="diligencia_pre_up" id="diligencia_pre_up" style="text-transform:uppercase" cols="30" rows="10" readonly><?php echo $campos['diligencia_pre']; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <label for="">Investigador</label>
                                        <select class="form-control" name="investigador_up" id="investigador_up" disabled>
                                            <option value="">Seleccione investigador</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_usuarios WHERE rol_id=2");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['usuario_id']; ?>" <?php if ($registro['usuario_id'] == $campos['investigador_id']) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                    ?>><?php echo $registro['nombre'] . " " . $registro['apellido']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha inicial de investigación<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_inicio_i_up" id="fecha_inicio_i_up" value="<?php echo $campos['fec_inicio_invest']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha finalizacion de expediente preliminar<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_final_i_pre_up" id="fecha_final_i_pre_up" value="<?php echo $campos['fec_final_invest_pre']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha finalizacion investigación<span class="text-danger">*</label>
                                        <input type="date" autocomplete="off" class="form-control" name="fecha_final_i_up" id="fecha_final_i_up" value="<?php echo $campos['fec_final_invest']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Diligencias investigativas realizadas<span class="text-danger">*</span></label>

                                        <textarea class="form-control" name="diligencias_invest_up" id="diligencias_invest_up" style="text-transform:uppercase" cols="30" rows="10" readonly><?php echo $campos['diligencias_invest']; ?></textarea>
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
                                        <select class="form-control" name="tec_legal_up" id="tec_legal_up" disabled>
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

                                        <input type="date" autocomplete="off" class="form-control" name="fecha_aud_desc_up" id="fecha_aud_desc_up" readonly value="<?php echo $campos['fecha_aud_desc']; ?>">
                                    </div>
                                </div>

                                <div class="col-6 text-center">
                                    <div class="col">
                                        <label for="text">Comparecio</label>

                                    </div>
                                    <div class="col">
                                        <div class="checkbox checkbox-primary pull-left p-t-0">
                                            <label for="si">Si</label>
                                            <input type="radio" name="comparecio_up" id="si" value="1" <?php if ($campos['comparecio'] == 1) {
                                                                                                            echo 'checked';
                                                                                                        } ?> disabled>
                                            <label for="no">No</label>
                                            <input type="radio" name="comparecio_up" id="no" value="0" <?php if ($campos['comparecio'] == 0) {
                                                                                                            echo 'checked';
                                                                                                        } ?> disabled>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Diligencias legal realizadas<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="diligencias_legal_up" id="diligencias_legal_up" style="text-transform:uppercase" cols="30" rows="10" readonly><?php echo $campos['diligencias_legal']; ?></textarea>
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
                                        <select class="form-control" name="resolucion_up" id="resolucion_up" disabled>
                                            <option value="">Seleccione opcion</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_resoluciones");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>

                                                <option value="<?php echo $registro['resolve_id']; ?>" <?php if ($registro['resolve_id'] == $campos['resolve_id']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>><?php echo $registro['resolve']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6" id="contenedor">
                                    <div class="form-group">
                                        <label>N° Documento</label>

                                        <input type="text" class="form-control" style="text-transform:uppercase" name="num_resolve_up" id="num_resolve_up" value="<?php echo $campos['num_resolve']; ?>" readonly>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Recomendación</label>
                                        <select class="form-control" name="recomendacion_up" id="recomendacion_up" disabled>
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
                                        <input type="number" class="form-control" name="folios_up" id="folios_up" value="<?php echo $campos['folio']; ?>" readonly>
                                    </div>
                                </div>


                                <div class="col-6 text-center">
                                    <div class="col">
                                        <label for="text">Ministerio Público y/o Tribunal Supremo de Cuentas</label>
                                    </div>
                                    <div class="col">
                                        <div class="checkbox checkbox-primary pull-left p-t-0">
                                            <label for="si">Si</label>
                                            <input type="radio" name="remi_mp_tsc_up" id="si" value="1" <?php if ($campos['remision_mp_tsc'] == 1) {
                                                                                                            echo 'checked';
                                                                                                        } ?> disabled>
                                            <label for="no">No</label>
                                            <input type="radio" name="remi_mp_tsc_up" id="no" value="0" <?php if ($campos['remision_mp_tsc'] == 0) {
                                                                                                            echo 'checked';
                                                                                                        } ?> disabled>


                                            <label for="checkbox-mp_tsc_up"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Observación<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="observacion_up" id="observacion_up" style="text-transform:uppercase" cols="30" rows="10" readonly><?php echo $campos['observacion']; ?></textarea>
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
                                        <input type="text" class="form-control" style="text-transform:uppercase" name="investigado_up" id="investigado" value="<?php echo $campos['nombre_investigado']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Rango</label>
                                        <select class="form-control" name="tecnico_l_id" id="tecnico_l_id" disabled>
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
                                        <select class="form-control" name="tipo_falta_up" id="lista_f" disabled>
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
                                        <select class="form-control lista_a" name="articulos_up[]" id="lista_a" multiple="multiple" style="width:100%;" disabled>
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
                                        <select class="form-control" name="estado_up" id="estado_up" disabled>
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
                        </form>
                        <div class="col-sm-12 mt-5">
                            <div class="row text-center">
                                <?php if (($campos['proceso_id'] > 2 && $campos['proceso_id'] < 5) || ($campos['proceso_id'] > 7 && $campos['proceso_id'] < 9)) { ?>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModaldiligenciaPre">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar diligencia preliminar
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModaldiligenciaInv">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar diligencia investigación
                                        </button>
                                    </div>
                                <?php } ?>
                                <?php if ($campos['proceso_id'] > 9 && $campos['proceso_id'] < 20) { ?>
                                    <?php if ($campos['proceso_id'] > 10 && $campos['proceso_id'] < 13) { ?>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModaldiligenciaCita">
                                                <i class="fa fa-plus" aria-hidden="true"></i> Agregar diligencia citación
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <?php if ($campos['proceso_id'] > 13 && $campos['proceso_id'] < 18) { ?>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModaldiligenciaLeg">
                                                <i class="fa fa-plus" aria-hidden="true"></i> Agregar diligencia legal
                                            </button>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <hr>
                        </div>

                        <?php if ($campos['proceso_id'] > 2 && $campos['proceso_id'] < 14) { ?>
                            <div class="col-sm-12 mt-5 text-center">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalInterrupcion">
                                    Interrupción
                                </button>
                            </div>
                        <?php } ?>

                        <div class="col-sm-12 mt-5">
                            <div class="col text-center">

                                <!-- Boton emitir -->
                                <?php if ($campos['proceso_id'] == 1 && $_SESSION['rol_id'] == 6) { ?>
                                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="bit_id" id="bit_id" value="<?php echo $campos['bitacora_id']; ?>">
                                            <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                            <input type="hidden" name="fec_emision" id="fec_emision" value="<?php echo date('Y-m-d H:i:s'); ?>">

                                            <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Emitir expediente</button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    </form>
                                <?php } ?>
                                <!-- /Boton emitir -->
                                <!-- Boton admitir -->
                                <?php if ($campos['proceso_id'] == 2 &&  $_SESSION['rol_id'] == 4) { ?>
                                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="bit_id_3" id="bit_id_3" value="<?php echo $campos['bitacora_id']; ?>">
                                            <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                            <input type="hidden" name="fec_admitir" id="fec_admitir" value="<?php echo date('Y-m-d H:i:s'); ?>">

                                            <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Admitir</button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    </form>
                                <?php } ?>
                                <!-- /Boton admitir -->
                                <!-- Boton asignar -->
                                <?php if ($campos['proceso_id'] == 3 && $_SESSION['rol_id'] == 4) { ?>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalAsignar">
                                            Asignar investigador
                                        </button>
                                        <!-- Boton volver atras -->
                                        <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                        <!-- /Boton volver atras -->
                                    </div>
                                <?php } ?>
                                <!-- /Boton asignar -->
                                <!-- Boton emitir de investigacion a director -->
                                <?php if ($campos['proceso_id'] == 4) { ?>
                                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="bit_id_5" id="bit_id_5" value="<?php echo $campos['bitacora_id']; ?>">
                                            <input type="hidden" name="fec_emitir_invest" id="fec_emitir_invest" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                            <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Emitir a director</button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    </form>
                                <?php } ?>
                                <!-- /Boton apertura -->
                                <!-- Boton apertura -->
                                <?php if ($campos['proceso_id'] == 5 && $_SESSION['rol_id'] == 7) { ?>
                                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="bit_id_6" id="bit_id_6" value="<?php echo $campos['bitacora_id']; ?>">
                                            <input type="hidden" name="fec_apertura" id="fec_apertura" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                            <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Auto de apertura</button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    </form>
                                <?php } ?>
                                <!-- /Boton apertura -->
                                <!-- Boton Comunicación -->
                                <?php if ($campos['proceso_id'] == 6 && $_SESSION['rol_id'] == 8) { ?>
                                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="bit_id_7" id="bit_id_7" value="<?php echo $campos['bitacora_id']; ?>">
                                            <input type="hidden" name="fec_comunicacion" id="fec_comunicacion" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                            <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Comunicación</button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    </form>
                                <?php } ?>
                                <!-- /Boton Comunicación -->
                                <!-- Boton Recepción investigacion -->
                                <?php if ($campos['proceso_id'] == 7 && $_SESSION['rol_id'] == 2) { ?>
                                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="bit_id_8" id="bit_id_8" value="<?php echo $campos['bitacora_id']; ?>">
                                            <input type="hidden" name="fec_recep_investigacion" id="fec_recep_investigacion" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                            <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Recepción</button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    </form>
                                <?php } ?>
                                <!-- /Boton Recepción investigacion -->
                                <!-- Boton Estado Proceso -->
                                <?php if ($campos['proceso_id'] == 8 && $_SESSION['rol_id'] == 2) { ?>
                                    <div class="form-group">

                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalEstadoProcess">
                                            Estado actual proceso
                                        </button>
                                        <!-- Boton volver atras -->
                                        <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                        <!-- /Boton volver atras -->
                                    </div>
                                <?php } ?>
                                <!-- /Boton Estado Proceso -->
                                <!-- Boton Validación -->
                                <?php if ($campos['est_proceso_id'] != 6) { ?>
                                    <?php if ($campos['proceso_id'] == 9 && $_SESSION['rol_id'] == 7) { ?>
                                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="bit_id_10" id="bit_id_10" value="<?php echo $campos['bitacora_id']; ?>">
                                                <input type="hidden" name="fec_validacion" id="fec_validacion" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                                <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Validación</button>
                                                <!-- Boton volver atras -->
                                                <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                                <!-- /Boton volver atras -->
                                            </div>
                                        </form>
                                    <?php } ?>
                                    <!-- /Boton Validación -->
                                    <!-- Boton Recepción Secretaria -->
                                    <?php if ($campos['proceso_id'] == 10 && $_SESSION['rol_id'] == 8) { ?>
                                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="bit_id_11" id="bit_id_11" value="<?php echo $campos['bitacora_id']; ?>">
                                                <input type="hidden" name="fec_recep_secretaria" id="fec_recep_secretaria" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                                <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Recepción</button>
                                                <!-- Boton volver atras -->
                                                <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                                <!-- /Boton volver atras -->
                                            </div>
                                        </form>
                                    <?php } ?>
                                    <!-- /Boton Recepción Secretaria -->
                                    <!-- Boton Citación -->
                                    <?php if ($campos['proceso_id'] == 11 && $_SESSION['rol_id'] == 8) { ?>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalCitacion">
                                                Citación
                                            </button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    <?php } ?>
                                    <!-- /Boton Citación -->
                                    <!-- Boton remitir a legal -->
                                    <?php if ($campos['proceso_id'] == 12 && $_SESSION['rol_id'] == 8) { ?>
                                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="bit_id_13" id="bit_id_13" value="<?php echo $campos['bitacora_id']; ?>">
                                                <input type="hidden" name="fec_remi_legal" id="fec_remi_legal" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                                <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Remitir a legal</button>
                                                <!-- Boton volver atras -->
                                                <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                                <!-- /Boton volver atras -->
                                            </div>
                                        </form>
                                    <?php } ?>
                                    <!-- /Boton remitir a legal -->
                                    <!-- Boton asignar -->
                                    <?php if ($campos['proceso_id'] == 13 && $_SESSION['rol_id'] == 5) { ?>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalAsignarTecLeg">
                                                Asignar técnico legal
                                            </button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </div>
                                    <?php } ?>
                                    <!-- /Boton asignar -->
                                    <!-- Boton entregar dictamen -->
                                    <?php if ($campos['proceso_id'] == 14 && $_SESSION['rol_id'] == 3) { ?>
                                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="bit_id_15" id="bit_id_15" value="<?php echo $campos['bitacora_id']; ?>">
                                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                                <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Entregar dictamen</button>
                                                <!-- Boton volver atras -->
                                                <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                                <!-- /Boton volver atras -->
                                            </div>
                                        </form>
                                    <?php } ?>
                                    <!-- /Boton dictamen -->
                                    <!-- Boton devolución -->
                                    <?php if ($campos['proceso_id'] == 15 && $_SESSION['rol_id'] == 5) { ?>
                                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="bit_id_40" id="bit_id_40" value="<?php echo $campos['bitacora_id']; ?>">

                                                <input type="hidden" name="fec_remi_direccion" id="fec_remi_direccion" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                                <button type="submit" class="btn btn-success mb-2"><i class="fas fa-check-circle"></i> Remitir a Dirección</button>
                                        </form>
                                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                            <input type="hidden" class="form-control" name="bit_id_16" id="bit_id_16" value="<?php echo $campos['bitacora_id']; ?>">
                                            <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                            <input type="hidden" name="fec_devolucion" id="fec_devolucion" value="<?php echo date('Y-m-d H:i:s'); ?>">


                                            <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Auto de devolución</button>
                                            <!-- Boton volver atras -->
                                            <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                            <!-- /Boton volver atras -->
                                        </form>
                            </div>
                        <?php } ?>
                        <!-- /Boton devolución -->
                        <!-- Boton entrega dictamen -->
                        <?php if ($campos['proceso_id'] == 16 && $_SESSION['rol_id'] == 3) { ?>
                            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="bit_id_17" id="bit_id_17" value="<?php echo $campos['bitacora_id']; ?>">
                                    <input type="hidden" name="fec_entrega_dictamen" id="fec_entrega_dictamen" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                    <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                    <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Entregar dictamen</button>
                                    <!-- Boton volver atras -->
                                    <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                    <!-- /Boton volver atras -->
                                </div>
                            </form>
                        <?php } ?>
                        <!-- /Boton devolución -->
                        <!-- Boton entrega a dirección -->
                        <?php if ($campos['proceso_id'] == 17 && $_SESSION['rol_id'] == 5) { ?>
                            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="bit_id_18" id="bit_id_18" value="<?php echo $campos['bitacora_id']; ?>">
                                    <input type="hidden" name="fec_remi_direccion" id="fec_remi_direccion" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                    <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                    <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Remitir a Dirección</button>
                                    <!-- Boton volver atras -->
                                    <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                    <!-- /Boton volver atras -->
                                </div>
                            </form>
                        <?php } ?>
                        <!-- /Boton entrega a dirección -->
                        <!-- Boton Memorandum -->
                        <?php if ($campos['proceso_id'] == 18 && $_SESSION['rol_id'] == 7) { ?>
                            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="bit_id_19" id="bit_id_19" value="<?php echo $campos['bitacora_id']; ?>">
                                    <input type="hidden" name="fec_memorandum" id="fec_memorandum" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                    <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                    <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Memorandum</button>
                                    <!-- Boton volver atras -->
                                    <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
                                    <!-- /Boton volver atras -->
                                </div>
                            </form>
                        <?php } ?>
                        <!-- /Boton Memorandum -->
                    <?php } ?>
                        </div>
                    </div>
            </div>
        </div>
</div>
</div>
<?php
                } else {
?>
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

<!-- Modal diligencia preliminares -->
<div class="modal" id="ModaldiligenciaPre">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar diligencias preliminares</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                <label for="diligencias_invest">Diligencias</label>
                                <textarea class="form-control" name="diligencia_pre" id="diligencia_pre" style="text-transform:uppercase" cols="30" rows="5"><?php echo $campos['diligencia_pre']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Confimar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal diligencia investigación -->
<div class="modal" id="ModaldiligenciaInv">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar diligencias investigación</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                <label for="diligencias_invest">Diligencias</label>
                                <textarea class="form-control" name="diligencias_invest" id="diligencias_invest" style="text-transform:uppercase" cols="30" rows="5"><?php echo $campos['diligencias_invest']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Confimar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal diligencia citación -->
<div class="modal" id="ModaldiligenciaCita">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar diligencias citación</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                <label for="diligencia_cita">Diligencias</label>
                                <textarea class="form-control" name="diligencia_cita" id="diligencia_cita" style="text-transform:uppercase" cols="30" rows="5"><?php echo $campos['diligencia_cita']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Confimar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal diligencia legal -->
<div class="modal" id="ModaldiligenciaLeg">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar diligencias legal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                <label for="diligencias_leg">Diligencias legal</label>
                                <textarea class="form-control" name="diligencias_legal" id="diligencias_legal" style="text-transform:uppercase" cols="30" rows="5"><?php echo $campos['diligencias_legal']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Confimar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Asignar investigador -->
<div class="modal" id="ModalAsignar">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Asignar investigador</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="bit_id_4" id="bit_id_4" value="<?php echo $campos['bitacora_id']; ?>">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                <input type="hidden" name="fec_asignar_inves" id="fec_asignar_inves" value="<?php echo date('Y-m-d H:i:s'); ?>">

                                <label for="">Investigador</label>
                                <select class="form-control" name="investigador" id="investigador">
                                    <option value="">Seleccione investigador</option>
                                    <?php
                                    require_once './modelos/conectar.php';
                                    $resultado = $conexion->query("SELECT * FROM tbl_usuario WHERE rol_id = 2");
                                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $registro['usu_id']; ?>"><?php echo $registro['usu_nombre'] . ' ' . $registro['usu_apellido']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <?php if ($campos['proceso_id'] == 3) { ?>
                        <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Asignar</button>
                    <?php } ?>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal informe de cierre (Investigación) -->
<div class="modal" id="ModalEstadoProcess">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Estado actual del proceso</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="bit_id_9" id="bit_id_9" value="<?php echo $campos['bitacora_id']; ?>">
                                <input type="hidden" name="fec_est_proceso" id="fec_est_proceso" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">

                                <label for="">Estado del proceso</label>
                                <select class="form-control" name="est_proceso_id" id="est_proceso_id">
                                    <option value="">Seleccione un estado</option>
                                    <?php
                                    require_once './modelos/conectar.php';
                                    $resultado = $conexion->query("SELECT * FROM tbl_est_proceso");
                                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $registro['est_proceso_id']; ?>"><?php echo $registro['est_proceso_descrip']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Estado  Penal</label>
                                <select class="form-control" name="est_penal_id" id="est_penal_id">
                                    <option value="">Seleccione un estado</option>
                                    <?php
                                    $resultado = $conexion->query("SELECT * FROM tbl_est_penal");
                                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $registro['est_penal_id']; ?>"><?php echo $registro['descrip_est_penal']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <?php if ($campos['proceso_id'] == 8) { ?>
                        <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Confirmar</button>
                    <?php } ?>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal informe de cierre (Investigación) -->
<div class="modal" id="ModalCitacion">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar fecha audiencia descargo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="bit_id_12" id="bit_id_12" value="<?php echo $campos['bitacora_id']; ?>">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                <input type="hidden" name="fec_citacion" id="fec_citacion" value="<?php echo date('Y-m-d H:i:s'); ?>">

                                <label for="">Fecha audiencia de descargo</label>
                                <input type="date" autocomplete="off" class="form-control" name="fecha_aud_desc" id="fecha_aud_desc">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <?php if ($campos['proceso_id'] == 11) { ?>
                        <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Confirmar</button>
                    <?php } ?>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal asignar tecnico legal -->
<div class="modal" id="ModalAsignarTecLeg">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Asignar técnico legal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="bit_id_14" id="bit_id_14" value="<?php echo $campos['bitacora_id']; ?>">
                                <input type="hidden" name="fec_asigna_legal" id="fec_asigna_legal" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                                <label for="">Técnico legal</label>
                                <select class="form-control" name="tecnico_id" id="tecnico_id">
                                    <option value="">Seleccione técnico legal</option>
                                    <?php
                                    require_once './modelos/conectar.php';
                                    $resultado = $conexion->query("SELECT * FROM tbl_usuario WHERE rol_id = 3");
                                    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $registro['usu_id']; ?>"><?php echo $registro['usu_nombre'] . ' ' . $registro['usu_apellido']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <?php if ($campos['proceso_id'] == 13) { ?>
                        <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Asignar</button>
                    <?php } ?>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Interrupcion -->
<div class="modal" id="ModalInterrupcion">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Interrupción</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="default" autocomplete="off">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" autocomplete="off" class="form-control" name="fecha_final_exp_up" id="fecha_final_exp_up" value="<?php echo $campos['fecha_final_exp']; ?>" readonly>


                        <input type="hidden" class="form-control" name="bit_id_50" id="bit_id_50" value="<?php echo $campos['bitacora_id']; ?>">
                        <input type="hidden" class="form-control" name="exp_id" id="exp_id" value="<?php echo $campos['exp_id']; ?>">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Numero de días de interrupción<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="diasInterrup" id="diasInterrup" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="">Observacion de interrupción</label>
                                <textarea class="form-control" style="text-transform:uppercase" name="observacion" id="observacion" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <?php if ($campos['proceso_id'] > 2 && $campos['proceso_id'] < 13) { ?>
                        <button type="submit" class="btn btn-info"><i class="fas fa-check-circle"></i> Crear interrupción</button>
                    <?php } ?>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>