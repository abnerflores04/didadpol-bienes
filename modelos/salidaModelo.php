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
    //Actualizar gira modelo
    protected static function actualizar_gira_modelo($datos){
        $sql1 = mainModel2::conectar()->prepare("UPDATE tbl_salida SET motorista_id=:motorista,tipo_salida_id=:tipo_salida,salida_fecha=:fecha_salida,salida_observacion=:observacion WHERE  salida_id=:id_salida");
        $sql1->bindParam(":motorista", $datos['motorista']);
        $sql1->bindParam(":tipo_salida", $datos['tipo_salida']);
        $sql1->bindParam(":fecha_salida", $datos['fecha_salida']);
        $sql1->bindParam(":observacion", $datos['observacion']);
        $sql1->bindParam(":id_salida", $datos['id_salida']);
        $sql1->execute();
        return $sql1;

    }
    //Agregar nuevos colaboradores
    protected static function agregar_nuevos_colab_modelo($colab_input, $colab_values, $id_salida)
    {
        foreach ($colab_input as $input_val) {
            if (!in_array($input_val, $colab_values)) {
                $sql2 = mainModel2::conectar()->prepare("INSERT INTO tbl_usuario_salida (colaborador_id, salida_id) VALUES (:colaborador,:id_salida)");
                $sql2->bindParam(":colaborador", $input_val);
                $sql2->bindParam(":id_salida", $id_salida);
                $sql2->execute();
            }
        }
        
    }
    //eliminar colaboradores
    protected static function eliminar_colab_modelo($colab_input, $colab_values, $id_salida)
    {
        foreach ($colab_values as $colab_row) {
            if (!in_array($colab_row, $colab_input)) {
                $sql3 = mainModel2::conectar()->prepare("DELETE FROM tbl_usuario_salida WHERE salida_id=:id_salida AND colaborador_id=:id_colaborador");
                $sql3->bindParam(":id_salida", $id_salida);
                $sql3->bindParam(":id_colaborador", $colab_row);
                $sql3->execute();
            }
        }
        
    }
    protected static function eliminar_gira_modelo($id)
    {
        $sql = mainModel2::conectar()->prepare("DELETE FROM tbl_usuario_salida WHERE salida_id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $sql6 = mainModel2::conectar()->prepare("DELETE FROM tbl_salida WHERE salida_id=:ids");
        $sql6->bindParam(":ids", $id);
        $sql6->execute();
        return $sql;
    }
}
