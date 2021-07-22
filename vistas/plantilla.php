<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>
	<?php
	include "./vistas/Inc/Link.php";
	?>
</head>

<body class="hold-transition sidebar-mini">
	<?php
	$peticionAjax = false;
	require_once "./controladores/vistasControlador.php";
	$IV = new vistasControlador();
	$vistas = $IV->obtener_vistas_controlador();
	if ($vistas == "login" || $vistas == "404" || $vistas == "cambio-contraseña"|| $vistas == "restablecer-contraseña-correo"|| $vistas == "restablecer-contraseña" || $vistas == "ver-informacion-usuario" || $vistas =="actualizar-usuario" || $vistas == "actualizar-usuario" || $vistas =="registro-rol"|| $vistas =="actualizar-rol" || $vistas =="lista-roles" || $vistas =="registro-exp-investigacion" || $vistas =="lista-exp-investigacion" || $vistas =="ver-info-exp-i" || $vistas =="actualizar-exp-i" || $vistas =="lista-feriados"|| $vistas =="registro-feriados"|| $vistas =="actualizar-feriados" || $vistas =="lista-monitoreo-exp" || $vistas == "lista-bitacora-fechas") {
		require_once "./vistas/contenidos/" . $vistas . "-view.php";
	} else {
		session_start();
		$pagina = explode("/", $_GET['views']);
		require_once "./controladores/loginControlador.php";
		$lc = new loginControlador();
		if (!isset( $_SESSION['token_spm']) || !isset( $_SESSION['usuario_spm']) || !isset( $_SESSION['id_spm'])) {
			echo $lc->forzar_cierre_sesion_controlador();
			exit();
		}
	?>
		<div class="wrapper">
		<?php
		include "./vistas/Inc/NavLateral.php";
		include "./vistas/Inc/NavBar.php";
		include $vistas;
		include "./vistas/Inc/logOut.php";
	}
	include "./vistas/Inc/Script.php";
		?></div>
</body>

</html>