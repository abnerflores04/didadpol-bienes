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
                    <h1>Ver información del usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver información del usuario</li>
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
	require_once "./controladores/usuarioControlador2.php";
    
	$ins_usuario = new usuarioControlador2();
	$datos_usuario = $ins_usuario->datos_usuario_controlador("Unico", $pagina[1]);
	if ($datos_usuario->rowCount() == 1) {
		$campos = $datos_usuario->fetch();

	?>
                <!-- /.card-body -->
                <div class="card-body">
                    <form class="FormulariosAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update" autocomplete="off">
                        <div class="row">
                        <input type="hidden" name="usu_id_up" value="<?php echo $pagina[1]; ?>">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombres </label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control apellidos" placeholder="" name="usu_nombres_up" id="usu_nombres_up" value="<?php echo $campos['usu_nombre']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" autocomplete="off" style="text-transform:uppercase" class="form-control nombres" placeholder=" " name="usu_apellidos_up" id="usu_apellidos_up" value="<?php echo $campos['usu_apellido']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>DNI</label>
                                    <input type="text" autocomplete="off" class="form-control" placeholder="INGRESE DNI SIN GUIONES O ESPACIONES" name="usu_identidad_up" id="usu_identidad_up" value="<?php echo $campos['usu_identidad']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre de usuario </label>
                                    <input type="text" autocomplete="off" style="text-transform:lowercase" class="form-control nombres" placeholder=" " name="usu_usuario_up" id="usu_usuario_up" value="<?php echo $campos['usu_usuario']; ?>"readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Rol </label>
                                    <select class="form-control" name="usu_rol_up" id="usu_rol_up" disabled>
                                        <option value="" selected="" >Seleccione rol:</option>
                                        <?php
                                         require_once './modelos/conectar.php';
                                         $resultado = $conexion->query("SELECT * FROM tbl_rol");
                                         while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                         ?>
                                         <option value="<?php echo $registro['rol_id']; ?>" 
                                         <?php if($registro['rol_id']==$campos['rol_id']) {
                                         echo 'selected'; } 
                                         ?>
                                         ><?php echo $registro['rol_nombre']; ?></option>
                                         <?php } ?>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Puesto</label>
                                    <select class="form-control" name="usu_puesto_up" id="usu_puesto_up" disabled>
                                        <option value="" selected="" >Seleccione puesto:</option>
                                        <?php
                                         $resultado= $conexion->query("SELECT * FROM tbl_puesto");
                                         while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                         ?>
                                         <option value="<?php echo $registro['puesto_id']; ?>" 
                                         <?php if($registro['puesto_id']==$campos['puesto_id']) {
                                         echo 'selected'; } 
                                         ?>
                                         ><?php echo $registro['puesto_nombre']; ?></option>
                                         <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>SECCIÓN</label>
                                    <select class="form-control" name="usu_seccion_up" id="lista1" disabled>
                                        <option value="0" selected="" >Seleccione sección:</option>
                                        <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_seccion");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <option value="<?php echo $registro['seccion_id']; ?>" 
                                        <?php if($registro['seccion_id']==$campos['seccion_id']) {
                                        echo 'selected'; } 
                                        ?>
                                        ><?php echo $registro['seccion_nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>UNIDAD</label>
                                    <select class="form-control" name="usu_unidad_up" id="lista2" disabled>
                                    <?php
                                        $resultado = $conexion->query("SELECT * FROM tbl_unidad");
                                        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                           <option value="<?php echo $registro['unidad_id']; ?>" 
                                           <?php if($registro['unidad_id']==$campos['unidad_id']) {
                                                echo 'selected'; } 
                                            ?>
                                            ><?php echo $registro['unidad_nombre']; ?></option>
                                           <?php } ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Correo pesonal </label>
                                    <input type="email" style="text-transform:lowercase" autocomplete="off" class="form-control correo" placeholder="" name="usu_correo_up" id="usu_correo_up" value="<?php echo $campos['usu_correo_p']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" autocomplete="off" class="form-control" placeholder=" " name="usu_celular_up" id="usu_celular_up" value="<?php echo $campos['usu_celular']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estado </label>
                                    <select class="form-control" name="usu_estado_up" id="usu_estado_up" disabled>
                                        <option value="" selected="" >Seleccione estado:</option>
                                        <option value="1" 
										
										<?php if ($campos['usu_estado']=='ACTIVO') {
												echo 'selected=""';
										}?>
										
										>ACTIVO <?php if ($campos['usu_estado']=='ACTIVO') {
										}?></option>
										<option value="2"
										<?php if ($campos['usu_estado']=='INACTIVO') {
												echo 'selected=""';
										}?>
										>INACTIVO <?php if ($campos['usu_estado']=='INACTIVO') {
										}?></option>
										<option value="3"
										<?php if ($campos['usu_estado']=='BLOQUEADO') {
												echo 'selected=""';
										}?>
										>BLOQUEADO <?php if ($campos['usu_estado']=='BLOQUEADO') {
										}?></option>
                                        <option value="4"
										<?php if ($campos['usu_estado']=='VACACIONES') {
												echo 'selected=""';
										}?>
										>VACACIONES <?php if ($campos['usu_estado']=='VACACIONES') {
										}?></option>
                                        <option value="5"
										<?php if ($campos['usu_estado']=='NUEVO') {
												echo 'selected=""';
										}?>
										>NUEVO <?php if ($campos['usu_estado']=='NUEVO') {
										}?></option>
                                       
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <a href="<?php echo SERVERURL.'lista-usuarios/'?>" class="btn btn bg-red" ><i class="fas fa-arrow-left"></i> ATRÁS</a>
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