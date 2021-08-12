<?php
require_once "mainModel2.php";
class rolModelo extends mainModel2
{
    /* Modelo agregar rol*/
    protected static function agregar_rol_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_roles (nombre, descripcion) VALUES (:rol,:descrip)");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":descrip", $datos['descrip']);
        $sql->execute();
        return $sql;
    }
    /* Modelo datos del rol*/
    protected static function datos_rol_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_roles WHERE rol_id=:id");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel2::conectar()->prepare("SELECT rol_id FROM tbl_roles");
        }

        $sql->execute();
        return $sql;
    }
    /* Modelo actualizar rol*/
    protected static function actualizar_rol_modelo($datos){
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_roles SET nombre=:rol, descripcion=:descrip WHERE rol_id=:id");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":descrip", $datos['descrip']);
        $sql->bindParam(":id", $datos['id']);
        $sql->execute();
        return $sql;
    }
    protected static function eliminar_rol_modelo($id)
    {
        $sql = mainModel2::conectar()->prepare("DELETE FROM tbl_roles WHERE rol_id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;
    }
   
}
