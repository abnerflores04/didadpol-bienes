<?php
require_once "mainModel2.php";
class feriadosModelo extends mainModel2{
    /*Modelo para iniciar sesion */
    public static function agregar_feriado_modelo($datos){
        $sql=mainModel2::conectar()->prepare("INSERT INTO tbl_feriado(feriado_descrip, feriado_fecha) VALUES (:descrip_feriado,:fecha_feriado)");
        $sql->bindParam(":descrip_feriado",$datos['descrip_feriado']);
        $sql->bindParam(":fecha_feriado",$datos['fecha_feriado']);
        
        $sql->execute();
        return $sql;
    }
}