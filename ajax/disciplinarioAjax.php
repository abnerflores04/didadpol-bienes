<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['n_exp_i_reg']) || isset($_POST['proc_disciplinario_id_up'])){
    #Instancia al controlador
    require_once "../controladores/disciplinarioControlador.php";
    $ins_disciplinario= new disciplinarioControlador(); 
    
    
    #Para actualizar proc disciplinario
    if (isset($_POST['proc_disciplinario_id_up'])){
        echo $ins_disciplinario->actualizar_proc_disciplinario_controlador();
    }
    
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}
