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
        $correo_p =strtolower( mainModel::limpiar_cadena($_POST['usu_correo_reg']));
        $correo_i=$usuario.'@didadpol.gob.hn';
        
        /*comprobar campos vacios*/
        if ( $nombres == "" || $apellidos == "" || $usuario == ""  || $correo_p == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[A-ZÁÉÍÓÚÑ ]{3,35}", $nombres)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO NOMBRES SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 3 LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[A-ZÁÉÍÓÚÑ ]{3,35}", $apellidos)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO APELLIDOs SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 3 LETRAS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($celular != "") {
            if (mainModel::verificar_datos("[0-9-]{9}", $celular)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL TELÉFONO NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        
        if (mainModel::verificar_datos("[a-z]{5,15}", $usuario)) {
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
        $check_user = mainModel::ejecutar_consulta_simple("SELECT usu_usuario FROM tbl_usuario WHERE usu_usuario='$usuario'");
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
        
            if (filter_var($correo_p, FILTER_VALIDATE_EMAIL)) {
                /*vaidar email repetido*/
                $check_email = mainModel::ejecutar_consulta_simple("SELECT usu_correo_p FROM tbl_usuario WHERE usu_correo_p='$correo_p'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                        "Texto" => "EL CORREO YA ESTÁ REGISTRADO",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL CORREO NO COINCIDE CON EL FORMATO SOLICITADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $pass = "";
        for ($i = 0; $i < 8; $i++) {
            $pass .= substr($caracteres, rand(0, 64), 1);
        }
        $message  = "<html><body><p>HOLA, ".$nombres." ".$apellidos;
        $message .= " ESTAS SON TUS CREDENCIALES PARA INGRESAR AL SISTEMA DE BIENES DIDADPOL";
        $message .= "</p><p>USUARIO: ".$usuario;
        $message .= "</p><p>CORREO: ".$correo_i;
        $message .= "</p><p>CONTRASEÑA: ".$pass;
        $message .= "</p><p>INICIE SESIÓN AQUÍ PARA CAMBIAR LA CONTRASEÑA POR DEFECTO ".SERVERURL."login";
        $message.="<p></body></html>";
        
        $res = mainModel::enviar_correo($message,$nombres,$apellidos,$correo_i);
        if(!$res)
        {
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
            "usuario" => $usuario,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "clave" => $passcifrado,
            "estado" => "NUEVO",
            "correo_i" => $correo_i,
            "correo_p" => $correo_p,
            "celular" => $celular,  
        ];
        $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);
        if ($agregar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "USUARIO REGISTRADO",
                "Texto" => "LOS DATOS DEL USUARIO SE REGISTRADO CON ÉXITO",
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
        $id_c= mainModel::limpiar_cadena($_POST['id_c']);
        $clave_c = mainModel::limpiar_cadena($_POST['clave_c']);
        $conf_clave_c = mainModel::limpiar_cadena($_POST['conf_clave_c']);
        if ($clave_c == "" || $conf_clave_c == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}", $clave_c) || mainModel::verificar_datos("(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}", $conf_clave_c)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "las claves de usario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*validar contraseñas sean las mismas*/
        if ($clave_c != $conf_clave_c) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Las contraseñas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $clave = mainModel::encryption($clave_c);
        }
        $datos_cambio_contra = [
            "clave" => $clave,
            "estado_c"=>'ACTIVO',
            "id_c" => $id_c
        ];
        if (usuarioModelo::cambiar_clave_modelo($datos_cambio_contra)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Actualizado con exito",
                "Texto" => "Las contraseñas se actualizaron con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se ha podido actualizar las contraseñas",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
      }/* fin controlador para cambiar contraseña usuario */
    
}/* fin clase */
