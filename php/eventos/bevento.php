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
	<h1> Borrar Evento </h1>
	<hr>
	<?php
		submenuEventos();
	?>
	<br><br><br>
	<?php
		//Recogemos los datos del evento a borrar
		$servicio=$_GET['s'];
		$nombre=$_GET['n'];
		$apellidos=$_GET['a'];
		$fecha=$_GET['f'];
		$hora=$_GET['h'];
		$lugar=$_GET['l'];
		$conexion=conectarBD();

		//Obtenemos la fecha y horario actual para permitir o no el borrado del evento
		//Obtenemos fecha actual
		$f_actual=time();
		$d_actual=date('d',$f_actual);
		$a_actual=date('Y',$f_actual);
		$m_actual=date('m',$f_actual);
		$fe_actual=$a_actual."-".$m_actual."-".$d_actual;
		//Obtenemos hora
		$hora_actual=getdate($f_actual);
		$h_actual=$hora_actual['hours'];
		$m_actual=$hora_actual['minutes'];
		$s_actual=$hora_actual['seconds'];
		$hora_actual_for="$h_actual:$m_actual:$s_actual";

		//Obtenemos id cliente y id servicio para borrarlo
		$con_cli=mysqli_query($conexion, "select id from clientes where nombre='$nombre' and apellidos='$apellidos'");
		$datos_cli=mysqli_fetch_array($con_cli, MYSQLI_ASSOC);
		$id_cli=$datos_cli['id'];

		$con_ser=mysqli_query($conexion, "select id from servicios where nombre='$servicio'");
		$datos_ser=mysqli_fetch_array($con_ser, MYSQLI_ASSOC);
		$id_ser=$datos_ser['id'];

		//Comprobamos si el evento puede ser borrado dependiendo su hora y fecha, y las actuales
		if($fe_actual < $fecha){

			$con=mysqli_query($conexion, "DELETE FROM eventos WHERE hora='$hora' and fecha='$fecha' and lugar='$lugar' and id_cliente='$id_cli' and id_servicio='$id_ser'");
			if($con=='true'){
							echo "Evento borrado correctamente.";
						}else{
							echo "Ha habido un error al borrar el evento. Vuelva a intentarlo.";
						}
						echo "entra";
		}elseif($fe_actual == $fecha){
			if($hora_actual < $hora){ //Si las fechas son iguales comparamos las horas
				$con=mysqli_query($conexion, "DELETE FROM eventos WHERE hora='$hora' and fecha='$fecha' and lugar='$lugar' and id_cliente='$id_cli' and id_servicio='$id_ser'");
			}else{
				echo "Imposible borrar un evento ya pasado";
			}
		}else{
			echo "Imposible borrar un evento ya pasado";
		}
		mysqli_close($conexion);
	?>
	</table>
	</div>
</body>
</html>
