<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['n_exp_reg']) || isset($_POST['exp_id_up']) || isset($_POST['exp_id_del']) || isset($_POST['bit_id'])|| isset($_POST['bit_id_3']) || isset($_POST['bit_id_4']) || isset($_POST['bit_id_5']) || isset($_POST['bit_id_6']) || isset($_POST['bit_id_7']) || isset($_POST['bit_id_8']) || isset($_POST['bit_id_9']) || isset($_POST['bit_id_10']) || isset($_POST['bit_id_11']) || isset($_POST['bit_id_12']) || isset($_POST['bit_id_13']) || isset($_POST['bit_id_14']) || isset($_POST['bit_id_15'])){
    #Instancia al controlador
    require_once "../controladores/expedienteControlador.php";
    $ins_expediente= new expedienteControlador();
    #Para agregar un expediente
    if (isset($_POST['n_exp_reg'])){
        echo $ins_expediente->agregar_proceso_denuncia_controlador();
    }
      #Para pasar al proceso de emision
      if (isset($_POST['bit_id'])){
        echo $ins_expediente->agregar_proceso_emision_controlador();
    }
     #Para pasar al proceso de admision
     if (isset($_POST['bit_id_3'])){
        echo $ins_expediente->agregar_proceso_admision_controlador();
    }
     #Para pasar al proceso de asignacion de expediente a investigador
     if (isset($_POST['bit_id_4'])){
        echo $ins_expediente->agregar_proceso_asig_i_controlador();
    }
    #Para pasar al proceso de emision a direccion
    if (isset($_POST['bit_id_5'])){
        echo $ins_expediente->agregar_proceso_emision_direccion_controlador();
    }
    #Para pasar al proceso de auto apertura
    if (isset($_POST['bit_id_6'])){
        echo $ins_expediente->agregar_proceso_apertura_controlador();
    }
     #Para pasar al proceso de comunicacion
     if (isset($_POST['bit_id_7'])){
        echo $ins_expediente->agregar_proceso_comunicacion_controlador();
    }
    #Para pasar al proceso recepcion investigacion
    if (isset($_POST['bit_id_8'])){
        echo $ins_expediente->agregar_proceso_recep_invest_controlador();
    }
    #Para pasar al proceso estado del proceso
    if (isset($_POST['bit_id_9'])){
        echo $ins_expediente->agregar_proceso_estado_controlador();
    }
    #Para pasar al proceso validacion
    if (isset($_POST['bit_id_10'])){
        echo $ins_expediente->agregar_proceso_validacion_controlador();
    }
    #Para pasar al proceso recepcion secretaria
    if (isset($_POST['bit_id_11'])){
        echo $ins_expediente->agregar_proceso_recep_secretaria_controlador();
    }
    #Para pasar al proceso recepcion secretaria
    if (isset($_POST['bit_id_12'])){
        echo $ins_expediente->agregar_proceso_citacion_controlador();
    }
    #Para pasar al proceso remision secretaria
    if (isset($_POST['bit_id_13'])){
        echo $ins_expediente->agregar_proceso_remi_legal_controlador();
    }
    #Para pasar al proceso asignacion tecnico legal
    if (isset($_POST['bit_id_14'])){
        echo $ins_expediente->agregar_proceso_asig_l_controlador();
    }
    #Para pasar al proceso dictamen
    if (isset($_POST['bit_id_15'])){
        echo $ins_expediente->agregar_proceso_dictamen_controlador();
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