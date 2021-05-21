<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['motorista_sal_reg']) || isset( $_POST['colaboradores_sal_reg']) || isset( $_POST['gira_id_up']) || isset($_POST['motorista_gira_up']) || isset($_POST['colaboradores_gira_up']) || isset($_POST['gira_id_del'])){
    
    #Instancia al controlador
    require_once "../controladores/salidaControlador.php";
    $ins_salida= new salidaControlador(); 
    #Para agregar salida
    if (isset($_POST['motorista_sal_reg']) && isset($_POST['colaboradores_sal_reg']) && isset($_POST['tipo_sal_reg']) && isset($_POST['fecha_sal_reg']) && isset($_POST['observacion_sal_reg'])){
        echo $ins_salida->agregar_salida_controlador();
    }
    #Para actualizar gira
    if (isset($_POST['gira_id_up']) && isset($_POST['motorista_gira_up']) && isset($_POST['colaboradores_gira_up']) && isset($_POST['fecha_gira_up']) && isset($_POST['observacion_gira_up'])){
        echo $ins_salida->actualizar_gira_controlador();
    }
    /*#Para eliminar un usuario
    if (isset($_POST['rol_id_del'])){
        echo $ins_rol->eliminar_rol_controlador();
    }*/
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}
