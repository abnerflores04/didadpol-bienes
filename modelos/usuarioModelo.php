<?php
require_once "mainModel.php";
class usuarioModelo extends mainModel
{
    /* Modelo agregar usuario*/
    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuarios(rol_id, puesto_id, unidad_id, nom_usuario, usu_password, nombre, apellido, identidad, email, estado, celular) VALUES (:rol,:puesto,:unidad,:usuario,:clave,:nombres,:apellidos,:dni,:email,:estado,:celular)");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":puesto", $datos['puesto']);
        $sql->bindParam(":unidad", $datos['unidad']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":nombres", $datos['nombres']);
        $sql->bindParam(":apellidos", $datos['apellidos']);
        $sql->bindParam(":dni", $datos['dni']);
        $sql->bindParam(":email", $datos['email']); 
        $sql->bindParam(":estado", $datos['estado']);
        $sql->bindParam(":celular", $datos['celular']);
        $sql->execute();
        return $sql;
    }
    protected static function cambiar_clave_modelo($datos){
        $sql = mainModel::conectar()->prepare("UPDATE tbl_usuarios SET usu_password=:clave, estado=:estado WHERE usuario_id=:id_c");
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":estado",$datos['estado_c']);
        $sql->bindParam(":id_c", $datos['id_c']);
        $sql->execute();
        return $sql;

    }
}

