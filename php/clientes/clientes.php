<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-clientes.php");
		session_start();
		sesionAbierta();
		comprobarURL();
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clientes</title>
	<link href="../../CSS/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		menu_backend();
	?>
	<div class='cuerpo'>
	<h1> Clientes </h1>
	<hr>
	<?php
		submenuClientes();
	?>
	<br><br><br>
	<?php
		imprimirClientes();
	?>
	</div>

</body>
</html>
