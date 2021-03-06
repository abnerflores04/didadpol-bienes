<?php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($peticionAjax) {
    require_once "../config/SERVER.php";
} else {
    require_once "./config/SERVER.php";
}
class mainModel
{
    /* Funcion para conectar a BD*/
    protected static function conectar()
    {
        $conexion = new PDO(SGBD, USER, PASS);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }
    /* Funcion para ejecutar consultas simples*/
    protected static function ejecutar_consulta_simple($consulta)
    {
        /* self hacemos referencia a una  o metodo de la misma clase*/
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }
    /* Encriptar cadenas*/
    public  function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
    /*desenincriptar cadena*/
    protected static function decryption($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    /*Funcion para generar codigos aleatorios*/
    protected static function generar_codigo_aleatorio($letra, $longitud, $numero)
    {
        for ($i = 1; $i <= $longitud; $i++) {
            $aleatorio = rand(0, 9);
            $letra .= $aleatorio;
        }
        return $letra . "-" . $numero;
    }
    /*Funcion par limpiar cadenas(inyeccion sql)*/
    protected static function limpiar_cadena($cadena)
    {
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src>", "", $cadena);
        $cadena = str_ireplace("<script type>", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::>", "", $cadena);
        $cadena = str_ireplace("||", "", $cadena);
        $cadena = str_ireplace("&", "", $cadena);
        $cadena = str_ireplace("|", "", $cadena);
        /*elimina barras invertidas*/
        $cadena = stripslashes($cadena);
        $cadena = trim($cadena);
        return $cadena;
    }
    /*Funcion para verificar datos*/
    protected static function verificar_datos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }
    /*Funcion para verificar fechas*/
    protected static function verificar_fecha($fecha)
    {
        $valores = explode('-', $fecha);
        if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
            return false;
        } else {
            return true;
        }
    }
    /*Funcion para enviar correo*/
    protected static function enviar_correo($msj, $nombres, $apellidos, $correo)
    {
        $nombreCompleto = $nombres . " " . $apellidos;
        // La creaci??n de instancias y pasar `true` permite excepciones
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                       // Habilitar salida de depuraci??n detallada
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                            // Enviar usando SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Configure el servidor SMTP para enviar a trav??s de
        $mail->SMTPAuth   = true;                                   // Habilitar autenticaci??n SMTP
        $mail->Username   = 'didadpol@gmail.com';                     // SMTP usuario
        $mail->Password   = 'Power%2021';                               // SMTP contrase??a
        $mail->SMTPSecure = 'tsl';         // Habilitar el cifrado TLS; `PHPMailer :: ENCRYPTION_SMTPS` tambi??n aceptado
        $mail->Port       = 587;                                    // Puerto TCP para conectarse

        //Destinatarios
        $mail->setFrom('didadpol@gmail.com', 'DIDADPOL');    //desde donde se va enviar
        $mail->addAddress($correo, $nombreCompleto);     // Agregar un destinatario

        $mail->isHTML(true);                                  // Establecer formato de correo electr??nico a HTML
        $mail->Subject = 'DIDADPOL';
        $mail->Body    = $msj;
        return $mail->send();
    }
}
