<?php
require_once "mainModel.php";
class usuarioModelo extends mainModel
{
    /* Modelo agregar usuario*/
    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario (rol_id, usu_usuario, usu_nombre, usu_apellido, usu_password, usu_estado, usu_correo_i, usu_correo_p, usu_celular) VALUES (:rol,:usuario,:nombres,:apellidos,:clave,:estado,:correo_i,:correo_p,:celular)");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":nombres", $datos['nombres']);
        $sql->bindParam(":apellidos", $datos['apellidos']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->bindParam(":correo_i", $datos['correo_i']);
        $sql->bindParam(":correo_p", $datos['correo_p']);
        $sql->bindParam(":celular", $datos['celular']);
        $sql->execute();
        return $sql;
    }
    protected static function cambiar_clave_modelo($datos){
        $sql = mainModel::conectar()->prepare("UPDATE tbl_usuario SET usu_password=:clave, usu_estado=:estado WHERE usu_id=:id_c");
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":estado",$datos['estado_c']);
        $sql->bindParam(":id_c", $datos['id_c']);
        $sql->execute();
        return $sql;

    }
}

