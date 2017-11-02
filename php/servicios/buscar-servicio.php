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
	<h1> Buscar servicio </h1>
	<hr>
	<?php
		submenuServicios();
	?>
<br><br><br>
	<p>Introduca el nombre o precio del servicio a buscar:</p>
	<form action='#' method='post' enctype="multipart/form-data"></br>
			<input type='text' name='buscar' size='90' maxlength='100' required>
			<input type='submit' name='enviar' value='Buscar'>
			</br></br>
			<p>Ordenar por:</p>
			Nombre <input type='radio' name='ordenar' value='nom' checked="checked" required>
			Precio <input type='radio' name='ordenar' value='precio' required>
	</form>
	<?php
		if(isset($_POST['enviar'])){
			$buscar=$_POST['buscar'];
			$ordenado=$_POST['ordenar'];
			buscarServicio($buscar,$ordenado);
		}
	?>
	</div>
</body>
</html>
