<?php
if ($peticionAjax) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}
class loginControlador extends loginModelo
{
    /* Contolador para iniciar sesion */
    public function iniciar_sesion_controlador()
    {
        $usuario = mainModel2::limpiar_cadena($_POST['usuario_log']);
        $clave = mainModel2::limpiar_cadena($_POST['clave_log']);
        /* validar campos vacios */
        if ($usuario == "" || $clave == "") {
            echo '<script>
            Swal.fire({
                title: "OCURRIÓ UN ERROR INESPERADO",
                text: "CAMPOS VACÍOS, USUARIO Y/O CONTRASEÑA ",
                type: "error",
                confirmButtonText:"Aceptar"
              });
            </script>';
            exit();
        }
        /* verificando integridad de los datos */
        if (mainModel2::verificar_datos("[a-zA-Z]{5,20}", $usuario)) {
            echo '<script>
            Swal.fire({
                title: "OCURRIÓ UN ERROR INESPERADO",
                text: "EL CAMPO USUARIO SOLO DEBE INCLUIR LETRAS Y DEBE TENER UN MÍNIMO DE 5 LETRAS",
                type: "error",
                confirmButtonText:"Aceptar"
              });
            </script>';
            exit();
        }
        if (mainModel2::verificar_datos("[a-zA-Z0-9$@$!%*?.#-_+]{8,20}", $clave)) {
            echo '<script>
            Swal.fire({
                title: "OCURRIÓ UN ERROR INESPERADO",
                text: "EL CAMPO CONTRASEÑA SOLO PERMITE ESTOS CARACTERES ESPECIALES $@$!%*?.#-_+",
                type: "error",
                confirmButtonText:"Aceptar"
              });
            </script>';
            exit();
        }
        $clave = mainModel2::encryption($clave);
        /* Envio de array de datos al modelo */
        $datos_login = [
            "usuario" => $usuario,
            "clave" => $clave
        ];
        $datos_cuenta = loginModelo::iniciar_sesion_modelo($datos_login);
        if ($datos_cuenta->rowCount() == 1) {
            $row = $datos_cuenta->fetch();
            session_start();
            $_SESSION['id_spm'] = $row['usu_id'];
            $_SESSION['nombre_spm'] = $row['usu_nombre'];
            $_SESSION['apellido_spm'] = $row['usu_apellido'];
            $_SESSION['usuario_spm'] = $row['usu_usuario'];
            $_SESSION['estado_spm'] = $row['usu_estado'];
            $_SESSION['token_spm'] = md5(uniqid(mt_rand(), true));
            if ( $_SESSION['estado_spm']=='ACTIVO') {
                return header("Location:" . SERVERURL . "home/");
            }elseif ($_SESSION['estado_spm']=='NUEVO') {
                return header("Location:" . SERVERURL . "cambio-contraseña/");
            }else {
                echo '<script>
            Swal.fire({
                title: "OCURRIÓ UN ERROR INESPERADO",
                text: "TU USUARIO HA SIDO BLOQUEADO CONTACTA CON EL ADMINISTRADOR DEL SISTEMA",
                type: "error",
                confirmButtonText:"Aceptar"
              }).then((result) => {
                if (result.value) {
                    window.location.href ="'.SERVERURL.'login/";
                }
            });
            </script>';
            }   
        } else {
            
            echo '<script>
            Swal.fire({
                title: "OCURRIÓ UN ERROR INESPERADO",
                text: "USUARIO Y/O CONTRASEÑA INCORRECTAS",
                type: "error",
                confirmButtonText:"Aceptar"
              });  
            </script>';
        }
    }/* Fin del controlador iniciar sesion*/
    /* Controlador para forzar el cierre de sesion*/
    public function forzar_cierre_sesion_controlador()
    {
        session_unset();
        session_destroy();
        /* verificar si se estan enviando encabezados*/
        if (headers_sent()) {
            return "<script> window.location.href='" . SERVERURL . "login/'</script>";
        } else {
            return header("Location: " . SERVERURL . "login/");
        }
    }/* Fin del controlador forzar cierre sesion*/
    /* Contolador cierre sesion*/
    public function cerrar_sesion_controlador()
    {
        session_start();
        $token = mainModel2::decryption($_POST['token']);
        $usuario = mainModel2::decryption($_POST['usuario']);
        if ($token == $_SESSION['token_spm'] && $usuario == $_SESSION['usuario_spm']) {
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL . "login/",
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE PUDO CERRAR LA SESIÓN EN EL SISTEMA",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    } /* Contolador cierre sesion*/
}
