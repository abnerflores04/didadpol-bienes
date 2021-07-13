<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['depto_reg']) ){
    #Instancia al controlador
    require_once "../controladores/reportesControlador.php";
    $ins_reportes= new reportesControlador(); 
    #Para agregar un rol
    if (isset($_POST['depto_reg'])){
        echo $ins_reportes->listar_exp_reportes2();
    }
    
  
    
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}
