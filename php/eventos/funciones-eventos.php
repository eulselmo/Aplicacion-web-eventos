<?php
function formatearMes($mes){
	switch ($mes) {
		case 1:
			return "Enero";
			break;
		case 2:
			return "Febrero";
			break;
		case 3:
			return "Marzo";
			break;
		case 4:
			return "Abril";
			break;
			case 5:
				return "Mayo";
				break;
				case 6:
					return "Junio";
					break;
					case 7:
						return "Julio";
						break;
						case 8:
							return "Agosto";
							break;
							case 9:
								return "Septiembre";
								break;
								case 10:
									return "Octubre";
									break;
									case 11:
										return "Noviembre";
										break;
										case 12:
											return "Diciembre";
											break;
	}
}
	function generarCalendario($mes, $anio){
		//$fecha=$anio."-".$mes."-"."01";
		$marca=mktime(0,0,0,$mes, 1, $anio);
		$num_dias=date('t',$marca);
		$dia_semana=date('N',$marca);
		$formes=formatearMes($mes);
		echo "<h3>$formes del $anio</h3>";
		echo "<table>
				<tr>
					<th>L</th>
					<th>M</th>
					<th>X</th>
					<th>J</th>
					<th>V</th>
					<th>S</th>
					<th>D</th>
				</tr>";
			echo "<tr>";
		$dias=1;
		for($e=1;$dias<=$num_dias;$e++){
				if($dia_semana<=$e){
					if(comprobarFecha($dias,$mes,$anio)==true){
						echo "<td style='background-color:red'><a href='eventos.php?d=$dias&m=$mes&a=$anio&mes=$mes&anio=$anio'>$dias</a></td>";
					}else{
						echo "<td>$dias</td>";
					}
					$dias++;
				}else{
					echo "<td></td>";
				}
			if($e%7==0){
				echo "</tr><tr>";
			}
		}
		if(isset($_GET['m'])){
			echo "<div id='eventos'>";
			$dia=$_GET['d'];
			$mes=$_GET['m'];
			$anio=$_GET['a'];
			$fecha=$anio."-".$mes."-"."$dia";
			$fecha_form=$dia."-".$mes."-"."$anio";
			$conexion2=conectarBD();
			$eventos=mysqli_query($conexion2, "SELECT e.lugar,e.fecha,e.hora,c.nombre cliente,c.apellidos,c.telefono1,s.nombre servicio FROM eventos e, clientes c, servicios s WHERE e.id_cliente=c.id and e.id_servicio=s.id and e.id_cliente=c.id and e.fecha='$fecha'");
			$num_resul=mysqli_num_rows($eventos);
			echo "<table border>";
			echo "
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Teléfono</th>
					<th>Servicio</th>
					<th>Lugar</th>
					<th>Fecha</th>
					<th>Hora</th>

			";
			for($i=0;$i<$num_resul;$i++){
				$datos=mysqli_fetch_array($eventos, MYSQLI_ASSOC);
				echo "<tr>
				<td>$datos[cliente]</td>
				<td>$datos[apellidos]</td>
				<td>$datos[telefono1]</td>
				<td>$datos[servicio]</td>
				<td>$datos[lugar]</td>
				<td>$fecha_form</td>
				<td>$datos[hora]</td>
				</tr>";
			}
			echo "<table>";
			mysqli_close($conexion2);
			echo "</div>";
			}

	}

	function generarCalendario_front($mes, $anio){
		//$fecha=$anio."-".$mes."-"."01";
		$marca=mktime(0,0,0,$mes, 1, $anio);
		$num_dias=date('t',$marca);
		$dia_semana=date('N',$marca);
		$formes=formatearMes($mes);
		echo "<h3>$formes del $anio</h3>";
		echo "<table>
				<tr>
					<th>L</th>
					<th>M</th>
					<th>X</th>
					<th>J</th>
					<th>V</th>
					<th>S</th>
					<th>D</th>
				</tr>";
			echo "<tr>";
		$dias=1;
		for($e=1;$dias<=$num_dias;$e++){
				if($dia_semana<=$e){
					if(comprobarFecha_front($dias,$mes,$anio)==true){
						echo "<td style='background-color:red'><a href='mis-eventos.php?d=$dias&m=$mes&a=$anio&mes=$mes&anio=$anio'>$dias</a></td>";
					}else{
						echo "<td>$dias</td>";
					}
					$dias++;
				}else{
					echo "<td></td>";
				}
			if($e%7==0){
				echo "</tr><tr>";
			}
		}
		if(isset($_GET['m'])){
			echo "<div id='eventos'>";
			$dia=$_GET['d'];
			$mes=$_GET['m'];
			$anio=$_GET['a'];
			$fecha=$anio."-".$mes."-"."$dia";
			$fecha_form=$dia."-".$mes."-"."$anio";
			$conexion2=conectarBD();
			$eventos=mysqli_query($conexion2, "SELECT e.lugar,e.fecha,e.hora,s.nombre servicio
																					FROM eventos e, clientes c, servicios s
																					WHERE e.id_cliente=(select id
																															from clientes
																															where nick='$_SESSION[usuario]')
																				and e.id_servicio=s.id
																				and e.id_cliente=c.id
																				and e.fecha='$fecha'"
																															);
			$num_resul=mysqli_num_rows($eventos);
			echo "<table border>";
			echo "
					<th>Servicio</th>
					<th>Lugar</th>
					<th>Fecha</th>
					<th>Hora</th>

			";
			for($i=0;$i<$num_resul;$i++){
				$datos=mysqli_fetch_array($eventos, MYSQLI_ASSOC);
				echo "<tr>
				<td>$datos[servicio]</td>
				<td>$datos[lugar]</td>
				<td>$fecha_form</td>
				<td>$datos[hora]</td>
				</tr>";
			}
			echo "<table>";
			mysqli_close($conexion2);
			echo "</div>";
			}
	}

	function comprobarFecha($dia,$mes,$anio){
		$fecha=$anio."-".$mes."-".$dia;
		$conexion=conectarBD();
		$eventos=mysqli_query($conexion, "select count(fecha) from eventos where fecha='$fecha'");
		$datos=mysqli_fetch_array($eventos, MYSQLI_NUM);
		if($datos[0]>0){
			return true;
		}else{
			return false;
		}
		mysqli_close($conexion);
	}

	function comprobarFecha_front($dia,$mes,$anio){
		$fecha=$anio."-".$mes."-".$dia;
		$conexion=conectarBD();
		$eventos=mysqli_query($conexion, "select count(fecha) from eventos where fecha='$fecha' and id_cliente=(select id from clientes where nick='$_SESSION[usuario]')");
		$datos=mysqli_fetch_array($eventos, MYSQLI_NUM);
		if($datos[0]>0){
			return true;
		}else{
			return false;
		}
		mysqli_close($conexion);
	}

	function transformarFecha($fecha){
		$marca=strtotime($fecha);
		$fecha=date('d',$marca)."-".date('m',$marca)."-".date('Y',$marca);
		return $fecha;
	}
?>
