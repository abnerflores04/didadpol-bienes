<!-- Content Wrapper. Contains page content -->
<?php
$filtros=' ';
$_SESSION['depto']='';
$_SESSION['municipio']='';
$_SESSION['rango_id_reg']='';
if (isset($_POST['depto_r'])) {
    $_SESSION['depto']=$_POST['depto_r'];
    $_SESSION['municipio']=$_POST['municipio_r'];
    $_SESSION['rango_id_reg']=$_POST['rango_r'];
    if ($_SESSION['depto']!='' && $_SESSION['municipio']!='' && $_SESSION['rango_id_reg']!='') {
        $filtros=' AND te.depto_id='. $_SESSION['depto'] . ' AND te.municipio_id='. $_SESSION['municipio'] . ' AND te.rango_id='. $_SESSION['rango_id_reg'] ;
    } 
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista expedientes reportes legal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista expedientes reportes legal</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            
                            <form  method="POST" autocomplete="off">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Departamento <span class="text-danger">*</span></label>
                                        <select class="form-control" name="depto_r" id="depto" required>
                                            <option value="">Seleccione departamento</option>
                                            <?php
                                            require_once './modelos/conectar.php';
                                            $resultado = $conexion->query("SELECT * FROM tbl_depto");

                                            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $registro["depto_id"] . '">' . $registro["depto_nombre"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Municipio <span class="text-danger">*</span></label>
                                            <select class="form-control" name="municipio_r" id="municipio" required>
                                                <option value="">Seleccione municipio</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Rango <span class="text-danger">*</span></label>
                                            <select class="form-control" name="rango_r" id="rango_id_reg" required>
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
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-block mt-4">Filtrar</button>
                                    </div>
                                    <div class="col">
                                        <a href="<?php echo SERVERURL; ?>modelos/reporte.php?d=<?php echo $_SESSION['depto'];?>&m=<?php echo $_SESSION['municipio'];?>&r=<?php echo $_SESSION['rango_id_reg'];?>&u=<?php echo $_SESSION['id_spm']?>"class="btn btn-danger btn-block mt-4">Exportar PDF</a>   
                                    </div>
                                </div>
                            </form>
                            <?php
                            require_once "./controladores/reportesControlador.php";
                            
                            $ins_exp = new reportesControlador();
                                echo $ins_exp->listar_exp_reportes_leg();
                            
                            
                           
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://didadpol.gob.hn">DIDADPOL</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>