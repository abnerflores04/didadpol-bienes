<?php
    /* Obtener las vistas que se iran mostrando en el index.php*/
    class vistasModelo{
        protected static function obtener_vistas_modelo($vistas){
            $listaBlanca=["home","registro-usuarios","lista-usuarios","ver-informacion-usuario","actualizar-usuario","registro-rol","actualizar-rol","lista-roles","lista-exp-investigacion","ver-info-exp","ver-info-exp-p","ver-info-exp-d","actualizar-exp-i","lista-feriados","registro-feriados","actualizar-feriados","registro-exp-investigacion","lista-reportes-exp", "lista-reportes-exp-leg","lista-monitoreo-exp","lista-bitacora-fechas","lista-proc-penales","registro-proc-penales","actualizar-proc-penal","ver-info-proc-penal","lista-proc-disciplinarios","registro-proc-disciplinarios","actualizar-proc-disciplinario","ver-info-proc-disciplinario"];
            if (in_array($vistas,$listaBlanca)) {
                if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
                    $contenido="./vistas/contenidos/".$vistas."-view.php";
                } else {
                    $contenido="404";
                }
            }elseif ($vistas=="login" || $vistas=="index") {
                $contenido="login";
            }elseif ($vistas=="cambio-contraseña") {
                $contenido="cambio-contraseña";
            }elseif ($vistas=="restablecer-contraseña-correo") {
                $contenido="restablecer-contraseña-correo";
            }elseif ($vistas=="restablecer-contraseña") {
                $contenido="restablecer-contraseña";
            }else{
                $contenido="404";
            }
            return $contenido;
        }
        
    }