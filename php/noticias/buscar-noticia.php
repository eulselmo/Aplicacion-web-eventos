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
	<h1> Buscar noticia </h1>
	<hr>
	<?php
		submenuNoticias();
	?>
<br><br><br>
	<p>Introduca el titular de la noticia para realizar una búsqueda:</p>
	<form action='#' method='post' enctype="multipart/form-data"></br>
			<input type='text' name='titular' size='90' maxlength='100' required>
			<input type='submit' name='enviar' value='Buscar'>
			</br></br>
			<p>Ordenar por:</p>
			Titular <input type='radio' name='ordenar' value='titular' checked="checked" required>
			Fecha de activación <input type='radio' name='ordenar' value='fecha' required>
	</form>
	<?php
		if(isset($_POST['enviar'])){
			$titular=$_POST['titular'];
			$ordenado=$_POST['ordenar'];
			//Enviamos los datos a la función de busqueda de noticias
			buscarNoticia($titular,$ordenado);
		}
	?>
	</div>
</body>
</html>
