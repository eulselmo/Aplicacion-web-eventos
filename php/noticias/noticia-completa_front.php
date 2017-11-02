<!DOCTYPE html>
<?php
session_start();
include("../funciones.php");
include("funciones-noticias.php");
sesionAbierta();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="../../CSS/estilos_frontend.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php imprimirMenu("..") ;?>
	<div class='cuerpo'>
		<?php
			//Recogemos datos
			$id=$_GET['c'];
			//Enviamos los datos a la función que imprimirá la noticia completa
			noticiaCompleta($id,0);
		?>
	</div>
	<?php
		imprimirFooter();
	?>
</body>
</html>
