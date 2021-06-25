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
        // mover fecha los días solicitados
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
        // ver si hay feriados, por cada feriado encontrado mover un día hábil
        // la fecha, hacer esto hasta que no hayan más días feriados en el rango
        // que se movió la fecha
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
    public static function getWorkingDays($startDate,$endDate,$holidays){ 
        // do strtotime calculations just once 
        $endDate = strtotime($endDate); 
        $startDate = strtotime($startDate);
    
        //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24 
        //We add one to inlude both dates in the interval.
         $days = ($endDate - $startDate) / 86400 + 1;
    
         $no_full_weeks = floor($days / 7);
          $no_remaining_days = fmod($days, 7);
    
    //It will return 1 if it's Monday,.. ,7 for Sunday
     $the_first_day_of_week = date("N", $startDate); 
     $the_last_day_of_week = date("N", $endDate);
    
    
          //---->The two can be equal in leap years when february has 29 days, the equal sign is added here 
          //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
           if ($the_first_day_of_week <= $the_last_day_of_week) { 
               if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week)  $no_remaining_days--;
                if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--; 
            } else {
    
            // (edit by Tokes to fix an edge case where the start day was a Sunday 
            // and the end day was NOT a Saturday) 
            // the day of the week for start is later than the day of the week for end 
            if ($the_first_day_of_week == 7) { 
                // if the start date is a Sunday, then we definitely subtract 1 day
                 $no_remaining_days--; 
                if ($the_last_day_of_week == 6) { 
                    // if the end date is a Saturday, then we subtract another day
                     $no_remaining_days--; 
                    }
                     }
                     else { 
                         // the start date was a Saturday (or earlier), and the end date was (Mon..Fri) 
                         // so we skip an entire weekend and subtract 2 days 
                         $no_remaining_days -= 2; 
                        }
                    }
    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder 
    //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it 
    $workingDays = $no_full_weeks * 5;
     if ($no_remaining_days > 0 ) { 
         $workingDays += $no_remaining_days; 
    }
    //We subtract the holidays 
    foreach($holidays as $holiday){ 
        $time_stamp=strtotime($holiday); 
        //If the holiday doesn't fall in weekend 
        if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
         $workingDays--; 
        } 
        return $workingDays; 
    }
}
