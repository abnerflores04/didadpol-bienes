<?php
if ($peticionAjax) {
    require_once "../modelos/solicitudModelo.php";
} else {
    require_once "./modelos/solicitudModelo.php";
}
class solicitudControlador extends solicitudModelo
{
    /* controlador agregar solicitud*/
    public function agregar_solicitud_controlador()
    {
       
        $depto = $_POST['depto'];
        

        /*comprobar campos vacios*/
        if ($depto == "" ) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
       

        
        $agregar_solicitud =  solicitudModelo::agregar_solicitud_modelo($depto);

      
        if ($agregar_solicitud->rowCount() > 0)  {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "solicitud REGISTRADA",
                "Texto" => "LOS DATOS DE LA solicitud SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL solicitud",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*fin controlador */

}/* fin clase */
