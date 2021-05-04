<?php
if ($peticionAjax) {
    require_once "../modelos/usuarioModelo.php";
} else {
    require_once "./modelos/usuarioModelo.php";
}
class usuarioControlador extends usuarioModelo
{
    /* controlador agregar usuario*/
    public function agregar_usuario_controlador()
    {
        $rol =mainModel::limpiar_cadena($_POST['usu_rol_reg']);
        $nombres = strtoupper(mainModel::limpiar_cadena($_POST['usu_nombres_reg']));
        $apellidos = strtoupper(mainModel::limpiar_cadena($_POST['usu_apellidos_reg']));
        $celular = mainModel::limpiar_cadena($_POST['usu_celular_reg']);
        $usuario = strtolower(mainModel::limpiar_cadena($_POST['usu_usuario_reg']));
        $correo =strtolower( mainModel::limpiar_cadena($_POST['usu_correo_reg']));
        
        /*comprobar campos vacios*/
        if ( $nombres == "" || $apellidos == "" || $usuario == "" || $celular == "" || $correo == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[A-ZÁÉÍÓÚÑ ]{3,35}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "el nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[A-ZÁÉÍÓÚÑ ]{3,35}", $apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "el apellido no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($celular != "") {
            if (mainModel::verificar_datos("[0-9-]{9}", $celular)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "el telfono no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        
        if (mainModel::verificar_datos("[a-z]{5,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "el nombre de usario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
       
        /*validar usuario*/
        $check_user = mainModel::ejecutar_consulta_simple("SELECT usu_usuario FROM tbl_usuario WHERE usu_usuario='$usuario'");
        if ($check_user->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El usuario ya esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*validar email*/
        if ($correo != "") {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                /*vaidar email repetido*/
                $check_email = mainModel::ejecutar_consulta_simple("SELECT usu_correo FROM tbl_usuario WHERE usu_correo='$correo'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrio un error inesperado",
                        "Texto" => "El email ya esta registrado en el sistema",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ha ingresado un correo no valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
       
        
        $datos_usuario_reg = [
            "rol" => $rol,
            "usuario" => $usuario,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "clave" => '',
            "estado" => "NUEVO",
            "correo" => $correo,
            "celular" => $celular,  
        ];
        $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);
        if ($agregar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos del usuario han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se ha podido registrar el usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*fin controlador */
    /* controlador paginar usuario*/
 
    /*controlador para eliminar usuario */
    public  function eliminar_usuario_controlador()
    {
        /* recibiendo id */
        $id = mainModel::decryption($_POST['usuario_id_del']);
        $id = mainModel::limpiar_cadena($id);
        /* comparando id */
        if ($id == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No podemos eliminar el usuario principal",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* comprobando el usuario en bd */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El usuario que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /* comprobando los prestamos*/
        $check_prestamos = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM prestamo WHERE usuario_id='$id' LIMIT 1");
        if ($check_prestamos->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No podemos eliminar este usuario debido a que tiene prestamos asociados, recomendamos deshabilitar el usuario si ya no sera utilizado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /* comprobando los privilegios*/

        session_start(['name' => 'SPM']);
        if ($_SESSION['privilegio_spm'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No tienes los permisos para eliminar este usuario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_usuario = usuarioModelo::eliminar_usuario_modelo($id);
        if ($eliminar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario eliminado",
                "Texto" => "El usuario ha sido eliminado con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos podido eliminar el usuario, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* fin controlador para eliminar usuario */
    /* Controlador datos del usuario*/
    public  function datos_usuario_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);
        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return usuarioModelo::datos_usuario_modelo($tipo, $id);
    }/* fin controlador datos del usuario */
    /* Controlador para actualizar usuario*/
    public  function actualizar_usuario_controlador()
    {
        //Recibiendo el id 
        $id = mainModel::decryption($_POST['usuario_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //comprobar el usuarioen la bd
        $check_user = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usuario_id='$id'");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos encontrado el usuario en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch();
        }

        $dni = mainModel::limpiar_cadena($_POST['usuario_dni_up']);
        $nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
        $apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_up']);
        $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_up']);
        $direccion = mainModel::limpiar_cadena($_POST['usuario_direccion_up']);
        $usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_up']);
        $email = mainModel::limpiar_cadena($_POST['usuario_email_up']);

        if (isset($_POST['usuario_estado_up'])) {
            $estado = mainModel::limpiar_cadena($_POST['usuario_estado_up']);
        } else {
            $estado = $campos['usuario_estado'];
        }

        if (isset($_POST['usuario_privilegio_up'])) {
            $privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_up']);
        } else {
            $privilegio = $campos['usuario_privilegio'];
        }


        $usuario_admin = mainModel::limpiar_cadena($_POST['usuario_admin']);
        $clave_admin = mainModel::limpiar_cadena($_POST['clave_admin']);



        $tipo_cuenta = mainModel::limpiar_cadena($_POST['tipo_cuenta']);
        /*verificando datos vacios*/
        if ($dni == "" || $nombre == "" || $apellido == "" || $usuario == "" || $usuario_admin == "" || $clave_admin == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*verificando integridad de los datos*/
        if (mainModel::verificar_datos("[0-9-]{1,20}", $dni)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "el dni no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "el nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,35}", $apellido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "el apellido no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9]{8}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "el telfono no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($direccion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "la direccion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];

                echo json_encode($alerta);
                exit();
            }
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9]{5,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "el nombre de usario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9]{5,35}", $usuario_admin)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Tu nombre de usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_admin)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Tu clave  no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
           
        }
       $clave_admin = mainModel::encryption($clave_admin);

        if ($privilegio < 1 || $privilegio > 3) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El privilegio no corresponde a un valor valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($estado != "Activa" && $estado != "Deshabilitada") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El estado de la cuenta no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*vaidar DNI*/
        if ($dni != $campos['usuario_dni']) {
            $check_dni = mainModel::ejecutar_consulta_simple("SELECT usuario_dni FROM usuario WHERE usuario_dni='$dni'");
            if ($check_dni->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El dni ya esta registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /*validar usuario*/
        if ($usuario != $campos['usuario_usuario']) {
            $check_user = mainModel::ejecutar_consulta_simple("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
            if ($check_user->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El usuario ya esta registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /*validar email*/
        if ($email != $campos['usuario_email'] && $email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrio un error inesperado",
                        "Texto" => "El nuevo email ya esta registrado en el sistema",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El email no es valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        //comprobar claves
        if ($_POST['usuario_clave_nueva_1'] != "" || $_POST['usuario_clave_nueva_2'] != "") {
            if ($_POST['usuario_clave_nueva_1'] != $_POST['usuario_clave_nueva_2']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Las nuevas contraseñas ingresadas no coinciden",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $_POST['usuario_clave_nueva_1']) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $_POST['usuario_clave_nueva_2'])) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrio un error inesperado",
                        "Texto" => "Las nuevas contraseñas no coinciden con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $clave = mainModel::encryption($_POST['usuario_clave_nueva_1']);
            }
        } else {
            $clave = $campos['usuario_clave'];
        }
        //comprobando credenciales para actualizar datos
        if ($tipo_cuenta == "Propia") {
            $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_usuario='$usuario_admin' AND usuario_clave='$clave_admin' AND usuario_id='$id'");
        } else {
            session_start(['name'=>"SPM"]);

            if ($_SESSION['privilegio_spm'] != 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "No tienes los permisos necesarios para realizar esta operacion",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_usuario='$usuario_admin' AND usuario_clave='$clave_admin'");
        }
        if ($check_cuenta->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Nombre y clave de administrador no valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_usuario_up= [
            "dni" => $dni,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "telefono" => $telefono,
            "direccion" => $direccion,
            "email" => $email,
            "usuario" => $usuario,
            "clave" => $clave,
            "estado" => $estado,
            "privilegio" => $privilegio,
            "id" => $id
        ];
        
        
        if (usuarioModelo::actualizar_usuario_modelo($datos_usuario_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Actualizado con exito",
                "Texto" => "Los se actualizaron con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se ha podido registrar el usuario",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }/* fin controlador actualizar usuario */
    /* controlador paginar usuario*/
    public function mostrar_usuario_controlador($privilegio, $id)
    {
        
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $id = mainModel::limpiar_cadena($id);
       
        $tabla = "";
        
        if (isset($privilegio) ) {
            //Cuenta cuantos registros hay en la base de datos
            $consulta = "SELECT  * FROM usuario WHERE usuario_id!='$id' AND usuario_id!='1' ORDER BY usuario_id DESC";
        } 
        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $tabla .= '<div class="table-responsive"><table id="example1" class=" table table-striped table-bordered">
        <thead class="bg-info">
        <tr>
        <th>ID</th>
        <th>DNI</th>
        <th>NOMBRE</th>
        <th>APELLIDO</th>
        <th>TELÉFONO</th>
        <th>USUARIO</th>
        <th>EMAIL</th>
        <th>ACTUALIZAR</th>
        <th>ELIMINAR</th>
        </tr>
        </thead>
        <tbody>';
        
           
            foreach ($datos as $rows) {
                $tabla .= '<tr>
                <td>'. $rows['usuario_id'] . '</td>
                <td>' . $rows['usuario_dni'] . '</td>
                <td>' . $rows['usuario_nombre'] . '</td>
                <td>' . $rows['usuario_apellido'] . '</td>
                <td>' . $rows['usuario_telefono'] . '</td>
                <td>' . $rows['usuario_usuario'] . '</td>
                <td>' . $rows['usuario_email'] . '</td>
                <td>
                <a href="' . SERVERURL . 'user-update/' . mainModel::encryption($rows['usuario_id']) . '/" class="btn btn-success">
                      <i class="fas fa-sync-alt"></i>	
                </a>
                </td>
                <td>
                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off">
                     <input type="hidden" name="usuario_id_del" value="' . mainModel::encryption($rows['usuario_id']) . '">
                        <button type="submit" class="btn btn-warning">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
               </tr>';
                
            }
            
        
        $tabla .= '</tbody></table></div>';

        



        return $tabla;
    }/*fin controlador  paginar usuario */
    
}/* fin clase */
