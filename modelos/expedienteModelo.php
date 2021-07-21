<?php
require_once "mainModel2.php";
class expedienteModelo extends mainModel2
{
    /* Modelo agregar usuario*/
    protected static function agregar_proceso_denuncia_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_exp(nombre_denunciante, identidad_denunciante, genero_id, depto_id, municipio_id, num_exp, nombre_investigado, rango_id, tipo_falta_id, fecha_inicio_exp, fecha_final_exp, fecha_final_i_pre, fecha_final_i,est_proceso_id) VALUES (:nombre_denunciante,:identidad_denunciante,:genero,:depto,:municipio,:n_exp,:nombre_investigado,:rango,:tipo_falta,:fecha_inicio_exp,:fecha_final_exp,:fecha_final_i_pre,:fecha_final_i,:est_proceso_id)");
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
        $sql->bindParam(":est_proceso_id", $datos['est_proceso_id']);
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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();


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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

        $sql3 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql3->bindParam(":usu_id", $datos['usu_id']);
        $sql3->bindParam(":exp_id", $datos['exp_id']);
        $sql3->execute();
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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

        $sql3 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql3->bindParam(":usu_id", $datos['usu_id']);
        $sql3->bindParam(":exp_id", $datos['exp_id']);
        $sql3->execute();

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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

        $sql3= mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql3->bindParam(":usu_id", $datos['usu_id']);
        $sql3->bindParam(":exp_id", $datos['exp_id']);
        $sql3->execute();

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

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

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

         $sql3 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
         $sql3->bindParam(":usu_id", $datos['usu_id']);
         $sql3->bindParam(":exp_id", $datos['exp_id']);
         $sql3->execute();

