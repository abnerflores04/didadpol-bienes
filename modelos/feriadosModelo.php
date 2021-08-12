<?php
require_once "mainModel2.php";
class feriadosModelo extends mainModel2{
    /*Modelo para agregar feriado */
    public static function agregar_feriado_modelo($datos){
        $sql=mainModel2::conectar()->prepare("INSERT INTO tbl_feriados(descripcion, fecha) VALUES (:descrip_feriado,:fecha_feriado)");
        $sql->bindParam(":descrip_feriado",$datos['descrip_feriado']);
        $sql->bindParam(":fecha_feriado",$datos['fecha_feriado']);
        
        $sql->execute();
        return $sql;
    }
    /* Modelo datos feriado*/
    protected static function datos_feriado_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_feriados WHERE feriado_id=:id");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel2::conectar()->prepare("SELECT feriado_id FROM tbl_feriados");
        }

        $sql->execute();
        return $sql;
    }
     /* Modelo actualizar rol*/
     protected static function actualizar_feriado_modelo($datos){
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_feriados SET  descripcion=:descrip_feriado, fecha=:fecha_feriado WHERE feriado_id=:feriado_id");
        $sql->bindParam(":descrip_feriado", $datos['descrip_feriado']);
        $sql->bindParam(":fecha_feriado", $datos['fecha_feriado']);
        $sql->bindParam(":feriado_id", $datos['feriado_id']);
        $sql->execute();
        return $sql;
    }
    protected static function eliminar_feriado_modelo($id)
    {
        $sql = mainModel2::conectar()->prepare("DELETE FROM tbl_feriados WHERE feriado_id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;
    }
}