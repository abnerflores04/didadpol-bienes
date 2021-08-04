<?php
require_once "mainModel2.php";
class disciplinarioModelo extends mainModel2
{
/* Modelo agregar proceso disciplinario*/
protected static function agregar_proc_disciplinario_modelo($datos)
{
    $sql = mainModel2::conectar()->prepare("INSERT INTO tbl_proc_penal (n_exp_interno, nombre_procesado, delitos, victimas, fiscalia_id, juzg_tribu_id, exp_judicial, est_lab_id, descrip_est_lab, fec_hechos, fec_ultima_act, descrip_ultima_act, est_proceso, oficio_solicitud) VALUES (:n_exp_interno,:nombre_procesado,:delitos,:victimas,:fiscalia_id,:juzg_tribu_id,:exp_judicial,:est_lab_id,:descrip_est_lab,:fec_hechos,:fec_ultima_act,:descrip_ultima_act,:est_proceso,:oficio_solicitud)");
    $sql->bindParam(":n_exp_interno",$datos['n_exp_interno']);
    $sql->bindParam(":nombre_procesado", $datos['nombre_procesado']);
    $sql->bindParam(":delitos",$datos['delitos']);
    $sql->bindParam(":victimas",$datos['victimas']);
    $sql->bindParam(":fiscalia_id",$datos['fiscalia_id']);
    $sql->bindParam(":juzg_tribu_id",$datos['juzg_tribu_id']);
    $sql->bindParam(":exp_judicial",$datos['exp_judicial']);
    $sql->bindParam(":est_lab_id",$datos['est_lab_id']);
    $sql->bindParam(":descrip_est_lab",$datos['descrip_est_lab']);
    $sql->bindParam(":fec_hechos",$datos['fec_hechos']);
    $sql->bindParam(":fec_ultima_act",$datos['fec_ultima_act']);
    $sql->bindParam(":descrip_ultima_act",$datos['descrip_ultima_act']);
    $sql->bindParam(":est_proceso",$datos['est_proceso']);
    $sql->bindParam(":oficio_solicitud",$datos['oficio_solicitud']);
    $sql->execute();
    return $sql;
}
/* Modelo datos del proceso penal*/
protected static function datos_proc_disciplinario_modelo($tipo, $id)
{
    if ($tipo == "Unico") {
        $sql = mainModel2::conectar()->prepare("SELECT * FROM tbl_proc_disciplinario tpd INNER JOIN tbl_exp te ON tpd.exp_id=te.exp_id WHERE tpd.proc_disciplinario_id=:id");
        $sql->bindParam(":id", $id);
    } elseif ($tipo == "Conteo") {
        $sql = mainModel2::conectar()->prepare("");
    }
    $sql->execute();
    return $sql;
}
/* Modelo actualizar proceso penal*/
protected static function actualizar_proc_disciplinario_modelo($datos){
    $sql = mainModel2::conectar()->prepare("UPDATE tbl_proc_disciplinario SET sexo_id=:sexo_id,identidad_investigado=:identidad_investigado,direccion_pol=:direccion_pol,antiguedad_ins=:antiguedad_ins,n_res_seds=:n_res_seds,fec_res_seds=:fec_res_seds,fec_int_i=:fec_int_i,fec_int_f=:fec_int_f,cod_res_seds=:cod_res_seds,vicio_nul=:vicio_nul,repre_legal=:repre_legal,n_acuerdo=:n_acuerdo,fec_acuerdo_i=:fec_acuerdo_i,fec_acuerdo_f=:fec_acuerdo_f,n_cont_admin=:n_cont_admin WHERE proc_disciplinario_id=:proc_disciplinario_id");
    $sql->bindParam(":sexo_id",$datos['sexo_id']);
    $sql->bindParam(":identidad_investigado", $datos['identidad_investigado']);
    $sql->bindParam(":direccion_pol",$datos['direccion_pol']);
    $sql->bindParam(":antiguedad_ins",$datos['antiguedad_ins']);
    $sql->bindParam(":n_res_seds",$datos['n_res_seds']);
    $sql->bindParam(":fec_res_seds",$datos['fec_res_seds']);
    $sql->bindParam(":fec_int_i",$datos['fec_int_i']);
    $sql->bindParam(":fec_int_f",$datos['fec_int_f']);
    $sql->bindParam(":cod_res_seds",$datos['cod_res_seds']);
    $sql->bindParam(":vicio_nul",$datos['vicio_nul']);
    $sql->bindParam(":repre_legal",$datos['repre_legal']);
    $sql->bindParam(":n_acuerdo",$datos['n_acuerdo']);
    $sql->bindParam(":fec_acuerdo_i",$datos['fec_acuerdo_i']);
    $sql->bindParam(":fec_acuerdo_f",$datos['fec_acuerdo_f']);
    $sql->bindParam(":n_cont_admin",$datos['n_cont_admin']);
    $sql->bindParam(":proc_disciplinario_id",$datos['proc_disciplinario_id']);
    $sql->execute();
    return $sql;
}
}
