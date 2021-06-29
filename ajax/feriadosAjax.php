<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['fecha_feriado_reg']) ||  isset($_POST['id_feriado_up']) ||  isset($_POST['id_feriado_del'])){
    #Instancia al controlador
    require_once "../controladores/feriadosControlador.php";
    $ins_feriados= new feriadosControlador(); 
    #Para agregar un feriados
    if (isset($_POST['fecha_feriado_reg']) && isset ($_POST['descrip_feriado_reg']) ){
        echo $ins_feriados->agregar_feriados_controlador();
    }
   
    #Para actualizar un feriados
    if (isset($_POST['id_feriado_up']) && isset($_POST['fecha_feriado_up']) && isset($_POST['descrip_feriado_up'])){
        echo $ins_feriados->actualizar_feriados_controlador();
    }
    #Para eliminar un feriados
    if (isset($_POST['id_feriado_del'])){
        echo $ins_feriados->eliminar_feriado_controlador();
    }
    
    
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}
