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
	<h1> Nuevo evento </h1>
	<hr>
	<?php
		submenuEventos();
	?>
	<br><br><br>
	<form action='#' method='post'>
		<?php
			//Extraemos los id y nombre de los servicios y clientes para el menú desplegable
			$conexion=conectarBD();
			$servicios=mysqli_query($conexion, "select id, nombre from servicios");
			$clientes=mysqli_query($conexion, "select id, nombre, apellidos from clientes where id!=0");
			$num_ser=mysqli_num_rows($servicios);
			$num_cli=mysqli_num_rows($clientes);
			//Generamos el desplegable con todos los servicios
			echo "Servicios: <select name='servicio'>";
			echo "<option selected value='0'> Elige una opción </option>";
			for ($i=0;$i<$num_ser;$i++){
				$datos_ser=mysqli_fetch_array($servicios, MYSQLI_ASSOC);
				echo "<option value='$datos_ser[id]'>$datos_ser[nombre]</option>";
			}
			echo "</select></br></br>";

			//Generamos el desplegable con todos los clientes
			echo "Clientes: <select name='cliente'>";
			echo "<option selected value='0'> Elige una opción </option>";
			for ($i=0;$i<$num_cli;$i++){
				$datos_cli=mysqli_fetch_array($clientes, MYSQLI_ASSOC);
				echo "<option value='$datos_cli[id]'>$datos_cli[nombre]"." $datos_cli[apellidos]</option>";
			}
			echo "</select></br></br>";
		?>
		Fecha de realización: <input type='date' name='fecha'></br></br>

		Hora de realización: <input type='time' name='hora'></br></br>

		Lugar de realización: <input type='text' name='lugar'></br></br>

		<input type='submit' name='enviar'></br></br>
	</form>
	<p><strong>(*) Todos los campos son obligatorios.</strong></p>
	<?php
		//Recogemos datos del formulario para guardarlos en la BD
		if(isset($_POST['enviar'])){
			$servicio=$_POST['servicio'];
			$cliente=$_POST['cliente'];
			$fecha=$_POST['fecha'];
			$hora=$_POST['hora'];
			$lugar=trim($_POST['lugar']);
			//Guardamos los datos en la BD
				$comp=mysqli_query($conexion, "insert into eventos values ('$cliente','$servicio','$lugar','$fecha','$hora')");
				if($comp=='true'){
					echo "Evento subido correctamente.";
				}else{
					echo "Ha habido un error al subir el evento. Vuelva a intentarlo.";
				}
				mysqli_close($conexion);
		}
	?>
	</div>
</body>
</html>
