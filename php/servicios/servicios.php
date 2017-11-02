<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-servicios.php");
		session_start();
		sesionAbierta();
		comprobarURL();
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link href="../../CSS/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		menu_backend();
	?>
	<div class='cuerpo'>
	<h1> Servicios </h1>
	<hr>
	<?php
		submenuServicios();
	?>
<br><br><br>
	<?php
		imprimirServicios();
	?>
	</div>
</body>
</html>
