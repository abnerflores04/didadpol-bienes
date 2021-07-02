<?php
if ($peticionAjax) {
    require_once "../modelos/expedienteModelo.php";
} else {
    require_once "./modelos/expedienteModelo.php";
}
class expedienteControlador extends expedienteModelo
{
    /* controlador agregar expediente*/
    public function agregar_expediente_controlador()
    {
        $n_exp = mainModel2::limpiar_cadena($_POST['n_exp_reg']);
        $nombre_d= strtoupper(mainModel2::limpiar_cadena($_POST['nombre_d_reg']));
        $identidad_d= mainModel2::limpiar_cadena($_POST['identidad_d_reg']);
        $sexo= mainModel2::limpiar_cadena($_POST['genero_reg']);
        $depto= mainModel2::limpiar_cadena($_POST['depto_reg']);
        $municipio= mainModel2::limpiar_cadena($_POST['municipio_reg']);
        $investigado = mainModel2::limpiar_cadena(strtoupper($_POST['investigado']));
        $rango = mainModel2::limpiar_cadena($_POST['rango_id_reg']);
        $tipo_falta = mainModel2::limpiar_cadena($_POST['tipo_falta_reg']);
        $investigador = mainModel2::limpiar_cadena($_POST['investigador_reg']);
        $fecha_inicio_exp = $_POST['fecha_inicio_exp_reg'];
        $fecha_inicio_i = '';
        $diligencia = mainModel2::limpiar_cadena(strtoupper($_POST['diligencia']));
        $estado = mainModel2::limpiar_cadena($_POST['estado_reg']);
        $fecha_remision = '';
        $observacion = strtoupper(mainModel2::limpiar_cadena($_POST['observacion']));
        $articulo=$_POST['articulos_reg'];
        /*comprobar campos vacios*/
        if ($n_exp == "" ||  $municipio == "" ||  $depto == ""||  $sexo == ""||  $investigado == "" || $rango == ""  ||   $fecha_inicio_exp == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($nombre_d != '') {
            if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑÜ ]{3,255}", $nombre_d)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
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
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL DNI DEL DENUNCIANTE NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /*validar DNI*/
        $check_identidad = mainModel2::ejecutar_consulta_simple("SELECT identidad_denunciante FROM tbl_exp WHERE 	identidad_denunciante='$identidad_d'");
        if ($check_identidad->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "LA IDENTIDAD DEL DENUNCIANTE YA ESTÁ REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑÜ ]{3,255}", $investigado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE DEL DENUNCIANTE SOLO DEBE INCLUIR LETRAS Y NUMEROS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{15}", $n_exp)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NUMERO DE EXPEDIENTE NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 15 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $n_exp = "DPL-" . $n_exp;
        //VALIDAR QUE NO EXISTA OTRO EXPEDIENTE
        /*validar DNI*/
        $check_exp = mainModel2::ejecutar_consulta_simple("SELECT num_exp FROM tbl_exp WHERE num_exp='$n_exp'");
        if ($check_exp->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL EXPEDIENTE YA ESTÁ REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta = "SELECT * FROM tbl_feriado ORDER BY feriado_fecha ASC";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            array_push($feriados, $rows['feriado_fecha']);
        }
        //se hace el calculo respecto al fecha de reconocimiento didapol
        //$fecha_final_i_pre = mainModel2::addWorkingDays($fecha_inicio_exp,9,$feriados);
        //$fecha_final_i = mainModel2::addWorkingDays($fecha_inicio_exp,39,$feriados);
        $fecha_final_i_pre = mainModel2::addWorkingDays($fecha_inicio_exp, 9, $feriados);
        $fecha_final_i = mainModel2::addWorkingDays($fecha_inicio_exp, 39, $feriados);
        $fecha_final_exp = mainModel2::addWorkingDays($fecha_inicio_exp, 74, $feriados);


        $datos_expediente_reg = [
            "nombre_denunciante"=>$nombre_d,
            "identidad_denunciante"=>$identidad_d,
            "genero"=>$sexo,
            "depto"=>$depto,
            "municipio"=>$municipio,
            "n_exp" => $n_exp,
            "nombre_investigado"=>$investigado,
            "rango" => $rango,
            "tipo_falta" => $tipo_falta,
            "investigador" => $investigador,
            "fecha_inicio_exp" => $fecha_inicio_exp,
            "fecha_final_exp" => $fecha_final_exp,
            "fecha_inicio_i" => $fecha_inicio_i,
            "fecha_final_i_pre" => $fecha_final_i_pre,
            "fecha_final_i" => $fecha_final_i,
            "diligencia" => $diligencia,
            "estado" => $estado,
            "fecha_remision" => $fecha_remision,
            "observacion" => $observacion

        ];

        $agregar_expediente =  expedienteModelo::agregar_proceso_denuncia_modelo($datos_expediente_reg);
        // CAPTURAMOS EL VALOR DE EL ULTIMO REGISTRO DE LA TABLA EXPEDIENTES
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT exp_id FROM tbl_exp ORDER BY exp_id DESC LIMIT 1");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "ERROR EN LA CONSULTA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }
        $exp_id = $campos['exp_id'];

        //insertamos los articulos en su respectiva tabla
        $agregar_articulos= expedienteModelo::agregar_exp_art_modelo($exp_id, $articulo);
        
        if ($agregar_expediente->rowCount() == 1 && $agregar_articulos) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "EXPEDIENTE REGISTRADO",
                "Texto" => "LOS DATOS DEL EXPEDIENTE SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        /**************************** */
    }/*fin controlador */
    /* controlador agregar proceso de denuncia*/
    public function agregar_proceso_denuncia_controlador()
    {
        $n_exp = mainModel2::limpiar_cadena($_POST['n_exp_reg']);
        $nombre_d= strtoupper(mainModel2::limpiar_cadena($_POST['nombre_d_reg']));
        $identidad_d= mainModel2::limpiar_cadena($_POST['identidad_d_reg']);
        $sexo= mainModel2::limpiar_cadena($_POST['genero_reg']);
        $depto= mainModel2::limpiar_cadena($_POST['depto_reg']);
        $municipio= mainModel2::limpiar_cadena($_POST['municipio_reg']);
        $investigado = mainModel2::limpiar_cadena(strtoupper($_POST['investigado']));
        $rango = mainModel2::limpiar_cadena($_POST['rango_id_reg']);
        $tipo_falta = mainModel2::limpiar_cadena($_POST['tipo_falta_reg']);
        $articulo = $_POST['articulos_reg'];
        $fecha_inicio_exp = $_POST['fecha_inicio_exp_reg'];
        $proceso_id=1;
        
        /*comprobar campos vacios*/
        if ($n_exp == "" ||  $municipio == "" ||  $depto == ""||  $sexo == ""||  $investigado == "" || $rango == ""  ||   $fecha_inicio_exp == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($nombre_d != '') {
            if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑÜ ]{3,255}", $nombre_d)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
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
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL DNI DEL DENUNCIANTE NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
      
        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑÜ ]{3,255}", $investigado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE DEL DENUNCIANTE SOLO DEBE INCLUIR LETRAS Y NUMEROS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{15}", $n_exp)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NUMERO DE EXPEDIENTE NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 15 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $n_exp = "DPL-" . $n_exp;
        //VALIDAR QUE NO EXISTA OTRO EXPEDIENTE
        /*validar DNI*/
        $check_exp = mainModel2::ejecutar_consulta_simple("SELECT num_exp FROM tbl_exp WHERE num_exp='$n_exp'");
        if ($check_exp->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL EXPEDIENTE YA ESTÁ REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta = "SELECT * FROM tbl_feriado ORDER BY feriado_fecha ASC";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        foreach ($datos as $rows) {
            array_push($feriados, $rows['feriado_fecha']);
        }
      
        $fecha_final_i_pre = mainModel2::addWorkingDays($fecha_inicio_exp, 9, $feriados);
        $fecha_final_i = mainModel2::addWorkingDays($fecha_inicio_exp, 39, $feriados);
        $fecha_final_exp = mainModel2::addWorkingDays($fecha_inicio_exp, 74, $feriados);


        $datos_expediente_reg = [
            "nombre_denunciante"=>$nombre_d,
            "identidad_denunciante"=>$identidad_d,
            "genero"=>$sexo,
            "depto"=>$depto,
            "municipio"=>$municipio,
            "n_exp" => $n_exp,
            "nombre_investigado"=>$investigado,
            "rango" => $rango,
            "tipo_falta" => $tipo_falta,
            "fecha_inicio_exp" => $fecha_inicio_exp,
            "fecha_final_exp" => $fecha_final_exp,
            "fecha_final_i_pre" => $fecha_final_i_pre,
            "fecha_final_i" => $fecha_final_i,
            "proceso_id" => $proceso_id
        ];

        $agregar_expediente =  expedienteModelo::agregar_proceso_denuncia_modelo($datos_expediente_reg);
        // CAPTURAMOS EL VALOR DE EL ULTIMO REGISTRO DE LA TABLA EXPEDIENTES
        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT exp_id FROM tbl_exp ORDER BY exp_id DESC LIMIT 1");
        if ($consultar_id->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "ERROR EN LA CONSULTA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $consultar_id->fetch();
        }
        $exp_id = $campos['exp_id'];

        //insertamos los articulos en su respectiva tabla
        $agregar_articulos= expedienteModelo::agregar_exp_art_modelo($exp_id,$articulo);
        $agregar_b =  expedienteModelo::agregar_bit_fec_cono_modelo($exp_id,$fecha_inicio_exp,$proceso_id);
        if ($agregar_expediente->rowCount() == 1 && $agregar_articulos && $agregar_b ) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "EXPEDIENTE REGISTRADO",
                "Texto" => "LOS DATOS DEL EXPEDIENTE SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
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
        $fec_emision=$_POST['fec_emision'];
        $proceso_id=2;
        
        $datos_proc_up = [
            "bitacora_id"=>$bit_id,
            "fec_emision"=>$fec_emision,
            "proceso_id"=>$proceso_id
        ];

        $agregar_proc= expedienteModelo::agregar_proceso_emision_modelo($datos_proc_up);
        
        if ($agregar_proc) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "HECHO",
                "Texto" => "EL EXPEDIENTE EMITIDO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE EMITIÓ EL EXPEDIENTE",
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
         $fec_admision=$_POST['fec_admitir'];
         $proceso_id=3;
         
         $datos_proc_up = [
             "bitacora_id"=>$bit_id,
             "fec_admision"=>$fec_admision,
             "proceso_id"=>$proceso_id
         ];
 
         $agregar_proc= expedienteModelo::agregar_proceso_admision_modelo($datos_proc_up);
         
         if ($agregar_proc) {
             $alerta = [
                 "Alerta" => "recargar",
                 "Titulo" => "HECHO",
                 "Texto" => "EL EXPEDIENTE ADMITIDO CON ÉXITO",
                 "Tipo" => "success"
             ];
         } else {
             $alerta = [
                 "Alerta" => "simple",
                 "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                 "Texto" => "NO SE ADMITIÓ EL EXPEDIENTE",
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
         $fec_asig=$_POST['fec_asignar_inves'];
         $investigador=mainModel2::limpiar_cadena($_POST['investigador']);
         $proceso_id=4;
         $exp_id=mainModel2::limpiar_cadena($_POST['exp_id']);
         /*comprobar campos vacios*/
        if ($investigador == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "CAMPO VACIO, POR FAVOR SELECCIONE INVESTIGADOR",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
         
         $datos_proc_up = [
             "bitacora_id"=>$bit_id,
             "fec_asignacion"=>$fec_asig,
             "investigador_id"=>$investigador,
             "proceso_id"=>$proceso_id,
             "exp_id"=>$exp_id
         ];
 
         $agregar_proc= expedienteModelo::agregar_proceso_asig_i_modelo($datos_proc_up);
         
         if ($agregar_proc) {
             $alerta = [
                 "Alerta" => "recargar",
                 "Titulo" => "HECHO",
                 "Texto" => "EL EXPEDIENTE SE HA ASIGNADO CON ÉXITO",
                 "Tipo" => "success"
             ];
         } else {
             $alerta = [
                 "Alerta" => "simple",
                 "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                 "Texto" => "NO SE HA PODIDO ASIGNAR EL EXPEDIENTE",
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
        $consulta = "SELECT * FROM tbl_exp";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta2 = "SELECT * FROM tbl_feriado ORDER BY feriado_fecha ASC";
        $conexion = mainModel2::conectar();
        $datos2 = $conexion->query($consulta2);
        $datos2 = $datos2->fetchAll();
        foreach ($datos2 as $rows2) {
            array_push($feriados, $rows2['feriado_fecha']);
        }


        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-exp-investigacion/" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Expediente
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered">

            <thead style="vertical-align:middle;">
                <tr>
                <th style="vertical-align:middle;">N° EXPEDIENTE</th>
    
                <th style="vertical-align:middle;">FECHA CONOCIMIENTO DIDADPOL</th>
                <th style="vertical-align:middle;">FECHA FINAL EXPEDIENTE </th>
                <th style="vertical-align:middle;">VIGENCIA DEL EXPEDIENTE </th>
                <th style="vertical-align:middle;">VIGENCIA PROCESO INVESTIGACION </th>
                <th style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $dias = mainModel2::getWorkingDays(date('Y-m-d'), $rows['fecha_final_exp'], $feriados);
            $dias2 = mainModel2::getWorkingDays(date('Y-m-d'), $rows['fecha_final_i'], $feriados);
            
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';
            
        
             
            $tabla .= ' 
                
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_inicio_exp'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'] )). '</td>';

                if ($dias >= 60) {
                    $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-success">';
                    $dias= $dias.' DÍAS';
                } elseif ($dias >= 40 && $dias <=59) {
                    $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-warning">';
                    $dias= $dias.' DÍAS';
                } elseif ($dias >= 1 && $dias <=39) {
                    $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                    $dias= $dias.' DÍAS';
                } elseif ($dias2 <=0) {
                    $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                    $dias= 'PLAZO TERMINADO';
                }

              $tabla.='<span class="badge badge badge-dark">' . $dias . '</span></td>';

              if ($dias2 >= 21 ) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-success">';
                $dias2= $dias2.' DÍAS';
            } elseif ($dias2 >= 6 && $dias2 <=20) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-warning">';
                $dias2= $dias2.' DÍAS';
            } elseif ($dias2 >= 1 && $dias2 <=5) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                $dias2= $dias2.' DÍAS';
            } elseif ($dias2 <=0) {
                
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-secondary">';
                $dias2= 'PLAZO TERMINADO';
            }
                $tabla.='<span class="badge badge badge-dark">' . $dias2 . '</span></td>
                ';

               

            $tabla .= '  <td>
                <div class="row">
                <a href="' . SERVERURL . 'ver-info-exp-i/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-dark btn-sm" title="Ver información completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>
                    <a href="' . SERVERURL . 'actualizar-exp-i/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/expedienteAjax.php" method="POST" data-form="delete" autocomplete="off" style="margin: 0 auto;">
                        <input type="hidden" name="exp_id_del" value="' . mainModel2::encryption($rows['exp_id']) . '">

                        <button type="submit" title="Eliminar"class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>

                    </form>
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
        $check_exp2 = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_exp WHERE exp_id=$id_exp");
        if ($check_exp2->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HEMOS ENCONTRADO EL EXPEDIENTE EN EL SISTEMA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_exp2->fetch();
        }
        
        $art_input = $_POST['articulos_up'];
        $n_exp = mainModel2::limpiar_cadena($_POST['n_exp_up']);
        $nombre_d= strtoupper(mainModel2::limpiar_cadena($_POST['nombre_d_up']));
        $identidad_d= mainModel2::limpiar_cadena($_POST['identidad_d_up']);
        $sexo= mainModel2::limpiar_cadena($_POST['genero_up']);
        $depto= mainModel2::limpiar_cadena($_POST['depto_up']);
        $municipio= mainModel2::limpiar_cadena($_POST['municipio_up']);
        $investigado = mainModel2::limpiar_cadena(strtoupper($_POST['investigado_up']));
        $rango = mainModel2::limpiar_cadena($_POST['rango_up']);
        $tipo_falta = mainModel2::limpiar_cadena($_POST['tipo_falta_up']);
        $investigador = mainModel2::limpiar_cadena($_POST['investigador_up']);
        $fecha_inicio_exp = $_POST['fecha_inicio_exp_up'];
        $fecha_final_exp = $_POST['fecha_final_exp_up'];
        $fecha_inicio_i = $_POST['fecha_inicio_i_up'];
        $fecha_final_i_pre = $_POST['fecha_final_i_pre_up'];
        $fecha_final_i = $_POST['fecha_final_i_up'];
        $fecha_remision = $_POST['fecha_remision_up'];
        $diligencia = mainModel2::limpiar_cadena(strtoupper($_POST['diligencia_up']));
        $estado = mainModel2::limpiar_cadena($_POST['estado_up']);
        $observacion = strtoupper(mainModel2::limpiar_cadena($_POST['observacion_up']));
        $folios = strtoupper(mainModel2::limpiar_cadena($_POST['folios_up']));
        $recomendacion = strtoupper(mainModel2::limpiar_cadena($_POST['recomen_up']));
        $num_dictamen = strtoupper(mainModel2::limpiar_cadena($_POST['num_dictan_up']));
        $num_archivo = strtoupper(mainModel2::limpiar_cadena($_POST['num_arch_up']));
        $legal_id = strtoupper(mainModel2::limpiar_cadena($_POST['legal_id_up']));

        /*comprobar campos vacios*/
        if ($n_exp == "" ||  $municipio == "" ||  $depto == ""||  $sexo == ""||  $investigado == "" || 
            $rango == ""  || $tipo_falta == "" || $investigador == "" || $fecha_inicio_exp == "" || 
            $fecha_final_exp == "" || $fecha_inicio_i == ""|| $fecha_final_i_pre == "" || $fecha_final_i == "" || 
            $fecha_remision == ""|| $diligencia == "" || $estado == "" || $observacion == "" || $art_input == "" || 
            $folios == "" || $recomendacion == "" || $num_dictamen == "" || $num_archivo == "" || $legal_id == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($nombre_d != '') {
            if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑÜ ]{3,255}", $nombre_d)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
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
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL DNI DEL DENUNCIANTE NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        
        if ($identidad_d != $campos['identidad_denunciante']) {
             /*validar DNI*/
        $check_identidad = mainModel2::ejecutar_consulta_simple("SELECT identidad_denunciante FROM tbl_exp WHERE 	identidad_denunciante='$identidad_d'");
        if ($check_identidad->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "LA IDENTIDAD DEL DENUNCIANTE YA ESTÁ REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        }
      
      
        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑÜ ]{3,255}", $investigado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE DEL DENUNCIANTE SOLO DEBE INCLUIR LETRAS Y NUMEROS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{15}", $n_exp)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NUMERO DE EXPEDIENTE NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 15 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $n_exp = "DPL-" . $n_exp;
        //VALIDAR QUE NO EXISTA OTRO EXPEDIENTE
        if ($n_exp != $campos['num_exp']) {
             /*validar n_exp*/
             $check_exp = mainModel2::ejecutar_consulta_simple("SELECT num_exp FROM tbl_exp WHERE num_exp='$n_exp'");
             if ($check_exp->rowCount() > 0) {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                     "Texto" => "EL EXPEDIENTE YA ESTÁ REGISTRADO",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
        }
        



        $check_exp_art = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_exp_art WHERE exp_id=$id_exp");
        if ($check_exp_art->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
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
            "nombre_denunciante"=>$nombre_d,
            "identidad_denunciante"=>$identidad_d,
            "genero"=>$sexo,
            "depto"=>$depto,
            "municipio"=>$municipio,
            "n_exp" => $n_exp,
            "nombre_investigado"=>$investigado,
            "rango" => $rango,
            "tipo_falta" => $tipo_falta,
            "investigador" => $investigador,
            "fecha_inicio_exp" => $fecha_inicio_exp,
            "fecha_final_exp" => $fecha_final_exp,
            "fecha_inicio_i" => $fecha_inicio_i,
            "fecha_final_i_pre" => $fecha_final_i_pre,
            "fecha_final_i" => $fecha_final_i,
            "diligencia" => $diligencia,
            "estado" => $estado,
            "fecha_remision" => $fecha_remision,
            "observacion" => $observacion,
            "exp_id"=>$id_exp,
            "folios"=>$folios,
            "recomen"=>$recomendacion,
            "num_dictan"=>$num_dictamen,
            "num_arch"=>$num_archivo,
            "legal_id"=>$legal_id
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
                "Texto" => "LOS DATOS DEL EXPEDIENTE SE HAN ACTUALIZADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ACTUALIZAR EL EXPEDIENTE",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}/* fin clase */
