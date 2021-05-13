<?php
if ($peticionAjax) {
    require_once "../modelos/rolModelo.php";
} else {
    require_once "./modelos/rolModelo.php";
}
class rolControlador extends rolModelo
{
    /* controlador agregar usuario*/
    public function agregar_rol_controlador()
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

        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑ ]{3,100}", $rol_nombre)) {
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
            if (mainModel2::verificar_datos("[A-Z0-9ÁÉÍÓÚÑ ]{3,100}", $descrip)) {
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
    public function listar_roles_controlador()
    {
        $contador = 1;
        $tabla = '';
        $consulta = "SELECT * FROM tbl_rol order by rol_id desc";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();



        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-rol/" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo rol
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered table-hover">

            <thead class="text-center">
                <tr>
                    <th>N°</th>
                    <th>ROL</th>
                    <th>DESCRIPCIÓN</th>
                    
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td>' . $contador . '</td>
                <td>' . $rows['rol_nombre'] . '</td>
                <td>' . $rows['rol_descripcion'] . '</td>
                <td>
                <div class="row">
                    <a href="' . SERVERURL . 'actualizar-rol/' . mainModel2::encryption($rows['rol_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>

                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/rolAjax.php" method="POST" data-form="delete" autocomplete="off" style="margin: 0 auto;">
                        <input type="hidden" name="usuario_id_del" value="' . mainModel2::encryption($rows['rol_id']) . '">

                        <button type="submit" title="Eliminar"class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                            Eliminar
                        </button>

                    </form>
                </div>
            </td> 
            </tr>';
            $contador++;
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
    public  function datos_rol_controlador($tipo, $id)
    {
        $tipo = mainModel2::limpiar_cadena($tipo);
        $id = mainModel2::decryption($id);
        $id = mainModel2::limpiar_cadena($id);
        return rolModelo::datos_rol_modelo($tipo, $id);

    }/* fin controlador datos del usuario */
    public  function actualizar_rol_controlador()
    {
        //Recibiendo el id 
        $id = mainModel2::decryption($_POST['rol_id_up']);
        $id = mainModel2::limpiar_cadena($id);
        //comprobar el usuari
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

        $rol_nombre = mainModel2::limpiar_cadena($_POST['rol_nombre_up']);
        $descrip = strtoupper(mainModel2::limpiar_cadena($_POST['rol_descrip_up']));
        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑ ]{3,100}", $rol_nombre)) {
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
            if (mainModel2::verificar_datos("[A-Z0-9ÁÉÍÓÚÑ ]{3,100}", $descrip)) {
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
  

}/* fin clase */
