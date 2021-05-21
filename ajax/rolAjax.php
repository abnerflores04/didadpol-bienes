<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['rol_nombre_reg']) || isset($_POST['rol_id_up']) || isset($_POST['rol_id_del'])){
    #Instancia al controlador
    require_once "../controladores/rolControlador.php";
    $ins_rol= new rolControlador(); 
    #Para agregar un rol
    if (isset($_POST['rol_nombre_reg'])){
        echo $ins_rol->agregar_rol_controlador();
    }
    
    #Para actualizar un rol
    if (isset($_POST['rol_id_up']) && isset($_POST['rol_nombre_up'])){
        echo $ins_rol->actualizar_rol_controlador();
    }
    #Para eliminar un usuario
    if (isset($_POST['rol_id_del'])){
        echo $ins_rol->eliminar_rol_controlador();
    }
    
    
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}
