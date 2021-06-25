<?php
require_once "mainModel2.php";
class solicitudModelo extends mainModel2
{
 
    protected static function agregar_solicitud_modelo($depto)
    {
        foreach ($depto as $d) {
            if ($d>0) {
            $sql = mainModel2::conectar()->prepare("INSERT INTO solicitud(id_depto) VALUES (:depto)");
            $sql->bindParam(":depto", $d);
            $sql->execute();
            }
            
        }
        return $sql;
    }
    
}
