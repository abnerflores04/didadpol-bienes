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
                    <h1>Registro del expediente </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/didadpol-bienes/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Registro del expediente </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos del expediente</h3>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                    <p class="text-danger ">Campos obligatorios *</p>
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/expedienteAjax.php" method="POST" data-form="save" autocomplete="off">
                        <div class="row">
                        <div class="col-sm-12">
                          <h5 class="font-weight-bold text-uppercase" >Datos del denunciante</h5>
                            <hr>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">
                                        <input type="checkbox" name="mostrar" id="mostrar"> ¿Anónimo?</label>
                                </div>
                            </div>

                            <div class="col-sm-6" id="contenedor">
                                <div class="form-group">
                                    <label>Nombre completo del denunciante</label>
                                    <input type="text" class="form-control" style="text-transform:uppercase" name="nom_d_reg" id="nom_d_reg">
                                </div>

                            </div>
                            <div class="col-sm-6" id="contenedor2">
                                <div class="form-group">
                                    <label>Identidad</label>
                                    <input type="text" class="form-control" name="identidad_d_reg" id="identidad_d_reg">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Sexo <span class="text-danger">*</span></label>
                                    <select class="form-control" name="sexo_d_reg" id="sexo_d_reg" required>
                                        <option value="">Seleccione sexo</option>
                                        <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_sexos");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["sexo_id"] . '">' . $registro["descripcion"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Departamento <span class="text-danger">*</span></label>
                                    <select class="form-control" name="depto_d_reg" id="lista_dd" required>
                                        <option value="">Seleccione departamento</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_deptos");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["depto_id"] . '">' . $registro["nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Municipio <span class="text-danger">*</span></label>
                                    <select class="form-control" name="municipio_d_reg" id="lista_md" required>
                                        <option value="">Seleccione municipio</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                            <h5 class="font-weight-bold text-uppercase" >Datos del investigado y expediente</h5>
                            <hr>
                            </div>
                            <div class="col-sm-6">
                                <label>N° de expediente<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">DPL-</span>
                                    </div>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000-00000" name="n_exp_reg" id="n_exp_reg" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha conocimiento DIDADPOL<span class="text-danger">*</span></label>
                                    <input type="date" autocomplete="off" class="form-control" name="fec_i_exp_reg" id="fec_i_exp_reg" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre completo del investigado<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" style="text-transform:uppercase" name="nom_i_reg" id="nom_i_reg" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Identidad<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="identidad_i_reg" id="identidad_i_reg" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Edad</label>
                                    <input type="number" class="form-control"  name="edad_i_reg" id="edad_i_reg">
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Sexo<span class="text-danger">*</span></label>
                                    <select class="form-control" name="sexo_i_reg" id="sexo_i_reg" required>
                                        <option value="">Seleccione sexo:</option>
                                        <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_sexos");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["sexo_id"] . '">' . $registro["descripcion"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Grado <span class="text-danger">*</span></label>
                                    <select class="form-control" name="grado_reg" id="grado_reg" required>
                                        <option value="">Seleccione grado</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_grados");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["grado_id"] . '">' . $registro["nom_grado"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for=""> Lugar de asignación</label>
                                    <input type="text" class="form-control" style="text-transform:uppercase" name="lugar_asig_reg" id="lugar_asig_reg" required>
                                </div>
                            </div>
                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Departamento <span class="text-danger">*</span></label>
                                    <select class="form-control" name="depto_i_reg" id="lista_di" required>
                                        <option value="">Seleccione departamento</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_deptos");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["depto_id"] . '">' . $registro["nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Municipio <span class="text-danger">*</span></label>
                                    <select class="form-control" name="municipio_i_reg" id="lista_mi" required>
                                        <option value="">Seleccione municipio</option>

                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Tipo de falta <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tipo_falta_reg" id="lista_f" required>
                                        <option value="">Seleccione tipo de falta</option>
                                        <?php

                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_tipofaltas");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["tipo_falta_id"] . '">' . $registro["tipo_falta"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Articulos <span class="text-danger">*</span></label>
                                    <select class="form-control lista_a" name="articulos_reg[]" id="lista_a" multiple="multiple" style="width:100%;" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" required>
                                    <label for="">Tipo ingreso de la denuncia <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tipo_ingreso_reg" id="tipo_ingreso_reg">
                                        <option value="">Seleccione tipo ingreso de la denuncia</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_tipoingresos");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["tipo_ingreso_id"] . '">' . $registro["tipo_ingreso"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Hechos <span class="text-danger">*</span></label>
                                    <textarea class="form-control" style="text-transform:uppercase" name="hechos_reg" id="hechos_reg" cols="30" rows="10" required></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Crear</button>
                                        <a href="<?php echo SERVERURL . 'lista-exp-investigacion/' ?>" class="btn btn bg-red"><i class="fas fa-arrow-circle-left"></i> Volver atrás</a>
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
<script>
    $(function() {

        $('#mostrar').on('change', function() {
            if (this.checked) {
                $("#contenedor,#contenedor2").hide();

            } else {
                $("#contenedor,#contenedor2").show();
            }
        })
        $("#n_exp_reg").mask("0000-0000-00000");
        $("#identidad_d_reg").mask("0000000000000");
        $("#identidad_i_reg").mask("0000000000000");
    });
</script>