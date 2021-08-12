<?php
require_once "mainModel2.php";
class usuarioModelo2 extends mainModel2
{
    /* Modelo datos del usuario*/
    protected static function datos_usuario_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel2::conectar()->prepare("SELECT u.nombre nombreu, u.apellido, u.identidad, u.nom_usuario,u.rol_id,u.puesto_id, s.seccion_id,s.nombre nombres, u.unidad_id, u.celular,u.estado,u.usuario_id FROM tbl_usuarios u inner join tbl_unidades ud on ud.unidad_id=u.unidad_id inner join tbl_secciones s on ud.seccion_id=s.seccion_id WHERE usuario_id=:id");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel2::conectar()->prepare("SELECT usuario_id FROM tbl_usuarios WHERE usuario_id!='1'");
        }
        $sql->execute();
        return $sql;
    }
     /* Modelo actualizarusuario*/
     protected static function actualizar_usuario_modelo($datos){
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_usuarios SET rol_id=:rol,puesto_id=:puesto,unidad_id=:unidad,nom_usuario=:usuario,nombre=:nombres,apellido=:apellidos,identidad=:dni,email=:email,estado=:estado,celular=:celular WHERE usuario_id=:id");
        $sql->bindParam(":rol", $datos['rol']);
        $sql->bindParam(":puesto", $datos['puesto']);
        $sql->bindParam(":unidad", $datos['unidad']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":nombres", $datos['nombres']);
        $sql->bindParam(":apellidos", $datos['apellidos']);
        $sql->bindParam(":dni", $datos['dni']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->bindParam(":email", $datos['email']);
        $sql->bindParam(":celular", $datos['celular']);
        $sql->bindParam(":id", $datos['id']);
        $sql->execute();
        return $sql;

    }
}

