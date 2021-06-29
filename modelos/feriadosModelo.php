<?php
require_once "mainModel2.php";
class feriadosModelo extends mainModel2{
    /*Modelo para agregar feriado */
    public static function agregar_feriado_modelo($datos){
        $sql=mainModel2::conectar()->prepare("INSERT INTO tbl_feriado(feriado_descrip, feriado_fecha) VALUES (:descrip_feriado,:fecha_feriado)");
        $sql->bindParam(":descrip_feriado",$datos['descrip_feriado']);
        $sql->bindParam(":fecha_feriado",$datos['fecha_feriado']);
        
        $sql->execute();
        return $sql;
    }
    /* Modelo datos feriado*/
    protected static function datos_feriado_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_feriado WHERE id_feriado=:id");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel2::conectar()->prepare("SELECT id_feriado FROM tbl_feriado");
        }

        $sql->execute();
        return $sql;
    }
     /* Modelo actualizar rol*/
     protected static function actualizar_feriado_modelo($datos){
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_feriado SET  feriado_descrip=:descrip_feriado, feriado_fecha=:fecha_feriado WHERE id_feriado=:id_feriado");
        $sql->bindParam(":descrip_feriado", $datos['descrip_feriado']);
        $sql->bindParam(":fecha_feriado", $datos['fecha_feriado']);
        $sql->bindParam(":id_feriado", $datos['id_feriado']);
        $sql->execute();
        return $sql;
    }
    protected static function eliminar_feriado_modelo($id)
    {
        $sql = mainModel2::conectar()->prepare("DELETE FROM tbl_feriado WHERE id_feriado=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;
    }
}