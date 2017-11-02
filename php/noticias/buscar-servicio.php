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
	<?php imprimirMenu("..") ;?>
	<?php submenuServicios(); ?>
	<div class='cuerpo'>
	<h2> Buscar servicio </h2>
	<hr>
	<p>Introduca el nombre o precio del servicio a buscar:</p>
	<form action='#' method='post' enctype="multipart/form-data"></br>
			<input type='text' name='buscar' size='90' maxlength='100' required>
			<input type='submit' name='enviar' value='Buscar'>
	</form>
	<?php
		if(isset($_POST['enviar'])){
			$buscar=$_POST['buscar'];
			buscarServicio($buscar);
		}
	?>
	</div>
</body>
</html>
