<?php
require_once 'conectar2.php';
$tipo_falta_id = $_POST['tipo_falta_id'];
$resultado = $conexion->query("SELECT * FROM tbl_articulo WHERE tipo_falta_id='$tipo_falta_id'");
$c=1;
$cadena='';
while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $cadena.='<option value="' . $registro["art_id"] . '" >' .$registro["n_art"].') '. $registro["art_descrip"] . '</option>';
    $c++;
}
echo $cadena;