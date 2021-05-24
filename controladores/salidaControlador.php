<?php
if ($peticionAjax) {
    require_once "../modelos/salidaModelo.php";
} else {
    require_once "./modelos/salidaModelo.php";
}
class salidaControlador extends salidaModelo
{
    /* controlador agregar salida*/
    public function agregar_salida_controlador()
    {
        $motorista = mainModel2::limpiar_cadena($_POST['motorista_sal_reg']);
        $colaboradores = $_POST['colaboradores_sal_reg'];
        $tipo_salida = mainModel2::limpiar_cadena($_POST['tipo_sal_reg']);
        $fecha_salida = $_POST['fecha_sal_reg'];
        $observacion = strtoupper(mainModel2::limpiar_cadena($_POST['observacion_sal_reg']));

        /*comprobar campos vacios*/
        if ($motorista == "" || $colaboradores == "" || $tipo_salida == ""  || $fecha_salida == "" || $observacion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_fecha($fecha_salida)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "FECHA DE SALIDA NO VALIDA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_salida_reg = [
            "motorista" => $motorista,
            "tipo_salida" => $tipo_salida,
            "fecha_salida" => $fecha_salida,
            "observacion" => $observacion
        ];
        $agregar_salida =  salidaModelo::agregar_salida_modelo($datos_salida_reg);

        $consultar_id = mainModel2::ejecutar_consulta_simple("SELECT salida_id FROM tbl_salida ORDER BY salida_id DESC LIMIT 1");
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

        $datos_usu_sal = [
            "id_salida" => $campos['salida_id']
        ];
        $agregar_usu_sal = salidaModelo::agregar_usu_sal_modelo($datos_usu_sal, $colaboradores);
        if ($agregar_salida->rowCount() == 1 && $agregar_usu_sal) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "SALIDA REGISTRADA",
                "Texto" => "LOS DATOS DE LA SALIDA SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL SALIDA",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*fin controlador */

    public function listar_salidas_controlador()
    {

        $tabla = '';
        $consulta = "SELECT * from tbl_salida as ts
        INNER JOIN tbl_usuario as tu on tu.usu_id= ts.motorista_id
        INNER JOIN tbl_tipo_salida as tts on tts.tipo_salida_id= ts.tipo_salida_id
        WHERE ts.tipo_salida_id=1";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();



        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-salida/" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Salida
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered table-hover">

            <thead class="text-center">
                <tr>
                <th>FECHA</th>
                <th>MOTORISTA</th>
                <th>COLABORADOR / COLABORADORES </th>
                <th>OBSERVACIÓN</th>
                <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td>' . $rows['salida_fecha'] . '</td>
                <td>' . $rows['usu_nombre'] . " " . $rows['usu_apellido'] . '</td>
                <td>';
            $agregar_colaborador = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_usuario_salida as tus
                INNER join tbl_usuario as tu on tu.usu_id=tus.colaborador_id WHERE salida_id=$rows[salida_id]");
            if ($agregar_colaborador->rowCount() > 0) {
                $campos = $agregar_colaborador->fetchAll();
                foreach ($campos as $agregar_colaboradores) {
                    $tabla .= '<span class="badge badge badge-dark">' . $agregar_colaboradores['usu_nombre'] . " " . $agregar_colaboradores['usu_apellido'] . '</span><br>';
                }
            }
            $tabla .= ' </td> 
                 
                <td>' . $rows['salida_observacion'] . '</td>
                <td>
                <div class="row">
                    <a href="' . SERVERURL . 'actualizar-salida/' . mainModel2::encryption($rows['salida_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/salidaAjax.php" method="POST" data-form="delete" autocomplete="off" style="margin: 0 auto;">
                        <input type="hidden" name="gira_id_del" value="' . mainModel2::encryption($rows['salida_id']) . '">

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
    /* Controlador datos de giras*/
    public  function datos_gira_controlador($tipo, $id)
    {
        $tipo = mainModel2::limpiar_cadena($tipo);
        $id = mainModel2::decryption($id);
        $id = mainModel2::limpiar_cadena($id);
        return salidaModelo::datos_gira_modelo($tipo, $id);
    }/* fin controlador datos del usuario */
    /* Controlador actualizar giras*/
    public function actualizar_gira_controlador()
    {
        //Recibiendo el id 
        $id_salida = mainModel2::decryption($_POST['gira_id_up']);
        $id_salida = mainModel2::limpiar_cadena($id_salida);

        //comprobar si existe salida en el sistema
        $check_salida = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_salida WHERE salida_id=$id_salida");
        if ($check_salida->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HEMOS ENCONTRADO LA SALIDA EN EL SISTEMA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $motorista = mainModel2::limpiar_cadena($_POST['motorista_gira_up']);
        $tipo_salida = mainModel2::limpiar_cadena($_POST['tipo_sal_up']);
        $colab_input = $_POST['colaboradores_gira_up'];
        $obs_gira = strtoupper(mainModel2::limpiar_cadena($_POST['observacion_gira_up']));
        $fecha_gira = $_POST['fecha_gira_up'];
        /*comprobar campos vacios*/
        if ($motorista == "" || $colab_input == ""   || $fecha_gira == "" || $obs_gira == "" || $tipo_salida == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        //verificar fecha
        if (mainModel2::verificar_fecha($fecha_gira)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "FECHA DE SALIDA NO VALIDA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $check_usu_sal = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_usuario_salida WHERE salida_id=$id_salida");
        if ($check_usu_sal->rowCount() <= 0) {
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
            $campos = $check_usu_sal->fetchAll();
        }
        $colab_values = [];
        foreach ($campos as $colab_data) {
            $colab_values[] = $colab_data['colaborador_id'];
        }

        $datos_gira_up = [
            "motorista" => $motorista,
            "tipo_salida" => $tipo_salida,
            "fecha_salida" => $fecha_gira,
            "observacion" => $obs_gira,
            "id_salida" => $id_salida
        ];

        $actualizar_gira =  salidaModelo::actualizar_gira_modelo($datos_gira_up);
        //Para insertar datos recien agregados
        $insert_nuevos_colab =  salidaModelo::agregar_nuevos_colab_modelo($colab_input, $colab_values, $id_salida);
        //Para eliminar colaboradores
        $eliminar_colab = salidaModelo::eliminar_colab_modelo($colab_input, $colab_values, $id_salida);  

        if ($actualizar_gira) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "SALIDA ACTUALIZADA",
                "Texto" => "LOS DATOS DE LA SALIDA SE HAN ACTUALIZADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ACTUALIZAR LA SALIDA",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}/* fin clase */
