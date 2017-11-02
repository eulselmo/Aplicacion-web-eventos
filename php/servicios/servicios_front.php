<!DOCTYPE html>
<?php
session_start();
include("../funciones.php");
include("funciones-servicios.php");
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
		<h1> Nuestros servicios </h1>
		<?php
				imprimirServicios_front();
		 ?>
	</div>
	<?php
		imprimirFooter();
	?>
</body>
</html>
