<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-eventos.php");
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
	<h1> Eventos del día </h1>
	<hr>
	<?php
		submenuEventos();
	?>
	<br><br><br>
	<?php
		$dia=$_GET['d'];
		$mes=$_GET['m'];
		$anio=$_GET['a'];
		$fecha=$anio."-".$mes."-"."$dia";
		$conexion2=conectarBD();
		$eventos=mysqli_query($conexion2, "SELECT e.lugar,e.fecha,e.hora,c.nombre cliente,c.apellidos,c.telefono1,s.nombre servicio FROM eventos e, clientes c, servicios s WHERE e.id_cliente=c.id and e.id_servicio=s.id and e.fecha='$fecha'");
		$num_resul=mysqli_num_rows($eventos);
		for($i=0;$i<$num_resul;$i++){
			$datos=mysqli_fetch_array($eventos, MYSQLI_ASSOC);
			echo "<h3>Datos evento</h3>
			<p>Nombre del cliente: $datos[cliente]</p>
			<p>Apellido del cliente: $datos[apellidos]</p>
			<p>Teléfono de contacto: $datos[telefono1]</p>
			<p>Servicio contratado: $datos[servicio]</p>
			<p>Lugar: $datos[lugar]</p>
			<p>Fecha: $datos[fecha]</p>
			<p>Hora: $datos[hora]</p>

			";
		}
		mysqli_close($conexion2);
	?>
