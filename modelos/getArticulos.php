<?php
require_once 'conectar2.php';
$tipo_falta_id = $_POST['tipo_falta_id'];
$resultado = $conexion->query("SELECT * FROM tbl_articulos WHERE tipo_falta_id='$tipo_falta_id'");
$c=1;
$cadena='';
while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $cadena.='<option value="' . $registro["articulo_id"] . '" >' .$registro["num_articulo"].') '. $registro["descripcion"] . '</option>';
    $c++;
}
echo $cadena;