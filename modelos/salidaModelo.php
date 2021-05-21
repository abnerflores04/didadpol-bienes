<?php
require_once "mainModel2.php";
class salidaModelo extends mainModel2
{
    /* Modelo agregar usuario*/
    protected static function agregar_salida_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_salida(motorista_id, tipo_salida_id, salida_fecha, salida_observacion) VALUES (:motorista,:tipo_salida,:fecha_salida,:observacion)");
        $sql->bindParam(":motorista", $datos['motorista']);
        $sql->bindParam(":tipo_salida", $datos['tipo_salida']);
        $sql->bindParam(":fecha_salida", $datos['fecha_salida']);
        $sql->bindParam(":observacion", $datos['observacion']);
        $sql->execute();
        return $sql;
    }
    protected static function agregar_usu_sal_modelo($datos, $colaborador)
    {
        foreach ($colaborador as $colaboradores) {
            $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_usuario_salida(colaborador_id, salida_id) VALUES (:colaborador,:id_salida)");
            $sql->bindParam(":colaborador", $colaboradores);
            $sql->bindParam(":id_salida", $datos['id_salida']);
            $sql->execute();
        }
        return $sql;
    }
    /* Modelo datos de gira*/
    protected static function datos_gira_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_salida WHERE salida_id=:id AND tipo_salida_id=1");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel2::conectar()->prepare("SELECT salida_id FROM tbl_salida WHERE tipo_salida_id=1");
        }
        $sql->execute();
        return $sql;
    }
}
