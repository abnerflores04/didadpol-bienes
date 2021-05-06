<?php
    /* Obtener las vistas que se iran mostrando en el index.php*/
    class vistasModelo{
        protected static function obtener_vistas_modelo($vistas){
            $listaBlanca=["home","registro-usuarios"];
            if (in_array($vistas,$listaBlanca)) {
                if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
                    $contenido="./vistas/contenidos/".$vistas."-view.php";
                } else {
                    $contenido="404";
                }
            }elseif ($vistas=="login" || $vistas=="index") {
                $contenido="login";
            }elseif ($vistas=="cambio-contrasena") {
                $contenido="cambio-contrasena";
            }else{
                $contenido="404";
            }
            return $contenido;
        }
        
    }