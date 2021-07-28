<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['n_exp_i_reg']) || isset($_POST['proc_penal_id_up'])){
    #Instancia al controlador
    require_once "../controladores/penalControlador.php";
    $ins_penal= new penalControlador(); 
    #Para agregar un proc penal
    if (isset($_POST['n_exp_i_reg'])){
        echo $ins_penal->agregar_proc_penal_controlador();
    }
    
    #Para actualizar proc penal
    if (isset($_POST['proc_penal_id_up'])){
        echo $ins_penal->actualizar_proc_penal_controlador();
    }
    
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}
