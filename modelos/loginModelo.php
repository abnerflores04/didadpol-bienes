<?php
require_once "mainModel2.php";
class loginModelo extends mainModel2{
    /*Modelo para iniciar sesion */
    public static function iniciar_sesion_modelo($datos){
        $sql=mainModel2::conectar()->prepare("SELECT * FROM tbl_usuario WHERE usu_usuario=:usuario AND usu_password=:clave");
        $sql->bindParam(":usuario",$datos['usuario']);
        $sql->bindParam(":clave",$datos['clave']);
        $sql->execute();
        return $sql;
    }
}