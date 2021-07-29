<?php
if ($peticionAjax) {
    require_once "../modelos/penalModelo.php";
} else {
    require_once "./modelos/penalModelo.php";
}
class penalControlador extends penalModelo

{
    /* controlador agregar proceso penal*/
    public function agregar_proc_penal_controlador()
    {
        $n_exp_i = strtoupper(mainModel2::limpiar_cadena($_POST['n_exp_i_reg']));
        $nom_procesado = strtoupper(mainModel2::limpiar_cadena($_POST['nombre_c_reg']));
        $delitos = strtoupper(mainModel2::limpiar_cadena($_POST['delitos_reg']));
        $victimas = strtoupper(mainModel2::limpiar_cadena($_POST['victimas_reg']));
        $fiscalia = mainModel2::limpiar_cadena($_POST['fiscalia_reg']);
        $juzg_tribu = mainModel2::limpiar_cadena($_POST['juzg_tribu_reg']);
        $exp_j = strtoupper(mainModel2::limpiar_cadena($_POST['exp_j_reg']));
        $est_lab = mainModel2::limpiar_cadena($_POST['est_lab_reg']);
        $descrip_est = strtoupper(mainModel2::limpiar_cadena($_POST['descrip_est_reg']));
        $fec_hechos = $_POST['fec_hechos_reg'];
        $fec_ult_a = $_POST['fec_ult_act_reg'];
        $descrip_ult_a = strtoupper(mainModel2::limpiar_cadena($_POST['descrip_ult_act_reg']));
        $est_proc = strtoupper(mainModel2::limpiar_cadena($_POST['est_proc_reg']));
        $oficio = strtoupper(mainModel2::limpiar_cadena($_POST['oficio_reg']));



        /*comprobar campos vacios*/
        if ($n_exp_i == "" || $nom_procesado == "" || $delitos == "" || $victimas == "" || $fiscalia == "" || $juzg_tribu == "" || $exp_j == "" || $fec_hechos == "" || $fec_ult_a == "" || $descrip_ult_a == "" || $est_proc == "" || $oficio == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{10,100}", $nom_procesado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE COMPLETO DEL PROCESADO SOLO DEBE INCLUIR LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{13}", $n_exp_i)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NUMERO DE EXPEDIENTE INTERNO NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 13 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{8}", $oficio)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL OFICIO DE SOLICITUD DE DIDADPOL NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 8 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $oficio = "DIDADPOL D-" . $oficio;

        /*validar rol*/
        $check_exp = mainModel2::ejecutar_consulta_simple("SELECT n_exp_interno FROM tbl_proc_penal WHERE n_exp_interno='$n_exp_i'");
        if ($check_exp->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL EXPEDIENTE INTERNO YA ESTÁ REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proc_penal_reg = [
            "n_exp_interno" => $n_exp_i,
            "nombre_procesado" => $nom_procesado,
            "delitos" => $delitos,
            "victimas" => $victimas,
            "fiscalia_id" => $fiscalia,
            "juzg_tribu_id" => $juzg_tribu,
            "exp_judicial" => $exp_j,
            "est_lab_id" => $est_lab,
            "descrip_est_lab" => $descrip_est,
            "fec_hechos" => $fec_hechos,
            "fec_ultima_act" => $fec_ult_a,
            "descrip_ultima_act" => $descrip_ult_a,
            "est_proceso" => $est_proc,
            "oficio_solicitud" => $oficio
        ];
        $agregar_proc_penal = penalModelo::agregar_proc_penal_modelo($datos_proc_penal_reg);
        if ($agregar_proc_penal->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "PROCESO PENAL REGISTRADO",
                "Texto" => "LOS DATOS DEL PROCESO PENAL SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL PROCESO PENAL",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*fin controlador */
    /* controlador para listar expedientes penal*/
    public function listar_exp_penal_controlador()
    {
        $tabla = '';
        $consulta = "SELECT p.proc_penal_id, p.n_exp_interno, p.nombre_procesado, p.delitos, p.victimas, f.descrip_fiscalia, j.descrip_juzg_tribu, p.exp_judicial, e.descrip_est_l, p.descrip_est_lab, p.fec_hechos, p.fec_ultima_act, p.descrip_ultima_act, p.est_proceso, p.oficio_solicitud FROM tbl_proc_penal p INNER JOIN tbl_fiscalia f ON p.fiscalia_id = f.fiscalia_id INNER JOIN tbl_juzg_tribu j ON j.juzg_tribu_id = p.juzg_tribu_id INNER JOIN tbl_est_lab e ON e.est_lab_id = p.est_lab_id";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-proc-penales/" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo proc penal
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered">

            <thead>
                <tr>
                <th style="vertical-align:middle;text-align:center;">N° EXPEDIENTE INTERNO</th>
                <th style="vertical-align:middle;text-align:center;">NOMBRE DEL PROCESADO</th>
                
                <th style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;text-align:center;"><span class="badge badge badge-dark">' . $rows['n_exp_interno'] . '</span></td>';
            $tabla .= '<td class="text-center">' . $rows['nombre_procesado'] . '</td>';


            $tabla .= '  <td>
                <div class="row">
                <a href="' . SERVERURL . 'ver-info-proc-penal/' . mainModel2::encryption($rows['proc_penal_id']) . '" class="btn btn-dark btn-sm" title="Ver información completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>
                    <a href="' . SERVERURL . 'actualizar-proc-penal/' . mainModel2::encryption($rows['proc_penal_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
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
    /* controlador actualizar proceso penal*/
    public  function actualizar_proc_penal_controlador()
    {
        //Recibiendo el id 
        $id = mainModel2::decryption($_POST['proc_penal_id_up']);
        $id = mainModel2::limpiar_cadena($id);
        //comprobar el rol
        $check_rol = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_proc_penal WHERE proc_penal_id=$id");
        if ($check_rol->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "PROCESO PENAL NO EXISTE",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_rol->fetch();
        }

        $n_exp_i = strtoupper(mainModel2::limpiar_cadena($_POST['n_exp_i_up']));
        $nom_procesado = strtoupper(mainModel2::limpiar_cadena($_POST['nombre_c_up']));
        $delitos = strtoupper(mainModel2::limpiar_cadena($_POST['delitos_up']));
        $victimas = strtoupper(mainModel2::limpiar_cadena($_POST['victimas_up']));
        $fiscalia = mainModel2::limpiar_cadena($_POST['fiscalia_up']);
        $juzg_tribu = mainModel2::limpiar_cadena($_POST['juzg_tribu_up']);
        $exp_j = strtoupper(mainModel2::limpiar_cadena($_POST['exp_j_up']));
        $est_lab = mainModel2::limpiar_cadena($_POST['est_lab_up']);
        $descrip_est = strtoupper(mainModel2::limpiar_cadena($_POST['descrip_est_up']));
        $fec_hechos = $_POST['fec_hechos_up'];
        $fec_ult_a = $_POST['fec_ult_act_up'];
        $descrip_ult_a = strtoupper(mainModel2::limpiar_cadena($_POST['descrip_ult_act_up']));
        $est_proc = strtoupper(mainModel2::limpiar_cadena($_POST['est_proc_up']));
        $oficio = strtoupper(mainModel2::limpiar_cadena($_POST['oficio_up']));

        /*comprobar campos vacios*/
        if ($n_exp_i == "" || $nom_procesado == "" || $delitos == "" || $victimas == "" || $fiscalia == "" || $juzg_tribu == "" || $exp_j == "" || $fec_hechos == "" || $fec_ult_a == "" || $descrip_ult_a == "" || $est_proc == "" || $oficio == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{10,100}", $nom_procesado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE COMPLETO DEL PROCESADO SOLO DEBE INCLUIR LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*validar DNI*/

        if (mainModel2::verificar_datos("[0-9-]{13}", $n_exp_i)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NUMERO DE EXPEDIENTE INTERNO NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 13 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[0-9-]{8}", $oficio)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL OFICIO DE SOLICITUD DE DIDADPOL NO CUMPLE CON FORMATO SOLICITADO DEBE DE CONTENER 8 CARACTERES",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $oficio = "DIDADPOL D-" . $oficio;

        /*validar rol*/
        if ($n_exp_i != $campos['n_exp_interno']) {
            $check_exp = mainModel2::ejecutar_consulta_simple("SELECT n_exp_interno FROM tbl_proc_penal WHERE n_exp_interno='$n_exp_i'");
            if ($check_exp->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL EXPEDIENTE INTERNO YA ESTÁ REGISTRADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $datos_proc_penal_up = [
            "n_exp_interno" => $n_exp_i,
            "nombre_procesado" => $nom_procesado,
            "delitos" => $delitos,
            "victimas" => $victimas,
            "fiscalia_id" => $fiscalia,
            "juzg_tribu_id" => $juzg_tribu,
            "exp_judicial" => $exp_j,
            "est_lab_id" => $est_lab,
            "descrip_est_lab" => $descrip_est,
            "fec_hechos" => $fec_hechos,
            "fec_ultima_act" => $fec_ult_a,
            "descrip_ultima_act" => $descrip_ult_a,
            "est_proceso" => $est_proc,
            "oficio_solicitud" => $oficio,
            "proc_penal_id" => $id,
        ];

        if (penalModelo::actualizar_proc_penal_modelo($datos_proc_penal_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "ACTUALIZADO CON ÉXITO",
                "Texto" => "LOS DATOS DEL PROCESO PENAL SE ACTUALIZARON CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ACTUALIZAR LOS DATOS",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* fin controlador actualizar usuario */
    public  function datos_proc_penal_controlador($tipo, $id)
    {
        $tipo = mainModel2::limpiar_cadena($tipo);
        $id = mainModel2::decryption($id);
        $id = mainModel2::limpiar_cadena($id);
        return penalModelo::datos_proc_penal_modelo($tipo, $id);
    }/* fin controlador datos del usuario */
}
