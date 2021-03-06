<?php
if ($peticionAjax) {
    require_once "../config/SERVER.php";
} else {
    require_once "./config/SERVER.php";
}
class mainModel2
{
    /* Funcion para conectar a BD*/
    public static function conectar()
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
        if (preg_match("/^" . $filtro . "+$/", $cadena)) {
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

    public static function addWorkingDays($fecha, $dias, $feriados = [])
    {
        // mover fecha los d??as solicitados
        $start = $end = strtotime($fecha);
        $dia = date('N', $start);
        if ($dias == 0) {
            if ($dia == 6) $end = $start + 2 * 86400;
            else if ($dia == 7) $end = $start + 86400;
        } else {
            $total = $dia + $dias;
            $fds = (int)($total / 5) * 2;
            if ($total % 5 == 0) $fds -= 2;
            $end = $start + ($dias + $fds) * 86400;
        }
        $nuevaFecha = date('Y-m-d', $end);
        // ver si hay feriados, por cada feriado encontrado mover un d??a h??bil
        // la fecha, hacer esto hasta que no hayan m??s d??as feriados en el rango
        // que se movi?? la fecha
        while (($dias = self::countDaysMatch($fecha, $nuevaFecha, $feriados, true)) != 0) {
            $fecha = date('Y-m-d', strtotime($nuevaFecha) + 86400);
            $nuevaFecha = self::addWorkingDays($nuevaFecha, $dias);
        }
        // retornar fecha
        return $nuevaFecha;
    }
    public static function countDaysMatch($from, $to, $days, $excludeWeekend = false)
    {
        $count = 0;
        $date = strtotime($from);
        $end = strtotime($to);
        while ($date <= $end) {
            $dayOfTheWeek = date('N', $date);
            if ($excludeWeekend && ($dayOfTheWeek == 6 || $dayOfTheWeek == 7)) {
                $date += 86400;
                continue;
            }
            if (in_array(date('Y-m-d', $date), $days))
                $count++;
            $date += 86400;
        }
        return $count;
    }
    public static function getWorkingDays($startDate, $endDate, $holidays)
    {
        // hacer c??lculos de tiempo inicial solo una vez 
        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);

        //El n??mero total de d??as entre las dos fechas. Calculamos el no. de segundos y dividirlo entre 60 * 60 * 24 
        //Agregamos uno para incluir ambas fechas en el intervalo. 
        $days = ($endDate - $startDate) / 86400 + 1;

        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);

        //Devolver?? 1 si es lunes, 7 para el domingo. 
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);


        //---->Los dos pueden ser iguales en a??os bisiestos cuando febrero tiene 29 d??as, el signo igual se agrega aqu?? 
        //En el primer caso, el intervalo completo est?? dentro de una semana, en el segundo caso, el intervalo cae en dos semanas. 
        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week)  $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        } else {

            // (editar por Tokes para arreglar un caso de borde donde el d??a de inicio era un domingo 
            // y el d??a final NO fue s??bado)
            // el d??a de la semana de inicio es posterior al d??a de la semana de finalizaci??n 
            if ($the_first_day_of_week == 7) {
                // si la fecha de inicio es un domingo, definitivamente restamos 1 d??a 
                $no_remaining_days--;
                if ($the_last_day_of_week == 6) {
                    // si la fecha de finalizaci??n es un s??bado, restamos otro d??a 
                    $no_remaining_days--;
                }
            } else {
                // la fecha de inicio fue un s??bado (o antes) y la fecha de finalizaci??n fue (lunes, viernes) 
                // as?? que saltamos un fin de semana completo y restamos 2 d??as 
                $no_remaining_days -= 2;
            }
        }
        //El no. de d??as h??biles es: (n??mero de semanas entre las dos fechas) * (5 d??as h??biles) + el resto 
        //---->febrero en ninguno de los a??os bisiestos dio un resto de 0, pero a??n as?? se calcularon los fines de semana entre el primer y el ??ltimo d??a, esta es una forma de solucionarlo 
        $workingDays = $no_full_weeks * 5;
        if ($no_remaining_days > 0) {
            $workingDays += $no_remaining_days;
        }
        //Nosotros restamos las vacaciones
        foreach ($holidays as $holiday) {
            $time_stamp = strtotime($holiday);
            //Si las vacaciones no caen en fin de semana  
            if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N", $time_stamp) != 6 && date("N", $time_stamp) != 7)
                $workingDays--;
        }
        return $workingDays;
    }
}
