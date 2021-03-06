<?php
if ($peticionAjax) {
    require_once "../modelos/expedienteModelo.php";
} else {
    require_once "./modelos/expedienteModelo.php";
}
class expedienteControlador extends expedienteModelo
{
    /* controlador agregar proceso de denuncia*/
    public function agregar_proceso_denuncia_controlador()
    {
        //datos del denunciante
        $nombreD =  strtoupper(mainModel2::limpiar_cadena($_POST['nom_d_reg']));
        $identidadD = mainModel2::limpiar_cadena($_POST['identidad_d_reg']);
        $sexoD = mainModel2::limpiar_cadena($_POST['sexo_d_reg']);

        $municipioD = mainModel2::limpiar_cadena($_POST['municipio_d_reg']);
        //datos del investigado y expediente
        $nExp =  strtoupper(mainModel2::limpiar_cadena($_POST['n_exp_reg']));
        $fecInicioExp = $_POST['fec_i_exp_reg'];
        $nombreI =  strtoupper(mainModel2::limpiar_cadena($_POST['nom_i_reg']));
        $identidadI= mainModel2::limpiar_cadena($_POST['identidad_i_reg']);
        $edad = mainModel2::limpiar_cadena($_POST['edad_i_reg']);
        $sexoI = mainModel2::limpiar_cadena($_POST['sexo_i_reg']);
        $grado = mainModel2::limpiar_cadena($_POST['grado_reg']);
        $lugarAsig =  strtoupper(mainModel2::limpiar_cadena($_POST['lugar_asig_reg']));
        $municipioI = mainModel2::limpiar_cadena($_POST['municipio_i_reg']);
        $municipioDen = mainModel2::limpiar_cadena($_POST['municipio_den_reg']);
        $tipoFalta = mainModel2::limpiar_cadena($_POST['tipo_falta_reg']);
        $articulo = $_POST['articulos_reg'];
        $tipoIngreso = mainModel2::limpiar_cadena($_POST['tipo_ingreso_reg']);
        $hechos =  strtoupper(mainModel2::limpiar_cadena($_POST['hechos_reg']));
        $procesoId = 1;
        $estado = 1;
        /*comprobar campos vacios*/
        if ($sexoD == "" ||  $municipioD == "" ||  $nExp == "" ||  $fecInicioExp == "" || $nombreI == ""  ||   $identidadI == "" ||   $sexoI == "" ||   $grado == ""  ||  $municipioI == ""  ||    $tipoFalta == "" ||  $tipoIngreso == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($nombreD != '') {
            if (mainModel2::verificar_datos("[A-Z???????????????????????? ]{3,255}", $nombreD)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                    "Texto" => "EL CAMPO NOMBRE DEL DENUNCIANTE SOLO DEBE INCLUIR LETRAS",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($nombreI != '') {
            if (mainModel2::verificar_datos("[A-Z???????????????????????? ]{3,255}", $nombreI)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                    "Texto" => "EL CAMPO NOMBRE DEL INVESTIGADO SOLO DEBE INCLUIR LETRAS",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($identidadD != '') {
            if (mainModel2::verificar_datos("[0-9]{13}", $identidadD)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                    "Texto" => "EL N??MERO DE IDENTIDAD DEL DENUNCIANTE NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if (mainModel2::verificar_datos("[0-9]{13}", $identidadI)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL N??MERO DE IDENTIDAD DEL INVESTIGADO NO COINCIDE CON EL FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

       
        if (mainModel2::verificar_datos("[0-9-]{15}", $nExp)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL NUMERO DE EXPEDIENTE NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 15 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $nExp = "DPL-" . $nExp;
        //VALIDAR QUE NO EXISTA OTRO EXPEDIENTE
        /*validar DNI*/
        $check_exp = mainModel2::ejecutar_consulta_simple("SELECT num_exp FROM tbl_exp WHERE num_exp='$nExp'");
        if ($check_exp->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL EXPEDIENTE YA EST?? REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta = "SELECT * FROM tbl_feriados ORDER BY fecha ASC";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            array_push($feriados, $rows['fecha']);
        }
        $fecFinalIPre = mainModel2::addWorkingDays($fecInicioExp, 9, $feriados);
        $fecFinalI = mainModel2::addWorkingDays($fecInicioExp, 39, $feriados);
        $fecFinalExp = mainModel2::addWorkingDays($fecInicioExp, 74, $feriados);


        $datosExpedienteReg = [
            //Datos denunciante
            'municipioD' => $municipioD,
            'generoD' => $sexoD,
            'nombre_denunciante' => $nombreD,
            'identidad_denunciante' => $identidadD,
            //Datos Investigado
            'municipioI' => $municipioI,
            'generoI' => $sexoI,
            'grado' => $grado,
            'nombre_investigado' => $nombreI,
            'identidad_investigado' => $identidadI,
            'EdadI' => $edad,
            'lugarAsignacion' => $lugarAsig,
            //Datos Expediente
            'n_exp' => $nExp,
            'tipo_falta' => $tipoFalta,
            'tipoIngreso' => $tipoIngreso,
            'fecha_inicio_exp' => $fecInicioExp,
            'fecha_final_exp' => $fecFinalExp,
            'fecha_final_i_pre' => $fecFinalIPre,
            'fecha_final_i' => $fecFinalI,
            'est_proceso_id' => $estado,
            'municipioDen' => $municipioDen,
            'hechos'=>$hechos
        ];

        $agregarExpediente =  expedienteModelo::agregar_proceso_denuncia_modelo($datosExpedienteReg);
        // CAPTURAMOS EL VALOR DE EL ULTIMO REGISTRO DE LA TABLA EXPEDIENTES
        $consultarId = mainModel2::ejecutar_consulta_simple("SELECT exp_id FROM tbl_exp ORDER BY exp_id DESC LIMIT 1");
        if ($consultarId->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "ERROR EN LA CONSULTA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultarId->fetch();
        }
        $expId = $campos['exp_id'];
        //insertamos los articulos en su respectiva tabla
        session_start();
        $agregarArticulos = expedienteModelo::agregar_exp_art_modelo($expId, $articulo);
        $agregarExpUsu = expedienteModelo::agregar_exp_usu_modelo($expId, $_SESSION['id_spm']);
        $agregarBit =  expedienteModelo::agregar_bit_fec_cono_modelo($expId, $fecInicioExp, $procesoId);
        if ($agregarExpediente->rowCount() == 1 && $agregarArticulos && $agregarBit && $agregarExpUsu) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "EXPEDIENTE REGISTRADO",
                "Texto" => "LOS DATOS DEL EXPEDIENTE SE HAN REGISTRADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de emision*/
    public function agregar_proceso_emision_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id']);
        $fec_emision = $_POST['fec_emision'];
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $proceso_id = 2;
        // CAPTURAMOS EL VALOR USUARIO JEFE DE INVESTIGACION
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=4");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        //insertamos los articulos en su respectiva tabla
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_emision" => $fec_emision,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_emision_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE EMITIDO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE EMITI?? EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de admision*/
    public function agregar_proceso_admision_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_3']);
        $fec_admision = $_POST['fec_admitir'];
        $proceso_id = 3;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        session_start();
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_admision" => $fec_admision,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $_SESSION['id_spm']
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_admision_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE ADMITIDO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ADMITI?? EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de asignacion de expediente a investigador*/
    public function agregar_proceso_asig_i_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_4']);
        $fec_asig = $_POST['fec_asignar_inves'];
        $investigador = mainModel2::limpiar_cadena($_POST['investigador']);
        $proceso_id = 4;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        /*comprobar campos vacios*/
        if ($investigador == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, POR FAVOR SELECCIONE INVESTIGADOR",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        session_start();
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_asignacion" => $fec_asig,
            "investigador_id" => $investigador,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $investigador
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_asig_i_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA ASIGNADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ASIGNAR EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */

    /* controlador agregar proceso de emision direccion*/
    public function agregar_proceso_emision_direccion_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_5']);
        $fec_emitir_i = $_POST['fec_emitir_invest'];
        $proceso_id = 5;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO JEFE DE INVESTIGACION
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=7");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_emision_invest" => $fec_emitir_i,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_emision_direccion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE EMITIDO  CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE EMITI?? EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de auto apertura*/
    public function agregar_proceso_apertura_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_6']);
        $fec_apertura = $_POST['fec_apertura'];
        $proceso_id = 6;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO JEFE DE INVESTIGACION
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=8");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_act_apertura" => $fec_apertura,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_apertura_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA AUTO APERTURADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE AUTO APERTURADO EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de comunicacion*/
    public function agregar_proceso_comunicacion_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_7']);
        $fec_comunicacion = $_POST['fec_comunicacion'];
        $proceso_id = 7;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO QUE LLEVA LA INVESTIGACION
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT investigador_id FROM tbl_exp WHERE exp_id = $exp_id");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['investigador_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_comunicacion" => $fec_comunicacion,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_comunicacion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA COMUNICADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE COMUNICADO EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de comunicacion*/
    public function agregar_proceso_recep_invest_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_8']);
        $fec_recep_invest = $_POST['fec_recep_investigacion'];
        $proceso_id = 8;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        session_start();
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_recep_invest" => $fec_recep_invest,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $_SESSION['id_spm']
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_recep_invest_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA RECEPCIONADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE RECEPCIONADO EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de estado de procesos*/
    // ROL INVESTIGADOR
    public function agregar_proceso_estado_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_9']);
        $fec_estado = $_POST['fec_est_proceso'];
        $est_proceso_id = mainModel2::limpiar_cadena($_POST['est_proceso_id']);
        $est_penal_id = mainModel2::limpiar_cadena($_POST['est_penal_id']);
        if ($est_proceso_id==6) {
            $proceso_id = 19;
        } else {
            $proceso_id = 9;
        }
        
       
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        /*comprobar campos vacios*/
        if ($est_proceso_id == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, POR FAVOR SELECCIONE UN ESTADO PROCESO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*comprobar campos vacios*/
        if ($est_penal_id == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, POR FAVOR SELECCIONE UN ESTADO PENAL",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        // CAPTURAMOS EL VALOR USUARIO 
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=7");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_infor_cierre" => $fec_estado,
            "proceso_id" => $proceso_id,
            "est_proceso_id" => $est_proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id,
            "est_penal_id" => $est_penal_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_estado_modelo($datos_proc_up);
        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA CAMBIADO EL ESTADO DEL PROCESO DEL EXPEDIENTE CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO HA SE CAMBIADO EL ESTADO DEL PROCESO DEL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de validacion direccion*/
    // ROL DIRECTOR
    public function agregar_proceso_validacion_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_10']);
        $fec_val_dirreccion = $_POST['fec_validacion'];
        $proceso_id = 10;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO SECRETARIA
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=8");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_val_dirreccion" => $fec_val_dirreccion,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_validacion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA VALIDADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE VALIDADO EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de recepcion secretaria*/
    public function agregar_proceso_recep_secretaria_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_11']);
        $fec_remision_secretaria = $_POST['fec_recep_secretaria'];
        $proceso_id = 11;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        session_start();
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_recep_secretaria" => $fec_remision_secretaria,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $_SESSION['id_spm']
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_recep_secretaria_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA RECEPCIONADO A SECRETARIA CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA RECEPCIONADO A SECRETARIA EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de citacion*/
    // ROL SECRETARIA
    public function agregar_proceso_citacion_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_12']);
        $fecha_citacion = $_POST['fec_citacion'];
        $fecha_aud_desc = $_POST['fecha_aud_desc'];
        $proceso_id = 12;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        /*comprobar campos vacios*/
        if ($fecha_citacion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, POR FAVOR INGRESE LA FECHA DE CITACI??N",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta = "SELECT * FROM tbl_feriados ORDER BY fecha ASC";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            array_push($feriados, $rows['fecha']);
        }

        $fecha_dias_tec_legal = mainModel2::addWorkingDays($fecha_aud_desc, 2, $feriados);
        session_start();
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fecha_citacion" => $fecha_citacion,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "fecha_dias_tec_legal" => $fecha_dias_tec_legal,
            "fecha_aud_desc" => $fecha_aud_desc,
            "usu_id" => $_SESSION['id_spm']
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_citacion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA AGREGADO LA FECHA DE LA AUDIENCIA CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA AGREGADO LA FECHA DE LA AUDIENCIA",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de recepcion legal*/
    // ROL SECRETARIA
    public function agregar_proceso_remi_legal_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_13']);
        $fec_remision_secretaria = $_POST['fec_remi_legal'];
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $proceso_id = 13;
        // CAPTURAMOS EL VALOR USUARIO JEFE DE LEGAL
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=5");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_remision_secretaria" => $fec_remision_secretaria,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_remi_legal_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA ENVIADO A LEGAL CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA ENVIADO A LEGAL EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de asignacion de expediente a tecnico legal*/
    public function agregar_proceso_asig_l_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_14']);
        $fec_asigna_legal = $_POST['fec_asigna_legal'];
        $tecnico_legal = mainModel2::limpiar_cadena($_POST['tecnico_id']);
        $proceso_id = 14;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        /*comprobar campos vacios*/
        if ($tecnico_legal == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, POR FAVOR SELECCIONE T??CNICO LEGAL",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        session_start();
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_asigna_legal" => $fec_asigna_legal,
            "tecnico_legal" => $tecnico_legal,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $tecnico_legal
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_asig_l_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA ASIGNADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ASIGNAR EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de dictamen*/
    public function agregar_proceso_dictamen_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_15']);
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $proceso_id = 15;
        // CAPTURAMOS EL VALOR USUARIO JEFE DE LEGAL
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=5");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_dictamen_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA ENTREGADO EL DICTAMEN CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA ENTREGADO EL DICTAMEN",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar proceso devolucion*/
    public function agregar_proceso_devolucion_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_16']);
        $fec_devolucion = $_POST['fec_devolucion'];
        $proceso_id = 16;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO QUE LLEVA LA INVESTIGACION
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT tecnico_legal FROM tbl_exp WHERE exp_id = $exp_id");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['tecnico_legal'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_devolucion" => $fec_devolucion,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_devolucion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE SE HA DEVUELTO A T??CNICO LEGAL CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA DEVUELTO EL EXPEDIENTE A T??CNICO LEGAL",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar proceso de entrega de dictamen*/
    public function agregar_proceso_entre_dictamen_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_17']);
        $fec_entrega_dictamen = $_POST['fec_entrega_dictamen'];
        $proceso_id = 17;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO JEFE DE INVESTIGACION
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=5");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_entrega_dicta" => $fec_entrega_dictamen,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_entre_dictamen_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA ENTREGADO EL DICTAMEN CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA ENTREGADO EL DICTAMEN",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar proceso de remision a direccion*/
    public function agregar_proceso_remi_direccion_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_18']);
        $fec_remi_direccion = $_POST['fec_remi_direccion'];
        $proceso_id = 18;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO JEFE DE LEGAL
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=7");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_remi_direccion" => $fec_remi_direccion,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_remi_direccion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA ENTREGADO A DIRECCION CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA ENTREGADO A DIRECCION",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar proceso de remision a direccion*/
    public function agregar_proceso_memorandum_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_19']);
        $fec_memorandum = $_POST['fec_memorandum'];
        $proceso_id = 19;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        session_start();
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_memorandum" => $fec_memorandum,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $_SESSION['id_spm']
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_memorandum_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA REALIZADO EL MEMORANDUM CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA REALIZADO EL MEMORANDUM A DIRECCI??N",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar proceso de remision a direccion*/
    public function agregar_proceso_remi_direccion_d_controlador()
    {
        $bit_id = mainModel2::limpiar_cadena($_POST['bit_id_40']);
        $fec_remi_direccion = $_POST['fec_remi_direccion'];
        $proceso_id = 18;
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        // CAPTURAMOS EL VALOR USUARIO JEFE DE LEGAL
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT usu_id FROM tbl_usuarios WHERE rol_id=7");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO USUARIO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }

        $usu_id = $campos['usu_id'];
        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $datos_proc_up = [
            "bitacora_id" => $bit_id,
            "fec_remi_direccion" => $fec_remi_direccion,
            "proceso_id" => $proceso_id,
            "exp_id" => $exp_id,
            "usu_id" => $usu_id
        ];

        $agregar_proc = expedienteModelo::agregar_proceso_remi_direccion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA ENTREGADO A DIRECCION CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA ENTREGADO A DIRECCION",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar proceso de remision a direccion*/
    public function agregar_interrupcion_controlador()
    {
        $fecha_fa = $_POST['fecha_final_exp_up'];
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $dias_interrup = $_POST['diasInterrup'];
        $observacion = strtoupper(mainModel2::limpiar_cadena($_POST['observacion']));
        /*comprobar campos vacios*/
        if ($dias_interrup == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VAC??O, POR FAVOR INGRESE LOS D??AS DE INTERRUPCI??N",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta = "SELECT * FROM tbl_feriados ORDER BY fecha ASC";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            array_push($feriados, $rows['fecha']);
        }

        // INSERTAMOS LOS DATOS EN SUS RESPECTIVAS TABLAS
        $fecha_final_exp = mainModel2::addWorkingDays($fecha_fa, $dias_interrup, $feriados);
        $datos_proc_up = [
            "exp_id" => $exp_id,
            "dias_interrupcion" => $dias_interrup,
            "observacion" => $observacion,
            "fecha_final_exp" => $fecha_final_exp
        ];

        $agregar_proc = expedienteModelo::agregar_interrupcion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA AGREGADO LA INTERRUPCI??N CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA AGREGADO LA INTERRUPCI??N ",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar diligencia preliminar*/
    public function agregar_diligencia_pre_controlador()
    {
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $diligencia_pre = strtoupper(mainModel2::limpiar_cadena($_POST['diligencia_pre']));

        /*comprobar campos vacios*/
        if ($diligencia_pre == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, INGRESE DILIGENCIAS PRELIMINARES PORFAVOR",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-Z????????????????????????0-9-#,. ]{3,200}", $diligencia_pre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL CAMPO DESCRIPCI??N SOLO PUEDE INCLUIR LETRAS, NUMEROS, COMAS Y GUIONES ",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proc_up = [
            "exp_id" => $exp_id,
            "diligencia_pre" => $diligencia_pre
        ];

        $agregar_proc = expedienteModelo::agregar_diligencia_pre_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA AGREGADO LAS DILIGENCIAS PRELIMINARES CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA AGREGADO LAS DILIGENCIAS PRELIMINARES",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar diligencia investigacion*/
    public function agregar_diligencia_invest_controlador()
    {
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $diligencias_invest = strtoupper(mainModel2::limpiar_cadena($_POST['diligencias_invest']));

        /*comprobar campos vacios*/
        if ($diligencias_invest == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, INGRESE DILIGENCIAS INVESTIGATIVAS PORFAVOR",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-Z????????????????????????0-9-#,. ]{3,200}", $diligencias_invest)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL CAMPO DESCRIPCI??N SOLO PUEDE INCLUIR LETRAS, NUMEROS, COMAS Y GUIONES ",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proc_up = [
            "exp_id" => $exp_id,
            "diligencias_invest" => $diligencias_invest
        ];

        $agregar_proc = expedienteModelo::agregar_diligencia_invest_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA AGREGADO LAS DILIGENCIAS INVESTIGATIVAS CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA AGREGADO LAS DILIGENCIAS INVESTIGATIVAS",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar diligencia citacion*/
    public function agregar_diligencia_citacion_controlador()
    {
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $diligencia_cita = strtoupper(mainModel2::limpiar_cadena($_POST['diligencia_cita']));

        /*comprobar campos vacios*/
        if ($diligencia_cita == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, INGRESE DILIGENCIAS DE CITACI??N PORFAVOR",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-Z????????????????????????0-9-#,. ]{3,200}", $diligencia_cita)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL CAMPO DESCRIPCI??N SOLO PUEDE INCLUIR LETRAS, NUMEROS, COMAS Y GUIONES ",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proc_up = [
            "exp_id" => $exp_id,
            "diligencia_cita" => $diligencia_cita
        ];

        $agregar_proc = expedienteModelo::agregar_diligencia_citacion_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA AGREGADO LAS DILIGENCIAS DE CITACI??N CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA AGREGADO LAS DILIGENCIAS DE CITACI??N",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /*controlador agregar diligencia legal*/
    public function agregar_diligencia_legal_controlador()
    {
        $exp_id = mainModel2::limpiar_cadena($_POST['exp_id']);
        $diligencias_legal = strtoupper(mainModel2::limpiar_cadena($_POST['diligencias_legal']));

        /*comprobar campos vacios*/
        if ($diligencias_legal == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, INGRESE DILIGENCIAS DE LEGAL PORFAVOR",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-Z????????????????????????0-9-#,. ]{3,200}", $diligencias_legal)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL CAMPO DESCRIPCI??N SOLO PUEDE INCLUIR LETRAS, NUMEROS, COMAS Y GUIONES ",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proc_up = [
            "exp_id" => $exp_id,
            "diligencias_legal" => $diligencias_legal
        ];

        $agregar_proc = expedienteModelo::agregar_diligencia_legal_modelo($datos_proc_up);

        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "SE HA AGREGADO LAS DILIGENCIAS DE LEGAL CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA AGREGADO LAS DILIGENCIAS DE LEGAL",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador para listar expedientes*/
    public function listar_exp_controlador()
    {
        $tabla = '';
        $consulta = "SELECT * FROM tbl_exp_usuario teu INNER JOIN tbl_exp te ON teu.exp_id=te.exp_id INNER JOIN tbl_usuarios tu  ON teu.usuario_id=tu.usuario_id WHERE teu.usuario_id= $_SESSION[id_spm]";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta2 = "SELECT * FROM tbl_feriados ORDER BY fecha ASC";
        $conexion = mainModel2::conectar();
        $datos2 = $conexion->query($consulta2);
        $datos2 = $datos2->fetchAll();
        foreach ($datos2 as $rows2) {
            array_push($feriados, $rows2['fecha']);
        }


        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-exp-investigacion/" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Expediente
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered">

            <thead style="vertical-align:middle;">
                <tr>
                <th style="vertical-align:middle;">N?? EXPEDIENTE</th>
    
                <th style="vertical-align:middle;">FECHA CONOCIMIENTO DIDADPOL</th>
                <th style="vertical-align:middle;">FECHA FINAL EXPEDIENTE </th>
                <th style="vertical-align:middle;">VIGENCIA DEL EXPEDIENTE </th>
                <th style="vertical-align:middle;">VIGENCIA PROCESO INVESTIGACION </th>
                <th style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $dias = mainModel2::getWorkingDays(date('Y-m-d'), $rows['fec_final_exp'], $feriados);
            $dias2 = mainModel2::getWorkingDays(date('Y-m-d'), $rows['fec_final_invest'], $feriados);

            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';



            $tabla .= ' 
                
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fec_inicio_exp'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fec_final_exp'])) . '</td>';

            if ($dias >= 60) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-success">';
                $dias = $dias . ' D??AS';
            } elseif ($dias >= 40 && $dias <= 59) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-warning">';
                $dias = $dias . ' D??AS';
            } elseif ($dias >= 1 && $dias <= 39) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                $dias = $dias . ' D??AS';
            } elseif ($dias2 <= 0) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                $dias = 'PLAZO TERMINADO';
            }

            $tabla .= '<span class="badge badge badge-dark">' . $dias . '</span></td>';

            if ($dias2 >= 21) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-success">';
                $dias2 = $dias2 . ' D??AS';
            } elseif ($dias2 >= 6 && $dias2 <= 20) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-warning">';
                $dias2 = $dias2 . ' D??AS';
            } elseif ($dias2 >= 1 && $dias2 <= 5) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                $dias2 = $dias2 . ' D??AS';
            } elseif ($dias2 <= 0) {

                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-secondary">';
                $dias2 = 'PLAZO TERMINADO';
            }
            $tabla .= '<span class="badge badge badge-dark">' . $dias2 . '</span></td>
                ';



            $tabla .= '  <td>
                <div class="row">
                <a href="' . SERVERURL . 'ver-info-exp/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-dark btn-sm" title="Ver informaci??n completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>
                    <a href="' . SERVERURL . 'actualizar-exp-i/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </td> 
            </tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
    /* Controlador datos del expediente*/
    public  function datos_expediente_controlador($tipo, $id)
    {
        $tipo = mainModel2::limpiar_cadena($tipo);
        $id = mainModel2::decryption($id);
        $id = mainModel2::limpiar_cadena($id);

        return expedienteModelo::datos_expediente_modelo($tipo, $id);
    }/* fin controlador datos del expediente */
    /* Controlador actualizar giras*/
    public function actualizar_expediente_controlador()
    {
        //Recibiendo el id 
        $id_exp = mainModel2::decryption($_POST['exp_id_up']);
        $id_exp = mainModel2::limpiar_cadena($id_exp);

        //comprobar si existe salida en el sistema
        $check_exp = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_exp WHERE exp_id=$id_exp");
        if ($check_exp->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO HEMOS ENCONTRADO EL EXPEDIENTE EN EL SISTEMA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_exp->fetch();
        }


        $nombre_d = strtoupper(mainModel2::limpiar_cadena($_POST['nombre_d_up']));
        $identidad_d = mainModel2::limpiar_cadena($_POST['identidad_d_up']);
        $sexo = mainModel2::limpiar_cadena($_POST['genero_up']);
        $depto = mainModel2::limpiar_cadena($_POST['depto_up']);
        $municipio = mainModel2::limpiar_cadena($_POST['municipio_up']);
        $diligencia_pre = mainModel2::limpiar_cadena(strtoupper($_POST['diligencia_pre_up']));
        $investigador = mainModel2::limpiar_cadena($_POST['investigador_up']);
        $fecha_inicio_i = $_POST['fecha_inicio_i_up'];
        $diligencias_invest = mainModel2::limpiar_cadena(strtoupper($_POST['diligencias_invest_up']));
        $legal_id = strtoupper(mainModel2::limpiar_cadena($_POST['tec_legal_up']));
        $diligencia_legal = mainModel2::limpiar_cadena(strtoupper($_POST['diligencias_legal_up']));
        $resolucion = mainModel2::limpiar_cadena($_POST['resolucion_up']);
        $n_doc = strtoupper(mainModel2::limpiar_cadena($_POST['num_resolve_up']));
        $recomendacion = strtoupper(mainModel2::limpiar_cadena($_POST['recomen_up']));
        $folios = strtoupper(mainModel2::limpiar_cadena($_POST['folios_up']));
        $observacion = strtoupper(mainModel2::limpiar_cadena($_POST['observacion_up']));
        $investigado = mainModel2::limpiar_cadena(strtoupper($_POST['investigado_up']));
        $rango = mainModel2::limpiar_cadena($_POST['rango_up']);
        $tipo_falta = mainModel2::limpiar_cadena($_POST['tipo_falta_up']);
        $art_input = $_POST['articulos_up'];
        $estado = mainModel2::limpiar_cadena($_POST['estado_up']);
        $comparecio = mainModel2::limpiar_cadena($_POST['comparecio_up']);
        $remi_mp_tsc_up = mainModel2::limpiar_cadena($_POST['remi_mp_tsc_up']);

        //comprobar campos vacios
        if (
            $municipio == "" ||  $depto == "" ||  $sexo == "" ||  
            $rango == ""  || $tipo_falta == "" || $investigador == "" ||
            $estado == "" || $observacion == "" || 
             $recomendacion == "" ||  $legal_id == ""  || $resolucion == ""   
        ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*comprobar campos vacios
        if (
            $municipio == "" ||  $depto == "" ||  $sexo == "" ||  $investigado == "" ||
            $rango == ""  || $tipo_falta == "" || $investigador == "" || $fecha_inicio_i == "" ||
            $diligencia_pre == "" || $diligencias_invest == "" || $diligencia_legal == "" || $estado == "" || $observacion == "" || $art_input == "" ||
            $folios == "" || $recomendacion == "" ||  $legal_id == ""  || $diligencia_pre == "" || $resolucion == "" || $n_doc == ""  
        ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }*/


        if ($nombre_d != '') {
            if (mainModel2::verificar_datos("[A-Z???????????????????????? ]{3,255}", $nombre_d)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                    "Texto" => "EL CAMPO NOMBRE DEL DENUNCIANTE SOLO DEBE INCLUIR LETRAS Y NUMEROS",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($identidad_d != '') {
            if (mainModel2::verificar_datos("[0-9]{13}", $identidad_d)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                    "Texto" => "EL DNI DEL DENUNCIANTE NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }


        if (mainModel2::verificar_datos("[A-Z???????????????????????? ]{3,255}", $investigado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE DEL DENUNCIANTE SOLO DEBE INCLUIR LETRAS Y NUMEROS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $check_exp_art = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_exp_art WHERE exp_id=$id_exp");
        if ($check_exp_art->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO HEMOS ENCONTRADO EL DATOS EN EL SISTEMA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            //para almacenar los datos de la tabla intermedia usuarios salida
            $campos = $check_exp_art->fetchAll();
        }
        $art_values = [];
        foreach ($campos as $art_data) {
            $art_values[] = $art_data['art_id'];
        }

        $datos_expediente_up = [
            "nombre_denunciante" => $nombre_d,
            "identidad_denunciante" => $identidad_d,
            "genero_id" => $sexo,
            "depto_id" => $depto,
            "municipio_id" => $municipio,
            "nombre_investigado" => $investigado,
            "rango_id" => $rango,
            "tipo_falta_id" => $tipo_falta,
            "investigador_id" => $investigador,
            "fecha_inicio_i" => $fecha_inicio_i,
            "diligencia_pre" => $diligencia_pre,
            "est_proceso_id" => $estado,
            "observacion" => $observacion,
            "tecnico_legal" => $legal_id,
            "comparecio" => $comparecio,
            "resolve_id" => $resolucion,
            "num_resolve" => $n_doc,
            "recomen_id" => $recomendacion,
            "diligencias_invest" => $diligencias_invest,
            "diligencias_legal" => $diligencia_legal,
            "folio" => $folios,
            "remision_mp_tsc" => $remi_mp_tsc_up,
            "exp_id" => $id_exp
        ];

        $actualizar_exp =  expedienteModelo::actualizar_expediente_modelo($datos_expediente_up);
        //Para insertar datos recien agregados
        $insert_nuevos_art =  expedienteModelo::agregar_nuevos_art_modelo($art_input, $art_values, $id_exp);
        //Para eliminar colaboradores
        $eliminar_art = expedienteModelo::eliminar_art_modelo($art_input, $art_values, $id_exp);

        if ($actualizar_exp) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "EXPEDIENTE ACTUALIZADO",
                "Texto" => "LOS DATOS DEL EXPEDIENTE SE HAN ACTUALIZADO CON ??XITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRI?? UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ACTUALIZAR EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}
