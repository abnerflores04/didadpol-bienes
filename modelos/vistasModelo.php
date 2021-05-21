<?php
    /* Obtener las vistas que se iran mostrando en el index.php*/
    class vistasModelo{
        protected static function obtener_vistas_modelo($vistas){
            $listaBlanca=["home","registro-usuarios","lista-usuarios","ver-informacion-usuario","actualizar-usuario","registro-rol","actualizar-rol","lista-roles","registro-salida","actualizar-salida","lista-giras","lista-diligencias"];
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