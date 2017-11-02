<?php
function comprobarUsuario($nick){
	$conexion=conectarBD();
	$comp=mysqli_query($conexion, "select nick from clientes where nick='$nick'");
	$num_resul=mysqli_num_rows($comp);
	return $num_resul;
	mysqli_close($conexion);
}

function buscarCliente($buscar,$ordenar){
		$conexion=conectarBD();
		if($ordenar=='nom'){
			$con=mysqli_query($conexion, "select * from clientes where nombre LIKE '%$buscar%' or apellidos LIKE '%$buscar%' or telefono1 LIKE '%$buscar%' ORDER BY nombre asc");
		}else{
			$con=mysqli_query($conexion, "select * from clientes where nombre LIKE '%$buscar%' or apellidos LIKE '%$buscar%' or telefono1 LIKE '%$buscar%' ORDER BY apellidos asc");
		}

			$num_resul=mysqli_num_rows($con);
			//Si hay clientes los muestra, sino un mensaje
			if($num_resul>0){
				echo "</br>";
				echo "<table class='tabla'>";
				echo "<tr>";
						echo "<th>Nombre</th>";
						echo "<th>Apellidos</th>";
						echo "<th>Dirección</th>";
						echo "<th>Teléfono</th>";
						echo "<th>Teléfono 2</th>";
						echo "<th>Nick</th>";
						echo "<th>Password</th>";
					echo "</tr>";
				for($i=0;$i<$num_resul;$i++){
					$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
					cliente($datos['id'],$datos['nombre'],$datos['apellidos'],$datos['direccion'],$datos['telefono1'],$datos['telefono2'],$datos['nick'],$datos['pass'],false);
				}
				echo "</table>";
			}else{
				echo "No se han encontrado resultados.";
			}
			mysqli_close($conexion);
}

function cliente($id, $nombre, $apellidos, $direccion, $telefono1, $telefono2, $nick, $pass,$var){
	echo "<tr>";
		echo "<td>$nombre</td>";
		echo "<td>$apellidos</td>";
		echo "<td>$direccion</td>";
		echo "<td>$telefono1</td>";
		echo "<td>$telefono2</td>";
		echo "<td>$nick</td>";
		echo "<td>$pass</td>";
		if($var==true){
			//Enlace que permitirá modificar un cliente
			echo "<td>
				<a href='modificar-cliente.php?c=$id'>Modificar</a>
			</td>";
		}
	echo "</tr>";
}

function imprimirClientes(){
	$conexion=conectarBD();
	$con=mysqli_query($conexion, "select * from clientes where id!=0");
	$num_resul=mysqli_num_rows($con);

		if($num_resul>0){
			echo "<table id='tabla_clientes'>";
			echo "<tr>";
				echo "<th>Nombre</th>";
				echo "<th>Apellidos</th>";
				echo "<th>Dirección</th>";
				echo "<th>Teléfono</th>";
				echo "<th>Teléfono 2</th>";
				echo "<th>Nick</th>";
				echo "<th>Password</th>";
			echo "</tr>";

				for($i=0;$i<$num_resul;$i++){
					$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
					if($i%2==0){
						echo "<tr>";
					}else {
						echo "<tr class='par'>";
					}
						echo "<td>$datos[nombre]</td>";
						echo "<td>$datos[apellidos]</td>";
						echo "<td>$datos[direccion]</td>";
						echo "<td>$datos[telefono1]</td>";
						echo "<td>$datos[telefono2]</td>";
						echo "<td>$datos[nick]</td>";
						echo "<td>$datos[pass]</td>";

							//Enlace que permitirá modificar un cliente
							echo "<td>
								<a href='modificar-cliente.php?c=$datos[id]'>Modificar</a>
							</td>";
					echo "</tr>";
				}
				echo "</table>";
		}else{
			echo "No hay usuarios actualmente en la plataforma";
		}
}
?>
