<?php
require_once 'conectar2.php';
$seccion_id = $_POST['seccion_id'];
$cadena='<option value="0">Seleccine unidad:</option>';
$resultado = $conexion->query("SELECT * FROM tbl_unidades WHERE seccion_id=$seccion_id");

while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $cadena.='<option value="' . $registro["unidad_id"] . '">' . $registro["nombre"] . '</option>';
}
echo $cadena;