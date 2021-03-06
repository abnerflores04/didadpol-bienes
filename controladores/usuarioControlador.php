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
        $nombres = strtoupper(mainModel::limpiar_cadena($_POST['usu_nombres_reg']));
        $apellidos = strtoupper(mainModel::limpiar_cadena($_POST['usu_apellidos_reg']));
        $identidad=mainModel::limpiar_cadena($_POST['usu_identidad_reg']);
        $puesto=mainModel::limpiar_cadena($_POST['usu_puesto_reg']);
        $unidad=mainModel::limpiar_cadena($_POST['usu_unidad_reg']);
        $rol = mainModel::limpiar_cadena($_POST['usu_rol_reg']);
        $celular = mainModel::limpiar_cadena($_POST['usu_celular_reg']);
        $usuario = strtolower(mainModel::limpiar_cadena($_POST['usu_usuario_reg']));
        $email=$usuario . '@didadpol.gob.hn' ;


        /*comprobar campos vacios*/
        if ($nombres == "" || $apellidos == "" || $usuario == ""  || $email == "" || $rol == "" || $identidad == "" || $puesto == "" || $unidad == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{3,35}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRES SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 3 LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ ]{3,35}", $apellidos)) {
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
            if (mainModel::verificar_datos("[0-9]{8}", $celular)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL NÚMERO DE CELULAR NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if (mainModel::verificar_datos("[0-9]{13}", $identidad)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL NÚMERO DE IDENTIDAD NO COINCIDE CON EL FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
         /*validar DNI*/
         $check_dni = mainModel::ejecutar_consulta_simple("SELECT identidad FROM tbl_usuarios WHERE identidad='$identidad'");
         if ($check_dni->rowCount() > 0) {
             $alerta = [
                 "Alerta" => "simple",
                 "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                 "Texto" => "EL NÚMERO DE IDENTIDAD YA ESTÁ REGISTRADO",
                 "Tipo" => "error"
             ];
             echo json_encode($alerta);
             exit();
         }

        if (mainModel::verificar_datos("[a-z]{3,15}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRE DE USUARIO SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 5 Y UN MAXIMO DE 15 LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*validar usuario*/
        $check_user = mainModel::ejecutar_consulta_simple("SELECT nom_usuario FROM tbl_usuarios WHERE nom_usuario='$usuario'");
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
        /*validar email*/

       
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $pass = "";
        for ($i = 0; $i < 8; $i++) {
            $pass .= substr($caracteres, rand(0, 64), 1);
        }
        $message  = "<html><body><p>Hola, " . $nombres . " " . $apellidos;
        $message .= " Estas son tus credenciales para ingresar al sistema de DIDADPOL";
        $message .= "</p><p>Usuario: " . $usuario;
        $message .= "</p><p>Correo: " . $email;
        $message .= "</p><p>Contraseña: " . $pass;
        $message .= "</p><p>Inicie sesión aquí para cambiar la contraseña por defecto " . SERVERURL . "login";
        $message .= "<p></body></html>";

        $res = mainModel::enviar_correo($message, $nombres, $apellidos, $email);
        if (!$res) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE ENVIÓ CORREO ELECTRÓNICO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $passcifrado = mainModel::encryption($pass);

        $datos_usuario_reg = [
            "rol" => $rol,
            "puesto"=>$puesto,
            "unidad"=>$unidad,
            "usuario" => $usuario,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "dni"=>$identidad,
            "clave" => $passcifrado,
            "estado" => "NUEVO",
            "email" => $email,
            "celular" => $celular
        ];
        $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);
        if ($agregar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "USUARIO REGISTRADO",
                "Texto" => "LOS DATOS DEL USUARIO SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL USUARIO",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*fin controlador */
    /*controlador para cambiar contraseña usuario */
    public  function cambiar_contra_usuario_controlador()
    {
        $id_c = mainModel::decryption($_POST['id_c']);
        $id_c = mainModel::limpiar_cadena($id_c);
        $clave_c = mainModel::limpiar_cadena($_POST['clave_c']);
        $conf_clave_c = mainModel::limpiar_cadena($_POST['conf_clave_c']);
        if ($clave_c == "" || $conf_clave_c == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS LLENADO TODOS LOS CAMPOS CONTRASEÑA Y/O CONFIRMAR CONTRASEÑA VACÍA",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?.#-_+])([A-Za-z\d$@$!%*?.#-_+]|[^ ]){8,15}", $clave_c) || mainModel::verificar_datos("(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?.#-_+])([A-Za-z\d$@$!%*?.#-_+]|[^ ]){8,15}", $conf_clave_c)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "LAS CONTRASEÑAS NO COINCIDE CON EL FORMATO SOLICITADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*validar contraseñas sean las mismas*/
        if ($clave_c != $conf_clave_c) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "LAS CONTRASEÑAS NO COINCIDEN",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $clave = mainModel::encryption($clave_c);
        }
        $datos_cambio_contra = [
            "clave" => $clave,
            "estado_c" => 'ACTIVO',
            "id_c" => $id_c
        ];
        if (usuarioModelo::cambiar_clave_modelo($datos_cambio_contra)) {
            session_start();
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "cambio",
                "Titulo" => "BIEN",
                "Texto" => "LA CONTRASEÑA SE ACTUALIZO CON ÉXITO",
                "Tipo" => "success",
                "URL" => SERVERURL . "login/",
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ACTUALIZAR LA CONTRASEÑA",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }/* fin controlador para cambiar contraseña usuario */
    /*controlador para cambiar contraseña usuario */
    public  function restablecer_contra_usuario_controlador()
    {
        $correo_res = strtolower(mainModel::limpiar_cadena($_POST['correo_res']));
        /*comprobar campos vacios*/
        if ($correo_res == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "CAMPO VACÍO, INGRESE CORREO ELECTRÓNICO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (filter_var($correo_res, FILTER_VALIDATE_EMAIL)) {
            $check_correo = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_usuarios WHERE email='$correo_res'");
            if ($check_correo->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "ESA DIRECCIÓN NO ES VÁLIDA, NO ES UN CORREO ELECTRÓNICO PRINCIPAL VERIFICADO O NO ESTÁ ASOCIADA CON UNA CUENTA DE USUARIO PERSONAL",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $campos = $check_correo->fetch();
            }
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CORREO ELECTRÓNICO NO VALIDO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        session_start();
        $_SESSION['id_spm'] = $campos['usuario_id'];

        $message  = "<html><body><p aling='center'>Restablecimiento contraseña de DIDADPOL | BIENES</p><p>HOLA, " . $campos['nombre'] . " " . $campos['apellido'] . " escuchamos que perdió su contraseña ¡Lo siento por eso!</p><p>¡Pero no te preocupes! Puede utilizar el siguiente enlace para restablecer contraseña:</p><p><a href='" . SERVERURL . "restablecer-contraseña/'>Restablecer contraseña</a></p></body></html>";

        $res = mainModel::enviar_correo($message, $campos['nombre'], $campos['apellido'], $correo_res);
        if (!$res) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE ENVIÓ CORREO ELECTRÓNICO",
                "Tipo" => "error"
            ];
        } else {
            $alerta = [
                "Alerta" => "cambio",
                "Titulo" => "BIEN",
                "Texto" => "REVISE SU CORREO ELECTRÓNICO PARA ENCONTRAR UN ENLACE PARA RESTABLECER SU CONTRASEÑA. SI NO APARECE EN UNOS MINUTOS, REVISE SU CARPETA DE CORREO NO DESEADO",
                "Tipo" => "success",
                "URL" => SERVERURL . "login/",
            ];
        }
        echo json_encode($alerta);
        exit();
    }
}/* fin clase */
