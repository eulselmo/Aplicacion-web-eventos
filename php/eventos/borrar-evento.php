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
	<h1> Borrar evento </h1>
	<hr>
	<?php
		submenuEventos();
	?>
	<br><br><br>
	<p>Introduca el tipo de servicio, cliente o fecha de realización:</p>
	<form action='#' method='post' enctype="multipart/form-data"></br>
			<input type='text' name='buscar' size='90' maxlength='100' required>
			<input type='submit' name='enviar' value='Buscar'>
	</form></br></br>
	<?php
		if(isset($_POST['enviar'])){
			//Recogemos los datos
			$buscar=$_POST['buscar'];
			$conexion=conectarBD();
			//Buscamos el evento
			$con=mysqli_query($conexion, "select s.nombre nservicio, c.nombre ncliente, c.apellidos, e.lugar, e.fecha, e.hora from servicios s, clientes c, eventos e where e.id_cliente=c.id and e.id_servicio=s.id and (s.nombre LIKE '%$buscar%' or c.nombre LIKE '%$buscar%' or e.fecha LIKE '%$buscar%')");
			$num_resul=mysqli_num_rows($con);
			//Si el número de resultados es mayor de 0 muestra los datos, sino un mensaje
			if($num_resul>0){
				echo "<table class='tabla'>
						<tr>
							<th>Servicio</th>
							<th>Nombre cliente</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Lugar</th>
						</tr>";
				for($i=0;$i<$num_resul;$i++){
					$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
					$fecha=transformarFecha($datos['fecha']);
					echo "<tr>
					<td>$datos[nservicio]</td>
					<td>$datos[ncliente]"." $datos[apellidos]</td>
					<td>$fecha</td>
					<td>$datos[hora]</td>
					<td>$datos[lugar]</td>
					<td>
						<a href='bevento.php?s=$datos[nservicio]&n=$datos[ncliente]&a=$datos[apellidos]&f=$datos[fecha]&h=$datos[hora]&l=$datos[lugar]'>Borrar</a>
					</td>
					</tr>";

				}
			}else{
				echo "No se han encontrado resultados.";
			}
			mysqli_close($conexion);
		}
	?>
	</table>
	</div>
</body>
</html>
