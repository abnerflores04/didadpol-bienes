<?php
$peticionAjax = true;
require_once "../config/APP.php";
if (isset($_POST['depto'])) {
    #Instancia al controlador
    require_once "../controladores/solicitudControlador.php";
    $ins_solicitud = new solicitudControlador();
    #Para agregar un rol
    if (isset($_POST['depto'])) {
        echo $ins_solicitud->agregar_solicitud_controlador();
    }
} else {
    session_start();
    session_unset();
    session_destroy();
    header("location:" . SERVERURL . "login/");
    exit();
}
