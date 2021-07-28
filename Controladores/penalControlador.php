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
        $rol_nombre = strtoupper(mainModel2::limpiar_cadena($_POST['rol_nombre_reg']));
        $descrip = strtoupper(mainModel2::limpiar_cadena($_POST['rol_descrip_reg']));
       

        /*comprobar campos vacios*/
        if ($rol_nombre == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "CAMPO NOMBRE ROL VACÍO ",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{3,100}", $rol_nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE ROL SOLO DEBE INCLUIR LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($descrip != "") {
            if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ0-9 ]{3,100}", $descrip)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL CAMPO DESCRIPCIÓN SOLO PUEDE INCLUIR LETRAS Y NUMEROS",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /*validar rol*/
        $check_rol = mainModel2::ejecutar_consulta_simple("SELECT rol_nombre FROM tbl_rol WHERE rol_nombre='$rol_nombre'");
        if ($check_rol->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL ROL YA ESTÁ REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_rol_reg = [
            "rol" => $rol_nombre,
            "descrip" => $descrip
        ];
        $agregar_rol = rolModelo::agregar_rol_modelo($datos_rol_reg);
        if ($agregar_rol->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "ROL REGISTRADO",
                "Texto" => "LOS DATOS DEL ROL SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL ROL",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*fin controlador */
    /* controlador para listar expedientes penal*/
    public function listar_exp_penal_controlador()
    {
        $tabla = '';
        $consulta = "SELECT p.proc_penal_id, p.n_exp_interno, p.nombre_procesado, p.delitos, p.victimas, f.descrip_fiscalia, j.descrip_juzg_tribu, p.exp_judicial, e.descrip_est_lab, p.fec_hechos, p.fec_ultima_act, p.descrip_ultima_act, p.est_proceso, p.oficio_solicitud FROM tbl_proc_penal p INNER JOIN tbl_fiscalia f ON p.fiscalia_id = f.fiscalia_id INNER JOIN tbl_juzg_tribu j ON j.juzg_tribu_id = p.juzg_tribu_id INNER JOIN tbl_est_lab e ON e.est_lab_id = p.est_lab_id";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-proc-penales/" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo proc penal
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered">

            <thead style="vertical-align:middle;">
                <tr>
                <th style="vertical-align:middle;">N° EXPEDIENTE
                INTERNO</th>
                <th style="vertical-align:middle;">NOMBRE DEL PROCESADO</th>
                <th style="vertical-align:middle;">DELITO(S)</th>
                <th style="vertical-align:middle;">VICTIMA(S)</th>
                <th style="vertical-align:middle;">FISCALIA</th>
                <th style="vertical-align:middle;">JUZGADO/TRIBUNAL</th>
                <th style="vertical-align:middle;">EXPEDIENTE JUDICIAL</th>
                <th style="vertical-align:middle;">ESTADO LABORAL</th>
                <th style="vertical-align:middle;">DESCRIPCION DE ESTADO LABORAL</th>
                <th style="vertical-align:middle;">FECHA DE LOS HECHOS</th>
                <th style="vertical-align:middle;">FECHA DE LA ULTIMA ACTUALIZACIÓN</th>
                <th style="vertical-align:middle;">DESCRIPCION ULTIMA ACTUALIZACIÓN/th>
                <th style="vertical-align:middle;">ESTADO DEL PROCESO</th>
                <th style="vertical-align:middle;">OFICIO DE SOLICITUD DE DIDADPOL</th>
                <th style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['n_exp_interno'] . '</span></td>';
            $tabla .= '<td class="text-center">' . $rows['nombre_procesado'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['delitos'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['victimas'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['descrip_fiscalia'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['descrip_juzg_tribu'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['exp_judicial'] . '</td>';

            $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_hechos'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fec_ultima_act'])) . '</td>';

            $tabla .= '<td class="text-center">' . $rows['descrip_ultima_act'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['est_proceso'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['oficio_solicitud'] . '</td>';

            $tabla .= '  <td>
                <div class="row">
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
        $id = mainModel2::decryption($_POST['rol_id_up']);
        $id = mainModel2::limpiar_cadena($id);
        //comprobar el rol
        $check_rol = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_rol WHERE rol_id=$id");
        if ($check_rol->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "CAMPO NOMBRE ROL VACÍO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_rol->fetch();
        }

        $rol_nombre = strtoupper(mainModel2::limpiar_cadena($_POST['rol_nombre_up']));
        $descrip = strtoupper(mainModel2::limpiar_cadena($_POST['rol_descrip_up']));
        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{3,100}", $rol_nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE ROL SOLO DEBE INCLUIR LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($descrip != "") {
            if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ0-9 ]{3,100}", $descrip)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL CAMPO DESCRIPCIÓN SOLO PUEDE INCLUIR LETRAS Y NUMEROS",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /*validar usuario*/
        if ($rol_nombre != $campos['rol_nombre']) {
            $check_user = mainModel2::ejecutar_consulta_simple("SELECT rol_nombre FROM tbl_rol WHERE rol_nombre='$rol_nombre'");
            if ($check_user->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL ROL YA ESTÁ REGISTRADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $datos_usuario_up = [
            "rol" => $rol_nombre,
            "descrip" => $descrip,
            "id" => $id
        ];

        if (rolModelo::actualizar_rol_modelo($datos_usuario_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "ACTUALIZADO CON ÉXITO",
                "Texto" => "LOS DATOS SE ACTUALIZARON CON ÉXITO",
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
}
