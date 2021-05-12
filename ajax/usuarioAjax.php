<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['usu_usuario_reg']) || isset($_POST['clave_c']) || isset($_POST['conf_clave_c']) || isset($_POST['correo_res']) || isset($_POST['usu_id_up'])){
    #Instancia al controlador
    require_once "../controladores/usuarioControlador.php";
    require_once "../controladores/usuarioControlador2.php";
    $ins_usuario= new usuarioControlador(); 
    $ins_usuario2= new usuarioControlador2();
    #Para agregar un usuario
    if (isset($_POST['usu_usuario_reg']) && isset ($_POST['usu_nombres_reg']) && isset ($_POST['usu_apellidos_reg']) && isset ($_POST['usu_correo_reg'])){
        echo $ins_usuario->agregar_usuario_controlador();
    }
    #Para cambiar la contraseña del usuario
    if (isset($_POST['clave_c']) && isset($_POST['conf_clave_c'])){
        echo $ins_usuario->cambiar_contra_usuario_controlador();
    }
    #Para restablecer la contraseña del usuario
    if (isset($_POST['correo_res'])){
        echo $ins_usuario->restablecer_contra_usuario_controlador();
    }
    #Para actualizar un usuario
    if (isset($_POST['usu_id_up'])){
        echo $ins_usuario2->actualizar_usuario_controlador();
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
