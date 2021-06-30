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
                    <h1>Registro de expediente investigación</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Registro de expediente investigación</li>
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
                                    <label>Nombre completo</label>
                                    <input type="text" class="form-control" style="text-transform:uppercase" name="nombre_d_reg" id="nombre_d_reg">
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
                                    <select class="form-control" name="genero_reg" id="genero_reg">
                                        <option value="">Seleccione sexo:</option>
                                        <?php
                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_genero");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["genero_id"] . '">' . $registro["genero_descrip"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Departamento <span class="text-danger">*</span></label>
                                    <select class="form-control" name="depto_reg" id="depto">
                                        <option value="">Seleccione departamento</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_depto");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["depto_id"] . '">' . $registro["depto_nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Municipio <span class="text-danger">*</span></label>
                                    <select class="form-control" name="municipio_reg" id="municipio">
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
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000-00000" name="n_exp_reg" id="n_exp_reg">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha conocimiento DIDADPOL<span class="text-danger">*</label>
                                    <input type="date" autocomplete="off" class="form-control" name="fecha_inicio_exp_reg" id="fecha_inicio_exp_reg">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for=""> Nombre completo del investigado</label>
                                    <input type="text" class="form-control" style="text-transform:uppercase" name="investigado" id="investigado">
                                </div>
                            </div>

                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Rango <span class="text-danger">*</span></label>
                                    <select class="form-control" name="rango_id_reg" id="rango_id_reg">
                                        <option value="">Seleccione rango</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_rango");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["rango_id"] . '">' . $registro["rango_descripcion"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Tipo de falta <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tipo_falta_reg" id="lista_f">
                                        <option value="">Seleccione tipo de falta</option>
                                        <?php

                                        require_once './modelos/conectar.php';
                                        $resultado = $conexion->query("SELECT * FROM tbl_tipo_falta");

                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value="' . $registro["tipo_falta_id"] . '">' . $registro["tipo_falta_descrip"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Articulos <span class="text-danger">*</span></label>
                                    <select class="form-control lista_a" name="articulos_reg[]" id="lista_a" multiple="multiple" style="width:100%;">
                                    </select>
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
    });
</script>