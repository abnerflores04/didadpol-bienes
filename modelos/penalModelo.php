<?php
require_once "mainModel2.php";
class penalModelo extends mainModel2
{
/* Modelo agregar proceso penal*/
protected static function agregar_proc_penal_modelo($datos)
{
    $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_rol (rol_nombre, rol_descripcion) VALUES (:rol,:descrip)");
    $sql->bindParam(":rol", $datos['rol']);
    $sql->bindParam(":descrip", $datos['descrip']);
    $sql->execute();
    return $sql;
}
/* Modelo datos del proceso penal*/
protected static function datos_proc_penal_modelo($tipo, $id)
{
    if ($tipo == "Unico") {
        $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_rol WHERE rol_id=:id");
        $sql->bindParam(":id", $id);
    } elseif ($tipo == "Conteo") {
        $sql = mainModel2::conectar()->prepare("SELECT rol_id FROM tbl_rol");
    }
    $sql->execute();
    return $sql;
}
/* Modelo actualizar proceso penal*/
protected static function actualizar_proc_penal_modelo($datos){
    $sql = mainModel2::conectar()->prepare("UPDATE tbl_rol SET rol_nombre=:rol, rol_descripcion=:descrip WHERE rol_id=:id");
    $sql->bindParam(":rol", $datos['rol']);
    $sql->bindParam(":descrip", $datos['descrip']);
    $sql->bindParam(":id", $datos['id']);
    $sql->execute();
    return $sql;
}
}
