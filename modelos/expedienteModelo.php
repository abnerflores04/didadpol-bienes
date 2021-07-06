<?php
require_once "mainModel2.php";
class expedienteModelo extends mainModel2
{
    /* Modelo agregar usuario*/
    protected static function agregar_proceso_denuncia_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_exp(nombre_denunciante, identidad_denunciante, genero_id, depto_id, municipio_id, num_exp, nombre_investigado, rango_id, tipo_falta_id, fecha_inicio_exp, fecha_final_exp, fecha_final_i_pre, fecha_final_i) VALUES (:nombre_denunciante,:identidad_denunciante,:genero,:depto,:municipio,:n_exp,:nombre_investigado,:rango,:tipo_falta,:fecha_inicio_exp,:fecha_final_exp,:fecha_final_i_pre,:fecha_final_i)");
        $sql->bindParam(":nombre_denunciante", $datos['nombre_denunciante']);
        $sql->bindParam(":identidad_denunciante", $datos['identidad_denunciante']);
        $sql->bindParam(":genero", $datos['genero']);
        $sql->bindParam(":depto", $datos['depto']);
        $sql->bindParam(":municipio", $datos['municipio']);
        $sql->bindParam(":n_exp", $datos['n_exp']);
        $sql->bindParam(":nombre_investigado", $datos['nombre_investigado']);
        $sql->bindParam(":rango", $datos['rango']);
        $sql->bindParam(":tipo_falta", $datos['tipo_falta']);
        $sql->bindParam(":fecha_inicio_exp", $datos['fecha_inicio_exp']);
        $sql->bindParam(":fecha_final_exp", $datos['fecha_final_exp']);
        $sql->bindParam(":fecha_final_i_pre", $datos['fecha_final_i_pre']);
        $sql->bindParam(":fecha_final_i", $datos['fecha_final_i']);
        $sql->execute();
        return $sql;
    }
    /* Modelo agregar usuario*/
    protected static function agregar_proceso_emision_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_emision=:fec_emision, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_emision", $datos['fec_emision']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo agregar usuario*/
    protected static function agregar_proceso_admision_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_admision=:fec_admision, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_admision", $datos['fec_admision']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo agregar usuario*/
    protected static function agregar_proceso_asig_i_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_asignacion=:fec_asignacion, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_asignacion", $datos['fec_asignacion']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp SET investigador_id=:investigador_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":investigador_id", $datos['investigador_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();
        return $sql;
    }
    /* Modelo emision a direccion*/
    protected static function agregar_proceso_emision_direccion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_emision_invest=:fec_emision_invest, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_emision_invest", $datos['fec_emision_invest']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo auto apertura*/
    protected static function agregar_proceso_apertura_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_act_apertura=:fec_act_apertura, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_act_apertura", $datos['fec_act_apertura']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo comunicacion*/
    protected static function agregar_proceso_comunicacion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_comunicacion=:fec_comunicacion, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_comunicacion", $datos['fec_comunicacion']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo recepcion exp investigador*/
    protected static function agregar_proceso_recep_invest_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_recep_invest=:fec_recep_invest, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_recep_invest", $datos['fec_recep_invest']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo estado del proceso*/
    protected static function agregar_proceso_estado_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_infor_cierre=:fec_infor_cierre, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_infor_cierre", $datos['fec_infor_cierre']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp SET est_proceso_id=:est_proceso_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":est_proceso_id", $datos['est_proceso_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

        return $sql;
    }
    /* Modelo Validacion*/
    protected static function agregar_proceso_validacion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_val_dirreccion=:fec_val_dirreccion, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_val_dirreccion", $datos['fec_val_dirreccion']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo recepcion secretaria*/
    protected static function agregar_proceso_recep_secretaria_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_recep_secretaria=:fec_recep_secretaria, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_recep_secretaria", $datos['fec_recep_secretaria']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo citacion*/
    protected static function agregar_proceso_citacion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fecha_citacion=:fecha_citacion, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fecha_citacion", $datos['fecha_citacion']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp SET fecha_aud_desc=:fecha_aud_desc,fecha_dias_tec_legal=:fecha_dias_tec_legal WHERE exp_id=:exp_id");
        $sql2->bindParam(":fecha_aud_desc", $datos['fecha_aud_desc']);
        $sql2->bindParam(":fecha_dias_tec_legal", $datos['fecha_dias_tec_legal']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

        return $sql;
    }
    /* Modelo recepcion secretaria*/
    protected static function agregar_proceso_remi_legal_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_remision_secretaria=:fec_remision_secretaria, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_remision_secretaria", $datos['fec_remision_secretaria']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
     /* Modelo asignacion tecnico legal*/
     protected static function agregar_proceso_asig_l_modelo($datos)
     {
         $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_asigna_legal=:fec_asigna_legal, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
         $sql->bindParam(":fec_asigna_legal", $datos['fec_asigna_legal']);
         $sql->bindParam(":proceso_id", $datos['proceso_id']);
         $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
         $sql->execute();
 
         $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp SET tecnico_legal=:tecnico_legal WHERE exp_id=:exp_id");
         $sql2->bindParam(":tecnico_legal", $datos['tecnico_legal']);
         $sql2->bindParam(":exp_id", $datos['exp_id']);
         $sql2->execute();
         return $sql;
     }
      /* Modelo dictamen*/
    protected static function agregar_proceso_dictamen_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        return $sql;
    }
    protected static function agregar_bit_fec_cono_modelo($exp_id, $fecha_inicio_exp, $proceso_id)
    {
        $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_bitacora_fechas(exp_id,fec_conocimiento, proceso_id) VALUES (:exp_id,:fec_conocimiento,:proceso_id)");
        $sql->bindParam(":exp_id", $exp_id);
        $sql->bindParam(":fec_conocimiento", $fecha_inicio_exp);
        $sql->bindParam(":proceso_id", $proceso_id);
        $sql->execute();
        return $sql;
    }
    protected static function agregar_exp_art_modelo($exp_id, $articulo)
    {
        foreach ($articulo as $a) {
            $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_exp_art ( exp_id, art_id) VALUES (:exp_id,:art_id)");
            $sql->bindParam(":exp_id", $exp_id);
            $sql->bindParam(":art_id", $a);
            $sql->execute();
        }
        return $sql;
    }
    protected static function agregar_diligencia_modelo($exp_id, $diligencia)
    {
        foreach ($diligencia as $d) {
            if ($d != '') {
                $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_diligencias(exp_id, diligencia_descripcion) VALUES (:exp_id, :diligencia)");
                $sql->bindParam(":exp_id", $exp_id);
                $sql->bindParam(":diligencia", $d);
                $sql->execute();
            }
        }
        return $sql;
    }
    /* Modelo datos del usuario*/
    protected static function datos_expediente_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_exp te INNER JOIN tbl_bitacora_fechas tbf on te.exp_id=tbf.exp_id WHERE te.exp_id=:id");
            $sql->bindParam(":id", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel2::conectar()->prepare("SELECT exp_id FROM tbl_exp");
        }
        $sql->execute();
        return $sql;
    }
    //Actualizar gira modelo
    protected static function actualizar_expediente_modelo($datos)
    {
        $sql1 = mainModel2::conectar()->prepare("UPDATE tbl_exp SET nombre_denunciante=:nombre_denunciante,identidad_denunciante=:identidad_denunciante,genero_id=:genero,depto_id=:depto,municipio_id=:municipio,num_exp=:n_exp,nombre_investigado=:nombre_investigado,rango_id=:rango,tipo_falta_id=:tipo_falta,investigador_id=:investigador,fecha_inicio_exp=:fecha_inicio_exp,fecha_final_exp=:fecha_final_exp,fecha_inicio_i=:fecha_inicio_i,fecha_final_i_pre=:fecha_final_i_pre,fecha_final_i=:fecha_final_i,diligencia_exp=:diligencia,est_proceso_id=:estado,fecha_remision_s=:fecha_remision,observacion=:observacion WHERE exp_id=:exp_id");
        $sql1->bindParam(":nombre_denunciante", $datos['nombre_denunciante']);
        $sql1->bindParam(":identidad_denunciante", $datos['identidad_denunciante']);
        $sql1->bindParam(":genero", $datos['genero']);
        $sql1->bindParam(":depto", $datos['depto']);
        $sql1->bindParam(":municipio", $datos['municipio']);
        $sql1->bindParam(":n_exp", $datos['n_exp']);
        $sql1->bindParam(":nombre_investigado", $datos['nombre_investigado']);
        $sql1->bindParam(":rango", $datos['rango']);
        $sql1->bindParam(":tipo_falta", $datos['tipo_falta']);
        $sql1->bindParam(":investigador", $datos['investigador']);
        $sql1->bindParam(":fecha_inicio_exp", $datos['fecha_inicio_exp']);
        $sql1->bindParam(":fecha_final_exp", $datos['fecha_final_exp']);
        $sql1->bindParam(":fecha_inicio_i", $datos['fecha_inicio_i']);
        $sql1->bindParam(":fecha_final_i_pre", $datos['fecha_final_i_pre']);
        $sql1->bindParam(":fecha_final_i", $datos['fecha_final_i']);
        $sql1->bindParam(":diligencia", $datos['diligencia']);
        $sql1->bindParam(":estado", $datos['estado']);
        $sql1->bindParam(":fecha_remision", $datos['fecha_remision']);
        $sql1->bindParam(":observacion", $datos['observacion']);
        $sql1->bindParam(":exp_id", $datos['exp_id']);
        $sql1->bindParam(":folios", $datos['folios']);
        $sql1->bindParam(":recomen", $datos['recomen']);
        $sql1->bindParam(":num_dictan", $datos['num_dictan']);
        $sql1->bindParam(":num_arch", $datos['num_arch']);
        $sql1->execute();
        return $sql1;
    }
    //Agregar nuevos colaboradores
    protected static function agregar_nuevos_art_modelo($art_input, $art_values, $id_exp)
    {
        foreach ($art_input as $input_val) {
            if (!in_array($input_val, $art_values)) {
                $sql2 = mainModel2::conectar()->prepare("INSERT INTO tbl_exp_art ( exp_id, art_id) VALUES (:exp_id,:art_id)");
                $sql2->bindParam(":exp_id", $id_exp);
                $sql2->bindParam(":art_id", $input_val);
                $sql2->execute();
                /*$sql2->bindParam(":colaborador", $input_val);
                $sql2->bindParam(":id_salida", $id_salida);
                $sql2->execute();*/
            }
        }
    }
    //eliminar colaboradores
    protected static function eliminar_art_modelo($art_input, $art_values, $id_exp)
    {
        foreach ($art_values as $art_row) {
            if (!in_array($art_row, $art_input)) {
                $sql3 = mainModel2::conectar()->prepare("DELETE FROM tbl_exp_art WHERE exp_id=:id_exp AND art_id=:id_art");
                $sql3->bindParam(":id_exp", $id_exp);
                $sql3->bindParam(":id_art", $art_row);
                $sql3->execute();
            }
        }
    }
    protected static function eliminar_exp_modelo($id)
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
