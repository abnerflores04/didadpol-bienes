<?php
require_once 'conectar2.php';
$depto_id = $_POST['depto_id'];
$cadena='<option value="">Seleccine municipio:</option>';
$resultado = $conexion->query("SELECT * FROM tbl_municipios WHERE depto_id=$depto_id order by nombre asc");

while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $cadena.='<option value="' . $registro["municipio_id"] . '">' . $registro["nombre"] . '</option>';
}
echo $cadena;