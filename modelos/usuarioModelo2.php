<?php
require_once "mainModel2.php";
class usuarioModelo2 extends mainModel2
{
    /* Modelo datos del usuario*/
    protected static function datos_usuario_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_usuario WHERE usu_id=:id");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel2::conectar()->prepare("SELECT usu_id FROM tbl_usuario WHERE usu_id!='1'");
        }

        $sql->execute();
        return $sql;
    }
     /* Modelo actualizarusuario*/
     protected static function actualizar_usuario_modelo($datos){
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_usuario SET rol_id=:rol,usu_usuario=:usuario,usu_nombre=:nombres,usu_apellido=:apellidos,usu_estado=:estado,usu_correo_i=:correo_i,usu_correo_p=:correo_p,usu_celular=:celular WHERE usu_id=:id");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":nombres", $datos['nombres']);
        $sql->bindParam(":apellidos", $datos['apellidos']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->bindParam(":correo_i", $datos['correo_i']);
        $sql->bindParam(":correo_p", $datos['correo_p']);
        $sql->bindParam(":celular", $datos['celular']);
        $sql->bindParam(":id", $datos['id']);
        $sql->execute();
        return $sql;

    }
}

