<?php
require_once "mainModel.php";
class usuarioModelo extends mainModel
{
    /* Modelo agregar usuario*/
    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario (rol_id, puesto_id, seccion_id, unidad_id, usu_usuario, usu_password, usu_nombre, usu_apellido, usu_identidad, usu_correo_i, usu_correo_p, usu_celular, usu_estado) VALUES (:rol,:puesto,:seccion,:unidad,:usuario,:clave,:nombres,:apellidos,:dni,:correo_i,:correo_p,:celular,:estado)");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":puesto", $datos['puesto']);
        $sql->bindParam(":seccion", $datos['seccion']);
        $sql->bindParam(":unidad", $datos['unidad']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":nombres", $datos['nombres']);
        $sql->bindParam(":apellidos", $datos['apellidos']);
        $sql->bindParam(":dni", $datos['dni']);
        $sql->bindParam(":correo_i", $datos['correo_i']);
        $sql->bindParam(":correo_p", $datos['correo_p']);
        $sql->bindParam(":celular", $datos['celular']);
        $sql->bindParam(":estado", $datos['estado']);
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

