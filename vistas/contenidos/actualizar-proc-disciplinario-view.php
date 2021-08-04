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
                    <h1>Actualizar proceso disciplinario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Actualizar Proceso disciplinario</li>
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
            require_once "./controladores/disciplinarioControlador.php";
            $ins_disciplinario = new disciplinarioControlador();
            $datos_proc_disciplinario = $ins_disciplinario->datos_proc_disciplinario_controlador("Unico", $pagina[1]);
            if ($datos_proc_disciplinario->rowCount() == 1) {
                $campos = $datos_proc_disciplinario->fetch();
            ?>
                <div class="card card-warning card-outline">
                    <!-- /.card-body -->
                    <div class="card-body">
                        <p class="text-danger ">Campos obligatorios *</p>
                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/disciplinarioAjax.php" method="POST" data-form="update" autocomplete="off">
                            <div class="row">
                                <input type="hidden" name="proc_disciplinario_id_up" value="<?php echo $pagina[1]; ?>">
                                <div class="col-sm-6">
                                    <label>N° de expediente</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">DPL-</span>
                                        </div>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000-00000" name="n_exp_up" id="n_exp_up" value="<?php echo $campos['num_exp']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Nombres del Investigado(a)</label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="nombre_i_up" id="nombre_i_up" value="<?php echo $campos['nombre_investigado']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Rango </label>
                                        <select class="form-control" name="rango_up" id="rango_up" disabled>
                                            <option value="">Seleccione rango:</option>
                                            <?php
                                            require_once './modelos/conectar.php';
                                            $resultado = $conexion->query("SELECT * FROM tbl_rango");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['rango_id']; ?>" 
                                                <?php if ($registro['rango_id'] == $campos['rango_id']) {
                                                 echo 'selected';
                                                }
                                                ?>><?php echo $registro['rango_descripcion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tipo de falta</label>
                                        <select class="form-control" name="tipo_falta_up" id="tipo_falta_up" disabled>
                                            <option value="">Seleccione tipo de falta:</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_tipo_falta");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['tipo_falta_id']; ?>" 
                                                <?php if ($registro['tipo_falta_id'] == $campos['tipo_falta_id']) {                                                                     echo 'selected';
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
                                        <label for="">Articulo(s)</label>
                                        <select class="form-control lista_a" name="articulos_up[]" id="lista_a" multiple="multiple" style="width:100%;" disabled>
                                            <?php
                                            $query2 = "SELECT * FROM tbl_articulo";
                                            $resultado_articulo = $conexion->prepare($query2);
                                            $resultado_articulo->execute();
                                            if ($resultado_articulo->rowCount() > 0) {
                                                foreach ($resultado_articulo as $a) {
                                            ?>
                                            <option value="<?php echo $a['art_id'] ?>" 
                                            <?php echo in_array($a['art_id'], $us_array) ? 'selected' : '' ?>>
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Recomendación</label>
                                        <select class="form-control" name="recomen_up" id="recomen_up" disabled>
                                            <option value="">Seleccione recomendación:</option>
                                            <?php
                                            require_once './modelos/conectar.php';
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Sexo <span class="text-danger">*</span></label>
                                        <select class="form-control" name="genero_up" id="genero_up">
                                            <option value="">Seleccione sexo:</option>
                                            <?php
                                            $resultado = $conexion->query("SELECT * FROM tbl_genero");
                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $registro['genero_id']; ?>" <?php if ($registro['genero_id'] == $campos['sexo_id']) {
                                                echo 'selected';
                                                }
                                                ?>><?php echo $registro['genero_descrip']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>N° de Identidad<span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000-00000" name="identidad_up" id="identidad_up" value="<?php echo $campos['identidad_investigado']; ?>">
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Dirección policial ala que permanece<span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder=" " name="direccion_pol_up" id="direccion_pol_up" value="<?php echo $campos['direccion_pol']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Antiguedad en la institución policial<span class="text-danger">*</span></label>
                                        <input type="number" autocomplete="off" class="form-control" placeholder="Ingrese cantidad de años" name="antiguedad_up" id="antiguedad_up" value="<?php echo $campos['antiguedad_ins']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>RES. SEDS.<span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="000-0000" name="n_res_seds_up" id="n_res_seds_up" value="<?php echo $campos['n_res_seds']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha RES. SEDS.<span class="text-danger">*</span></label>
                                        <input type="date" autocomplete="off" class="form-control" placeholder="" name="fec_res_seds_up" id="fec_res_seds_up" value="<?php echo $campos['fec_res_seds']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>N° RES. SEDS.<span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="000-0000" name="cod_res_seds_up" id="cod_res_seds_up" value="<?php echo $campos['cod_res_seds']; ?>">
                                    </div>
                                </div>
                               
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha inicial de interposición<span class="text-danger">*</span></label>
                                        <input type="date" autocomplete="off" class="form-control" placeholder="" name="fec_int_i_up" id="fec_int_i_up" value="<?php echo $campos['fec_int_i']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha final de interposición<span class="text-danger">*</span></label>
                                        <input type="date" autocomplete="off" class="form-control" placeholder="" name="fec_int_f_up" id="fec_int_f_up" value="<?php echo $campos['fec_int_f']; ?>">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Vicio de nulidad según la SEDS</label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="vicio_nul_up" id="vicio_nul_up" value="<?php echo $campos['vicio_nul']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Representante legal</label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="repre_legal_up" id="repre_legal_up" value="<?php echo $campos['repre_legal']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>N° Acuerdo de cancelacion<span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000" name="n_acuerdo_up" id="n_acuerdo_up" value="<?php echo $campos['n_acuerdo']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha inicial acuerdo de cancelación<span class="text-danger">*</span></label>
                                        <input type="date" autocomplete="off" class="form-control" placeholder="" name="fec_acuerdo_i_up" id="fec_acuerdo_i_up" value="<?php echo $campos['fec_acuerdo_i']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fecha final acuerdo de cancelación<span class="text-danger">*</span></label>
                                        <input type="date" autocomplete="off" class="form-control" placeholder="" name="fec_acuerdo_f_up" id="fec_acuerdo_f_up" value="<?php echo $campos['fec_acuerdo_f']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>N° Contencioso administrativo<span class="text-danger">*</span></label>
                                        <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control" placeholder="0000-0000" name="n_cont_admin_up" id="n_cont_admin_up" value="<?php echo $campos['n_cont_admin']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> ACTUALIZAR</button>
                                            <a href="<?php echo SERVERURL . 'lista-proc-disciplinarios/' ?>" class="btn btn bg-red"><i class="fa fa-times-circle-o" aria-hidden="true"></i> CANCELAR</a>
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
        $("#n_exp_up").mask("0000-0000-00000");
        $("#identidad_up").mask("0000-0000-00000");
        $("#n_res_seds_up").mask("000-0000");
        $("#cod_res_seds_up").mask("000-0000");
        $("#n_acuerdo_up").mask("0000-0000");
        $("#n_cont_admin_up").mask("0000-0000");

    });
</script>