<?php
$peticionAjax=true;
require_once "../config/APP.php";
if (isset($_POST['n_exp_reg']) || isset($_POST['exp_id_up']) || isset($_POST['exp_id_del']) || isset($_POST['bit_id']) 
    || isset($_POST['bit_id_3']) || isset($_POST['bit_id_4']) || isset($_POST['bit_id_5']) || isset($_POST['bit_id_6']) 
    || isset($_POST['bit_id_7']) || isset($_POST['bit_id_8']) || isset($_POST['bit_id_9']) || isset($_POST['bit_id_10']) 
    || isset($_POST['bit_id_11']) || isset($_POST['bit_id_12']) || isset($_POST['bit_id_13']) || isset($_POST['bit_id_14']) 
    || isset($_POST['bit_id_15']) || isset($_POST['bit_id_16']) || isset($_POST['bit_id_17']) || isset($_POST['bit_id_18']) 
    || isset($_POST['bit_id_19']) || isset($_POST['bit_id_40']) || isset($_POST['diligencia_pre']) || isset($_POST['diligencias_invest'])
    || isset($_POST['diligencia_cita']) || isset($_POST['diligencias_legal']) || isset($_POST['bit_id_50'])){
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
    #Para pasar al proceso devolucion
    if (isset($_POST['bit_id_16'])){
        echo $ins_expediente->agregar_proceso_devolucion_controlador();
    }
    #Para pasar al proceso de entrega de dictamen
    if (isset($_POST['bit_id_17'])){
        echo $ins_expediente->agregar_proceso_entre_dictamen_controlador();
    }
    #Para pasar al proceso de remitir a direccion
    if (isset($_POST['bit_id_18'])){
        echo $ins_expediente->agregar_proceso_remi_direccion_controlador();
    }
    #Para pasar al proceso de remitir a direccion
    if (isset($_POST['bit_id_19'])){
        echo $ins_expediente->agregar_proceso_memorandum_controlador();
    }
    #Para pasar al proceso de remitir a direccion
    if (isset($_POST['bit_id_40'])){
        echo $ins_expediente->agregar_proceso_remi_direccion_d_controlador();
    }
    #Para crear una interrupcion
    if (isset($_POST['bit_id_50'])){
        echo $ins_expediente->agregar_interrupcion_controlador();
    }
    #Para agregar diligencias preliminares
    if (isset($_POST['diligencia_pre'])){
        echo $ins_expediente->agregar_diligencia_pre_controlador();
    }
    #Para agregar diligencias Investigativas
    if (isset($_POST['diligencias_invest'])){
        echo $ins_expediente->agregar_diligencia_invest_controlador();
    }
    #Para agregar diligencias citaciones
    if (isset($_POST['diligencia_cita'])){
        echo $ins_expediente->agregar_diligencia_citacion_controlador();
    }
    #Para agregar diligencias legal
    if (isset($_POST['diligencias_legal'])){
        echo $ins_expediente->agregar_diligencia_legal_controlador();
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