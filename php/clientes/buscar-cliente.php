<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-clientes.php");;
		session_start();
		sesionAbierta();
		comprobarURL();
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buscar cliente</title>
	<link href="../../CSS/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		menu_backend();
	?>
	<div class='cuerpo'>
	<h1> Buscar cliente</h1>
	<hr>
	<?php
		submenuClientes();
	?>
	<br><br><br>
	<p>Introduca el nombre, apellido o teléfono de la persona a buscar:</p>
	<form action='#' method='post' enctype="multipart/form-data"></br>
			<input type='text' name='buscar' size='90' maxlength='100' required>
			<input type='submit' name='enviar' value='Buscar'>
			</br>
			<p>Ordenar por:</p>
			Nombre <input type='radio' name='ordenar' value='nom' required checked="checked">
			Apellido <input type='radio' name='ordenar' value='apell' required>

	</form>
	<?php
		if(isset($_POST['enviar'])){
			$buscar=$_POST['buscar'];
			$ordenado=$_POST['ordenar'];
			buscarCliente($buscar,$ordenado);
		}
	?>
	</div>
</body>
</html>
