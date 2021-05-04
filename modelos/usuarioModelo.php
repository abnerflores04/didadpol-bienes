<?php
require_once "mainModel.php";
class usuarioModelo extends mainModel
{
    /* Modelo agregar usuario*/
    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tbl_usuario (rol_id, usu_usuario, usu_nombre, usu_apellido, usu_password, usu_estado, usu_correo, usu_celular) VALUES (:rol,:usuario,:nombres,:apellidos,:clave,:estado,:correo,:celular)");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":nombres", $datos['nombres']);
        $sql->bindParam(":apellidos", $datos['apellidos']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->bindParam(":correo", $datos['correo']);
        $sql->bindParam(":celular", $datos['celular']);
       
        $sql->execute();
        return $sql;
    }
    /* Modelo para eliminar usuario*/
    protected static function eliminar_usuario_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM usuario WHERE usuario_id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        return $sql;
    }
    /* Modelo datos del usuario*/
    protected static function datos_usuario_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario_id=:id");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel::conectar()->prepare("SELECT usuario_id FROM usuario WHERE usuario_id!=:'1'");
        }

        $sql->execute();
        return $sql;
    }
     /* Modelo actualizarusuario*/
    protected static function actualizar_usuario_modelo($datos){
        $sql = mainModel::conectar()->prepare("UPDATE usuario SET usuario_dni=:dni,usuario_nombre=:nombre,usuario_apellido=:apellido,usuario_telefono=:telefono,usuario_direccion=:direccion,usuario_usuario=:usuario,usuario_clave=:clave, usuario_email=:email,usuario_estado=:estado,usuario_privilegio=:privilegio WHERE usuario_id=:id");
        $sql->bindParam(":dni", $datos['dni']);
        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":apellido", $datos['apellido']);
        $sql->bindParam(":telefono", $datos['telefono']);
        $sql->bindParam(":direccion", $datos['direccion']);
        $sql->bindParam(":email", $datos['email']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->bindParam(":privilegio", $datos['privilegio']);
        $sql->bindParam(":id", $datos['id']);
        $sql->execute();
        return $sql;

    }
}

