<?php
if ($peticionAjax) {
    require_once "../modelos/usuarioModelo2.php";
} else {
    require_once "./modelos/usuarioModelo2.php";
}
class usuarioControlador2 extends usuarioModelo2
{
    public function listar_usuarios_controlador()
    {
        $contador = 1;
        $tabla = '';
        $consulta = "SELECT r.nombre rol, u.nombre usuario,u.nombre,u.apellido,u.nom_usuario, u.estado, u.usuario_id FROM tbl_usuarios u INNER JOIN tbl_roles r on u.rol_id=r.rol_id";
        $conexion = mainModel2::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();



        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-usuarios/" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Nuevo usuario
        </a>
        <br><br>
        <table id="example1" class=" table table-striped table-bordered table-hover dt-responsive">

            <thead class="text-center">
                <tr>
                    <th>N°</th>
                    <th>ROL</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>USUARIO</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td>' . $contador . '</td>
                <td>' . $rows['rol'] . '</td>
                <td>' . $rows['usuario'] . '</td>
                <td>' . $rows['apellido'] . '</td>
                <td>' . $rows['nom_usuario'] . '</td>
                
                <td>';
            if ($rows['estado'] == "NUEVO") {
                $tabla .= '  <span class="badge badge badge-info">';
            } elseif ($rows['estado'] == "ACTIVO") {
                $tabla .= '<span class="badge badge badge-success">';
            } elseif ($rows['estado'] == "VACACIONES") {
                $tabla .= '  <span class="badge badge badge-warning">';
            } else {
                $tabla .= '  <span class="badge badge badge-danger">';
            }

            $tabla .= '' . $rows["estado"] . '</span></td>
                <td>
                <div class="row">
                <a href="' . SERVERURL . 'ver-informacion-usuario/' . mainModel2::encryption($rows['usuario_id']) . '" class="btn btn-dark btn-sm" title="Ver información completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>

                    <a href="' . SERVERURL . 'actualizar-usuario/' . mainModel2::encryption($rows['usuario_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off" style="margin: 0 auto;">
                        <input type="hidden" name="usuario_id_del" value="' . mainModel2::encryption($rows['usuario_id']) . '">

                        <button type="submit" title="Eliminar"class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
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
    /* Controlador datos del usuario*/
    public  function datos_usuario_controlador($tipo, $id)
    {
        $tipo = mainModel2::limpiar_cadena($tipo);
        $id = mainModel2::decryption($id);
        $id = mainModel2::limpiar_cadena($id);

        return usuarioModelo2::datos_usuario_modelo($tipo, $id);
    }/* fin controlador datos del usuario */
    /* Controlador para actualizar usuario*/
    public  function actualizar_usuario_controlador()
    {
        //Recibiendo el id 
        $id = mainModel2::decryption($_POST['usu_id_up']);
        $id = mainModel2::limpiar_cadena($id);

        //comprobar el usuarioen la bd
        $check_user = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_usuarios WHERE usuario_id=$id");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HEMOS ENCONTRADO EL USUARIO EN EL SISTEMA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch();
        }

        $rol = mainModel2::limpiar_cadena($_POST['usu_rol_up']);
        $nombres = strtoupper(mainModel2::limpiar_cadena($_POST['usu_nombres_up']));
        $apellidos = strtoupper(mainModel2::limpiar_cadena($_POST['usu_apellidos_up']));
        $dni = mainModel2::limpiar_cadena($_POST['usu_identidad_up']);
        $puesto = mainModel2::limpiar_cadena($_POST['usu_puesto_up']);
    
        $unidad = mainModel2::limpiar_cadena($_POST['usu_unidad_up']);
        $celular = mainModel2::limpiar_cadena($_POST['usu_celular_up']);
        $usuario = strtolower(mainModel2::limpiar_cadena($_POST['usu_usuario_up']));
        $email = $usuario . '@didadpol.gob.hn';

        $estado = mainModel2::limpiar_cadena($_POST['usu_estado_up']);
        /*verificando datos vacios*/
        if ($nombres == "" || $apellidos == "" || $usuario == "" || $email == "" || $rol == "" || $estado == "" || $dni == "" || $puesto == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{3,35}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRES SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 3 LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{3,35}", $apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO APELLIDOS SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 3 LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($celular != "") {
            if (mainModel2::verificar_datos("[0-9]{8}", $celular)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL CELULAR NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel2::verificar_datos("[a-z]{3,15}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE DE USUARIO SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 5 Y UN MAXIMO DE 15 LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel2::verificar_datos("[0-9]{13}", $dni)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL DNI NO COINCIDE CON EL FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*validar DNI*/
        if ($dni != $campos['identidad']) {
            $check_dni = mainModel2::ejecutar_consulta_simple("SELECT identidad FROM tbl_usuarios WHERE identidad='$dni'");
            if ($check_dni->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL DNI YA ESTÁ REGISTRADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /*validar usuario*/
        if ($usuario != $campos['nom_usuario']) {
            $check_user = mainModel2::ejecutar_consulta_simple("SELECT nom_usuario FROM tbl_usuarios WHERE nom_usuario='$usuario'");
            if ($check_user->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL USUARIO YA ESTÁ REGISTRADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        

        $datos_usuario_up = [
            "rol" => $rol,
            "puesto" => $puesto,
            "unidad" => $unidad,
            "usuario" => $usuario,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "dni" => $dni,
            "estado" => $estado,
            "email" => $email,
            "celular" => $celular,
            "id" => $id
        ];

        if (usuarioModelo2::actualizar_usuario_modelo($datos_usuario_up)) {
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
