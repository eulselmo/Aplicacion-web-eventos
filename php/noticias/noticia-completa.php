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
	<h1> Noticias </h1>
	<hr>
	<?php
		submenuNoticias();
	?>
</br><br><br>
<?php
	//Recogemos datos
	$id=$_GET['c'];
	//Enviamos los datos a la función que imprimirá la noticia completa
	noticiaCompleta($id,1);
?>
</div>
</body>
</html>
