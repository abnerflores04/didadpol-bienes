<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>
	<?php include "./vistas/Inc/Link.php" ?>



</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<?php
		$peticionAjax = false;
		require_once "./controladores/vistasControlador.php";
		$IV = new vistasControlador();
		$vistas = $IV->obtener_vistas_controlador();
		if ($vistas == "login" || $vistas == "404") {
			require_once "./vistas/contenidos/" . $vistas . "-view.php";
		} else {



		?>

			<?php include "./vistas/Inc/NavLateral.php";



			include "./vistas/Inc/NavBar.php";
			include $vistas;

			?>


		<?php
		}

		include "./vistas/Inc/Script.php"
		?>
	</div>
</body>

</html>