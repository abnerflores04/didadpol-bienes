<?php
if ($peticionAjax) {
    require_once "../modelos/disciplinarioModelo.php";
} else {
    require_once "./modelos/disciplinarioModelo.php";
}
class disciplinarioControlador extends disciplinarioModelo

{

    /* controlador para listar expedientes disciplinario*/
    public function listar_exp_disciplinario_controlador()
    {
        $tabla = '';
        $consulta = "SELECT te.num_exp, te.nombre_investigado,te.exp_id, tpd.proc_disciplinario_id  FROM tbl_proc_disciplinario tpd INNER JOIN tbl_exp te ON te.exp_id=tpd.exp_id";
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
                <th style="vertical-align:middle;text-align:center;">N° EXPEDIENTE</th>
                <th style="vertical-align:middle;text-align:center;">NOMBRE DEL INVESTIGADO</th>
                <th style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;text-align:center;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';
            $tabla .= '<td class="text-center">' . $rows['nombre_investigado'] . '</td>';


            $tabla .= '  <td>
                <div class="row">
                <a href="' . SERVERURL . 'ver-info-exp-d/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-secondary btn-sm" title="Ver información completa del expediente" style="margin: 0 auto;"><i class="fas fa-folder-open"></i></a>
                <a href="' . SERVERURL . 'ver-info-proc-disciplinario/' . mainModel2::encryption($rows['proc_disciplinario_id']) . '" class="btn btn-dark btn-sm" title="Ver información completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>
                    <a href="' . SERVERURL . 'actualizar-proc-disciplinario/' . mainModel2::encryption($rows['proc_disciplinario_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
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
    /* controlador actualizar proceso disciplinario*/
    public  function actualizar_proc_disciplinario_controlador()
    {
        //Recibiendo el id 
        $id = mainModel2::decryption($_POST['proc_disciplinario_id_up']);
        $id = mainModel2::limpiar_cadena($id);
        //comprobar el rol
        $check_disciplinario = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_proc_disciplinario WHERE proc_disciplinario_id=$id");
        if ($check_disciplinario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "PROCESO PENAL NO EXISTE",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_disciplinario->fetch();
        }

        $sexo = mainModel2::limpiar_cadena($_POST['genero_up']);
        $n_identidad = strtoupper(mainModel2::limpiar_cadena($_POST['identidad_up']));
        $direccion_pol = strtoupper(mainModel2::limpiar_cadena($_POST['direccion_pol_up']));
        $antiguedad = strtoupper(mainModel2::limpiar_cadena($_POST['antiguedad_up']));
        $res_seds = mainModel2::limpiar_cadena($_POST['n_res_seds_up']);
        $fec_res_seds = mainModel2::limpiar_cadena($_POST['fec_res_seds_up']);
        $n_res_seds = strtoupper(mainModel2::limpiar_cadena($_POST['cod_res_seds_up']));
        $fec_int_i = $_POST['fec_int_i_up'];
        $fec_int_f = $_POST['fec_int_f_up'];
        $vicio_nul = strtoupper(mainModel2::limpiar_cadena($_POST['vicio_nul_up']));
        $repre_legal = strtoupper(mainModel2::limpiar_cadena($_POST['repre_legal_up']));
        $n_acuerdo = strtoupper(mainModel2::limpiar_cadena($_POST['n_acuerdo_up']));
        $fec_acuerdo_i = $_POST['fec_acuerdo_i_up'];
        $fec_acuerdo_f = $_POST['fec_acuerdo_f_up'];
        $n_cont_admin = strtoupper(mainModel2::limpiar_cadena($_POST['n_cont_admin_up']));

        /*comprobar campos vacios*/
        if ($sexo == "" || $n_identidad == "" || $direccion_pol == "" || $antiguedad == "" || $res_seds == "" || $fec_res_seds == "" || $n_res_seds == "" || $fec_int_i == "" || $fec_int_f == "" || $n_res_seds == "" || $n_acuerdo == "" || $fec_acuerdo_i == "" || $fec_acuerdo_f == "" || $n_cont_admin == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($repre_legal != "") {
            if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{10,100}", $repre_legal)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL NOMBRE DEL REPRESENTANTE LEGAL SOLO DEBE INCLUIR LETRAS",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel2::verificar_datos("[0-9-]{15}", $n_identidad)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NÚMERO DE IDENTIDAD DEL INVESTIGADO NO CUMPLE CON EL FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[0-9-]{8}", $res_seds)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "RES. SEDS NO CUMPLE CON FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{8}", $n_res_seds)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NÚMERO DE RES. SEDS NO CUMPLE CON FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{9}", $n_acuerdo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NÚMERO DE ACUERDO DE CANCELACIÓN NO CUMPLE CON FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9-]{9}", $n_cont_admin)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NÚMERO DE CONTENCIOSO ADMINISTRATIVO NO CUMPLE CON FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proc_disciplinario_up = [
            "sexo_id" => $sexo,
            "identidad_investigado" => $n_identidad,
            "direccion_pol" => $direccion_pol,
            "antiguedad_ins" => $antiguedad,
            "n_res_seds" => $res_seds,
            "fec_res_seds" => $fec_res_seds,
            "fec_int_i" => $fec_int_i,
            "fec_int_f" => $fec_int_f,
            "cod_res_seds" => $n_res_seds,
            "vicio_nul" => $vicio_nul,
            "repre_legal" => $repre_legal,
            "n_acuerdo" => $n_acuerdo,
            "fec_acuerdo_i" => $fec_acuerdo_i,
            "fec_acuerdo_f" => $fec_acuerdo_f,
            "n_cont_admin" => $n_cont_admin,
            "proc_disciplinario_id" => $id
        ];

        if (disciplinarioModelo::actualizar_proc_disciplinario_modelo($datos_proc_disciplinario_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "ACTUALIZADO CON ÉXITO",
                "Texto" => "LOS DATOS DEL PROCESO DISCIPLINARIO SE ACTUALIZARON CON ÉXITO",
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
    }/* fin controlador actualizar proc disciplinario */
    public  function datos_proc_disciplinario_controlador($tipo, $id)
    {
        $tipo = mainModel2::limpiar_cadena($tipo);
        $id = mainModel2::decryption($id);
        $id = mainModel2::limpiar_cadena($id);
        return disciplinarioModelo::datos_proc_disciplinario_modelo($tipo, $id);
    }/* fin controlador datos del usuario */
}
