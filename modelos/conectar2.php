<?php   
    require_once "../config/SERVER.php";
    $conexion=new PDO(SGBD, USER, PASS);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion-> exec("SET CHARACTER SET utf8");
?>