         return $sql;
     }
      /* Modelo dictamen*/
    protected static function agregar_proceso_dictamen_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();
        

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

        return $sql;
    }
    /* Modelo devolucion*/
    protected static function agregar_proceso_devolucion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_devolucion=:fec_devolucion, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_devolucion", $datos['fec_devolucion']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

        return $sql;
    }
    /* Modelo entrega de dictamen*/
    protected static function agregar_proceso_entre_dictamen_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_entrega_dicta=:fec_entrega_dicta, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_entrega_dicta", $datos['fec_entrega_dicta']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

        return $sql;
    }
    /* Modelo entrega de dictamen*/
    protected static function agregar_proceso_remi_direccion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_remi_direccion=:fec_remi_direccion, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_remi_direccion", $datos['fec_remi_direccion']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();

        return $sql;
    }
    /* Modelo memorandum*/
    protected static function agregar_proceso_memorandum_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_bitacora_fechas SET fec_memorandum=:fec_memorandum, proceso_id=:proceso_id WHERE bitacora_id=:bitacora_id");
        $sql->bindParam(":fec_memorandum", $datos['fec_memorandum']);
        $sql->bindParam(":proceso_id", $datos['proceso_id']);
        $sql->bindParam(":bitacora_id", $datos['bitacora_id']);
        $sql->execute();

        $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp_usu SET usu_id=:usu_id WHERE exp_id=:exp_id");
        $sql2->bindParam(":usu_id", $datos['usu_id']);
        $sql2->bindParam(":exp_id", $datos['exp_id']);
        $sql2->execute();
        
        return $sql;
    }
    /* Modelo agregar */
    protected static function agregar_diligencia_pre_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_exp SET diligencia_pre=:diligencia_pre WHERE exp_id=:exp_id");
        $sql->bindParam(":diligencia_pre", $datos['diligencia_pre']);
        $sql->bindParam(":exp_id", $datos['exp_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo agregar diligencia invest*/
    protected static function agregar_diligencia_invest_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_exp SET diligencias_invest=:diligencias_invest WHERE exp_id=:exp_id");
        $sql->bindParam(":diligencias_invest", $datos['diligencias_invest']);
        $sql->bindParam(":exp_id", $datos['exp_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo agregar diligencia citacion*/
    protected static function agregar_diligencia_citacion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_exp SET diligencia_cita=:diligencia_cita WHERE exp_id=:exp_id");
        $sql->bindParam(":diligencia_cita", $datos['diligencia_cita']);
        $sql->bindParam(":exp_id", $datos['exp_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo agregar diligencia legal*/
    protected static function agregar_diligencia_legal_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("UPDATE tbl_exp SET diligencias_legal=:diligencias_legal WHERE exp_id=:exp_id");
        $sql->bindParam(":diligencias_legal", $datos['diligencias_legal']);
        $sql->bindParam(":exp_id", $datos['exp_id']);
        $sql->execute();
        return $sql;
    }
    /* Modelo crear interrupcion*/
    protected static function agregar_interrupcion_modelo($datos)
    {
        $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_interrupciones(exp_id,dias_interrupcion,observacion) VALUES (:exp_id,:dias_interrupcion,:observacion)");
        $sql->bindParam(":exp_id", $datos['exp_id']);
        $sql->bindParam(":dias_interrupcion", $datos['dias_interrupcion']);
        $sql->bindParam(":observacion", $datos['observacion']);
        $sql->execute();

       $sql2 = mainModel2::conectar()->prepare("UPDATE tbl_exp SET fecha_final_exp=:fecha_final_exp WHERE exp_id=:exp_id");
       $sql2->bindParam(":fecha_final_exp", $datos['fecha_final_exp']);
       $sql2->bindParam(":exp_id", $datos['exp_id']);
       $sql2->execute();
        
        return $sql2;
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
    protected static function agregar_exp_usu_modelo($exp_id, $usu_id)
    {
        $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_exp_usu(exp_id, usu_id) VALUES (:exp_id,:usu_id)");
        $sql->bindParam(":exp_id", $exp_id);
        $sql->bindParam(":usu_id", $usu_id);
        $sql->execute();
        return $sql;
    }
    protected static function agregar_exp_art_modelo($exp_id, $articulo)
    {
        foreach ($articulo as $a) {
            $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_exp_art (exp_id, art_id) VALUES (:exp_id,:art_id)");
            $sql->bindParam(":exp_id", $exp_id);
            $sql->bindParam(":art_id", $a);
            $sql->execute();
        }
        return $sql;
    }
    /* Modelo datos del exp*/
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
    //Actualizar exp 
    protected static function actualizar_expediente_modelo($datos)
    {
        $sql1 = mainModel2::conectar()->prepare("UPDATE tbl_exp SET nombre_denunciante=:nombre_denunciante,identidad_denunciante=:identidad_denunciante,genero_id=:genero_id,depto_id=:depto_id,municipio_id=:municipio_id,nombre_investigado=:nombre_investigado,rango_id=:rango_id,tipo_falta_id=:tipo_falta_id,investigador_id=:investigador_id,fecha_inicio_i=:fecha_inicio_i,diligencia_pre=:diligencia_pre,est_proceso_id=:est_proceso_id,observacion=:observacion,tecnico_legal=:tecnico_legal,comparecio=:comparecio,resolve_id=:resolve_id,num_resolve=:num_resolve,recomen_id=:recomen_id,diligencias_invest=:diligencias_invest,diligencias_legal=:diligencias_legal,folio=:folio,remision_mp_tsc=:remision_mp_tsc WHERE exp_id=:exp_id");
        $sql1->bindParam(":nombre_denunciante", $datos['nombre_denunciante']);
        $sql1->bindParam(":identidad_denunciante", $datos['identidad_denunciante']);
        $sql1->bindParam(":genero_id", $datos['genero_id']);
        $sql1->bindParam(":depto_id", $datos['depto_id']);
        $sql1->bindParam(":municipio_id", $datos['municipio_id']);
        $sql1->bindParam(":nombre_investigado", $datos['nombre_investigado']);
        $sql1->bindParam(":rango_id", $datos['rango_id']);
        $sql1->bindParam(":tipo_falta_id", $datos['tipo_falta_id']);
        $sql1->bindParam(":investigador_id", $datos['investigador_id']);
        $sql1->bindParam(":fecha_inicio_i", $datos['fecha_inicio_i']);
        $sql1->bindParam(":diligencia_pre", $datos['diligencia_pre']);
        $sql1->bindParam(":est_proceso_id", $datos['est_proceso_id']);
        $sql1->bindParam(":observacion", $datos['observacion']);
        $sql1->bindParam(":tecnico_legal", $datos['tecnico_legal']);
        $sql1->bindParam(":comparecio", $datos['comparecio']);
        $sql1->bindParam(":resolve_id", $datos['resolve_id']);
        $sql1->bindParam(":num_resolve", $datos['num_resolve']);
        $sql1->bindParam(":recomen_id", $datos['recomen_id']);
        $sql1->bindParam(":diligencias_invest", $datos['diligencias_invest']);
        $sql1->bindParam(":diligencias_legal", $datos['diligencias_legal']);
        $sql1->bindParam(":folio", $datos['folio']);
        $sql1->bindParam(":remision_mp_tsc", $datos['remision_mp_tsc']);
        $sql1->bindParam(":exp_id", $datos['exp_id']);
        $sql1->execute();
        return $sql1;
    }
    //Agregar nuevos colaboradores
    protected static function agregar_nuevos_art_modelo($art_input, $art_values, $id_exp)
    {
        foreach ($art_input as $input_val) {
            if (!in_array($input_val, $art_values)) {
                $sql2 = mainModel2::conectar()->prepare("INSERT INTO tbl_exp_art (exp_id, art_id) VALUES (:exp_id,:art_id)");
                $sql2->bindParam(":exp_id", $id_exp);
                $sql2->bindParam(":art_id", $input_val);
                $sql2->execute();
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
