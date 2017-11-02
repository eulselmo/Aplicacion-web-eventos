<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-noticias.php");
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
	<h1> Borrar noticia </h1>
	<hr>
	<?php
		submenuNoticias();
	?>
	<br><br><br>
	<?php
		$id=$_GET['i'];
		borrar($id);
	?>
	</div>
</body>
</html>
