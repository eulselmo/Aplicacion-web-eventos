<!DOCTYPE html>
<?php
session_start();
include("../funciones.php");
sesionAbierta();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="../../CSS/estilos_frontend.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php imprimirMenu("..") ;?>
	<div class='cuerpo'>
		<h1> Contacto</h1>
		<p> Si desea contactar con nosotros puede hacerlo a través del siguiente formulario:</p>
		<form action='#' method='post' enctype="multipart/form-data"></br>
			<label>Nombre:*</label>
			<input type='text' name='nombre' size='30' required></br></br>
			<label>Apellidos:* </label>
			<input type='text' name='apellidos' required></br></br>
			<label>Correo electrónico:*</label>
			<input type='text' name='email' required></br></br>
			<label>Mensaje:*</label></br></br>
			<textarea name='contenido' cols='100' rows="10" maxlength='1000' required></textarea></br></br>
			<input type='submit' name='enviar' id='enviar'>
		</form>
		</br></br>
		<p>Los campos con (*) son obligatorios</p>
	</div>
	<?php
		imprimirFooter();
	?>
</body>
</html>
