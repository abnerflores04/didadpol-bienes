<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['n_exp_reg']) || isset($_POST['exp_id_up']) || isset($_POST['exp_id_del'])){
    #Instancia al controlador
    require_once "../controladores/expedienteControlador.php";
    $ins_expediente= new expedienteControlador();
    #Para agregar un expediente
    if (isset($_POST['n_exp_reg'])){
        echo $ins_expediente->agregar_proceso_denuncia_controlador();
    }
    
    
    #Para actualizar un usuario
    if (isset($_POST['exp_id_up'])){
        echo $ins_expediente->actualizar_expediente_controlador();
    }
    /*Para eliminar un usuario
    if (isset($_POST['usuario_id_del'])){
        echo $ins_usuario->eliminar_usuario_controlador();
    }*/
    
    
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}