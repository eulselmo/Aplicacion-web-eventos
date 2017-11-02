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
	<h1> Buscar evento </h1>
	<hr>
	<?php
		submenuEventos();
	?>
	<br><br><br>
	<p>Introduca el tipo de servicio, cliente o fecha de realización:</p>
	<form action='#' method='post' enctype="multipart/form-data"></br>
			<input type='text' name='buscar' size='90' maxlength='100' required>
			<input type='submit' name='enviar' value='Buscar'>
			</br></br>
			<p>Ordenar por:</p>
			Servicio contratado <input type='radio' name='ordenar' value='servicio' checked="checked" required>
			Nombre cliente<input type='radio' name='ordenar' value='nombre' required>
			Fecha de realización<input type='radio' name='ordenar' value='fecha' required>
	</form></br></br>
	<?php
		if(isset($_POST['enviar'])){
			$buscar=$_POST['buscar'];
			$ordenado=$_POST['ordenar'];
			$conexion=conectarBD();
			//Dependiendo del valor de $ordenado ordenará por un campo u otro
			if($ordenado=='servicio'){
				$con=mysqli_query($conexion, "select s.nombre nservicio, c.nombre ncliente, c.apellidos, e.lugar, e.fecha, e.hora from servicios s, clientes c, eventos e where e.id_cliente=c.id and e.id_servicio=s.id and (s.nombre LIKE '%$buscar%' or c.nombre LIKE '%$buscar%' or e.fecha LIKE '%$buscar%') ORDER BY nservicio asc");
			}elseif($ordenado=='nombre'){
				$con=mysqli_query($conexion, "select s.nombre nservicio, c.nombre ncliente, c.apellidos, e.lugar, e.fecha, e.hora from servicios s, clientes c, eventos e where e.id_cliente=c.id and e.id_servicio=s.id and (s.nombre LIKE '%$buscar%' or c.nombre LIKE '%$buscar%' or e.fecha LIKE '%$buscar%') ORDER BY ncliente asc");
			}else{
				$con=mysqli_query($conexion, "select s.nombre nservicio, c.nombre ncliente, c.apellidos, e.lugar, e.fecha, e.hora from servicios s, clientes c, eventos e where e.id_cliente=c.id and e.id_servicio=s.id and (s.nombre LIKE '%$buscar%' or c.nombre LIKE '%$buscar%' or e.fecha LIKE '%$buscar%') ORDER BY e.fecha asc");
			}
			$num_resul=mysqli_num_rows($con);
			//Si hay eventos se mostrarán, sino un mensaje
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
