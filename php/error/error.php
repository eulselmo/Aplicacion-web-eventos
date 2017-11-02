<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="../../CSS/estilos_frontend.css" rel="stylesheet" type="text/css">
	<?php include("../funciones.php"); ?>
</head>
<body>
	<?php imprimirMenu("..") ;?>
	<div class='cuerpo'>
		<h1 class='error'> Permiso denegado </h1>
    <p>Usted no tiene los permisos para acceder a esta página.</p>
    <p>A continuación se le redireccionará a la página de login para que pueda loguearse y  así acceder...</p>
    <?php
    header( "refresh:3;url=../acceder/acceder.php" );
     ?>

	</div>
	<?php
		imprimirFooter();
	?>
</body>
</html>
