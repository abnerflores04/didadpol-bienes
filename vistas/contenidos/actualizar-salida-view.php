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
                    <h1>Actualizar gira</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Actualizar gira</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning card-outline">
                <?php
                require_once "./controladores/salidaControlador.php";
                $ins_salida = new salidaControlador();
                $datos_gira = $ins_salida->datos_gira_controlador("Unico", $pagina[1]);
                if ($datos_gira->rowCount() == 1) {
                    $campos = $datos_gira->fetch();
                ?>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <p class="text-danger ">Campos obligatorios *</p>
                        <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/salidaAjax.php" method="POST" data-form="update" autocomplete="off">
                            <div class="row">
                                <input type="hidden" name="gira_id_up" value="<?php echo $pagina[1]; ?>" required>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Motorista <span class="text-danger">*</span></label>
                                        <select class="form-control" name="motorista_gira_up" id="motorista_gira_up" required>
                                            <option value="" >Seleccione motorista</option>
                                            <?php
                                            require_once './modelos/conectar.php';
                                            $resultado_salida = $conexion->query("select * from tbl_usuario tu inner join tbl_salida ts on ts.motorista_id = tu.usu_id where ts.salida_id = $campos[salida_id]");
                                            $datos_motorista = $resultado_salida->fetch(PDO::FETCH_ASSOC);
                                            $motorista_id = $datos_motorista['usu_id'];
                                            $resultado_usu_mot = $conexion->query("SELECT * FROM tbl_usuario where rol_id=2");
                                            while ($registro_usu_mot = $resultado_usu_mot->fetch(PDO::FETCH_ASSOC)) {
                                                $r = ($motorista_id == $registro_usu_mot["usu_id"]) ? 'selected' : '';
                                                echo '<option value="' . $registro_usu_mot["usu_id"] . '"' . $r . '>' . $registro_usu_mot["usu_nombre"] . ' ' . $registro_usu_mot["usu_apellido"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <?php
                                    $query="SELECT * FROM tbl_usuario_salida WHERE salida_id=$campos[salida_id]";
                                    $resultado_colaboradores = $conexion->query($query);
                                    $colaboradores = $resultado_colaboradores->fetchAll(PDO::FETCH_ASSOC);
                                    $us_array=[];
                                    foreach ($colaboradores as $colaborador) {
                                        $us_array[]= $colaborador['colaborador_id'];
                                    }
                                    ?>
                                        <label>Colaborador / Colaboradores <span class="text-danger">*</span></label>
                                        <select class="form-control colaboradores_sal_reg" multiple style="width: 100%;" id="colaboradores_gira_up" name="colaboradores_gira_up[]" data-placeholder="Seleccione Colaborador / Colaboradores" required>
                                        <?php
                                    $query2="SELECT * FROM tbl_usuario WHERE rol_id!=2";
                                    $resultado_usuarios = $conexion->prepare($query2);
                                    $resultado_usuarios->execute();
                                    if ($resultado_usuarios->rowCount() > 0) {
                                        foreach ($resultado_usuarios as $c) {
                                            ?>
                                            <option value="<?php echo $c['usu_id'] ?>"
                                            <?php echo in_array($c['usu_id'],$us_array)? 'selected':'' ?>
                                            >
                                            <?php echo $c['usu_nombre']." ".$c['usu_apellido']; ?>
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
                                    <label>Tipo de salida <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tipo_sal_up" id="tipo_sal_up">
                                        <option value="" selected="">Seleccione tipo de salida</option>
                                        <?php
                                        $resultado_salida = $conexion->query("select * from tbl_salida ts inner join tbl_tipo_salida tts on ts.tipo_salida_id = tts.tipo_salida_id where ts.salida_id = $campos[salida_id]");
                                        $datos_salida = $resultado_salida->fetch(PDO::FETCH_ASSOC);
                                        $tipo_salida_id = $datos_salida['tipo_salida_id'];
                                        $res = $conexion->query("SELECT * FROM tbl_tipo_salida");
                                        while ($reg = $res->fetch(PDO::FETCH_ASSOC)) {
                                            $r = ($tipo_salida_id == $reg["tipo_salida_id"]) ? 'selected' : '';
                                            echo '<option value="' . $reg["tipo_salida_id"] . '"' . $r . '>' . $reg["tipo_salida_descripcion"].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                              
                                <div class="col-md-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Fecha de salida <span class="text-danger">*</span></label>
                                        <input type="date" autocomplete="off" class="form-control apellidos" placeholder="" name="fecha_gira_up" id="fecha_gira_up" value="<?php echo $campos['salida_fecha'];?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <p class="font-weight-bold"> Observación <span class="text-danger">*</span></p>
                                        <textarea name="observacion_gira_up" id="observacion_gira_up" cols="57" rows="10" style="text-transform:uppercase" required><?php echo $campos['salida_observacion']; ?></textarea>
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