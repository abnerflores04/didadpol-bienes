<?php
require_once "mainModel2.php";
class penalModelo extends mainModel2
{
/* Modelo agregar proceso penal*/
protected static function agregar_proc_penal_modelo($datos)
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
protected static function datos_proc_penal_modelo($tipo, $id)
{
    if ($tipo == "Unico") {
        $sql = mainModel2::conectar()->prepare("SELECT p.proc_penal_id, p.n_exp_interno, p.nombre_procesado, p.delitos, p.victimas, f.fiscalia_id, f.descrip_fiscalia, j.juzg_tribu_id, j.descrip_juzg_tribu, p.exp_judicial, e.est_lab_id, e.descrip_est_l, p.descrip_est_lab, p.fec_hechos, p.fec_ultima_act, p.descrip_ultima_act, p.est_proceso, p.oficio_solicitud FROM tbl_proc_penal p INNER JOIN tbl_fiscalia f ON p.fiscalia_id = f.fiscalia_id INNER JOIN tbl_juzg_tribu j ON j.juzg_tribu_id = p.juzg_tribu_id INNER JOIN tbl_est_lab e ON e.est_lab_id = p.est_lab_id WHERE p.proc_penal_id=:id");
        $sql->bindParam(":id", $id);
    } elseif ($tipo == "Conteo") {
        $sql = mainModel2::conectar()->prepare("SELECT p.proc_penal_id, p.n_exp_interno, p.nombre_procesado, p.delitos, p.victimas, f.descrip_fiscalia, j.descrip_juzg_tribu, p.exp_judicial, e.descrip_est_l, p.descrip_est_lab, p.fec_hechos, p.fec_ultima_act, p.descrip_ultima_act, p.est_proceso, p.oficio_solicitud FROM tbl_proc_penal p INNER JOIN tbl_fiscalia f ON p.fiscalia_id = f.fiscalia_id INNER JOIN tbl_juzg_tribu j ON j.juzg_tribu_id = p.juzg_tribu_id INNER JOIN tbl_est_lab e ON e.est_lab_id = p.est_lab_id");
    }
    $sql->execute();
    return $sql;
}
/* Modelo actualizar proceso penal*/
protected static function actualizar_proc_penal_modelo($datos){
    $sql = mainModel2::conectar()->prepare("UPDATE tbl_proc_penal SET n_exp_interno=:n_exp_interno,nombre_procesado=:nombre_procesado,delitos=:delitos,victimas=:victimas,fiscalia_id=:fiscalia_id,juzg_tribu_id=:juzg_tribu_id,exp_judicial=:exp_judicial,est_lab_id=:est_lab_id,descrip_est_lab=:descrip_est_lab,fec_hechos=:fec_hechos,fec_ultima_act=:fec_ultima_act,descrip_ultima_act=:descrip_ultima_act,est_proceso=:est_proceso,oficio_solicitud=:oficio_solicitud WHERE proc_penal_id=:proc_penal_id");
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
    $sql->bindParam(":proc_penal_id",$datos['proc_penal_id']);
    $sql->execute();
    return $sql;
}
}
