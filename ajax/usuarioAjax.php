<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['usu_usuario_reg'])){
    #Instancia al controlador
    require_once "../controladores/usuarioControlador.php";
    $ins_usuario= new usuarioControlador(); 
    #Para agregar un usuario
    if (isset($_POST['usu_usuario_reg']) && isset ($_POST['usu_nombres_reg']) && isset ($_POST['usu_apellidos_reg']) && isset ($_POST['usu_correo_reg'])){
        echo $ins_usuario->agregar_usuario_controlador();
    }
    /*Para eliminar un usuario
    if (isset($_POST['usuario_id_del'])){
        echo $ins_usuario->eliminar_usuario_controlador();
    }
    #Para actualizar un usuario
    if (isset($_POST['usuario_id_up'])){
        echo $ins_usuario->actualizar_usuario_controlador();
    }*/
    
} else {
    session_start(['name'=>"DB"]);
    session_unset();
    session_destroy();
    header("location:".SERVERURL."login/");
    exit();
}
