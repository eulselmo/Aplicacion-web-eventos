<?php

//Otras funciones


function buscarServicio($buscar,$ordenar){
		$conexion=conectarBD();
		//Dependiendo del valor de $ordenar ordenará los resultados por nombre o precio
		if($ordenar=='nom'){
			$con=mysqli_query($conexion, "select * from servicios where nombre LIKE '%$buscar%' or precio LIKE '%$buscar%' ORDER BY nombre asc");
		}else{
			$con=mysqli_query($conexion, "select * from servicios where nombre LIKE '%$buscar%' or precio LIKE '%$buscar%' ORDER BY precio asc");
		}


			$num_resul=mysqli_num_rows($con);
			if($num_resul>0){
				for($i=0;$i<$num_resul;$i++){
					$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
					//Enviamos los datos a la función que los mostrará
					minServicios($datos['id'],$datos['nombre'],$datos['precio'],$datos['descripcion'],$datos['imagen'],false);
				}
			}else{
				echo "No se han encontrado resultados.";
			}
			mysqli_close($conexion);

	}

function minServicios($id,$nombre,$precio,$descripcion,$imagen,$var){
	echo"
		</br></br>
		<div class='contenedor_not'>
			<h2>$nombre</h3>
			<hr>
			<p><strong>Descripción:</strong></p>
			<p>$descripcion</p>
			<p><strong>Precio:</strong> $precio"."€</p>
			<div class='contenedor_not2'>
				<img src=$imagen alt=nombre>
			</div>
		</div>";

}

function imprimirServicios(){
		$conexion=conectarBD();
		$con=mysqli_query($conexion, "select * from servicios");
		$num_resul=mysqli_num_rows($con);
		if($num_resul>0){
			echo "<table id='servicios'>";
			echo "<tr>";
				echo "<th></th>";
				echo "<th>Nombre</th>";
				echo "<th>Descripción</th>";
				echo "<th>Precio</th>";
			echo "</tr>";
			for($i=0;$i<$num_resul;$i++){
				$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
				if($i%2==0){
					echo "<tr>";
				}else {
					echo "<tr class='par'>";
				}
					echo "<td><img src='$datos[imagen]'</td>";
					echo "<td>$datos[nombre]</td>";
					echo "<td>$datos[descripcion]</td>";
					echo "<td>$datos[precio]€</td>";
					echo "<td>
							<a href='modificar-servicio.php?c=$datos[id]'>Modificar</a>
						</td>";
				echo "</tr>";
			}
			echo "</table>";
			mysqli_close($conexion);
		}else{
			echo "No hay servicios actualmente en la plataforma";
		}

}


function imprimirServicios_front(){
	$conexion=conectarBD();
	$con=mysqli_query($conexion, "select * from servicios");
	$num_resul=mysqli_num_rows($con);
	echo "<div class='t'>";
	if($num_resul>0){
		echo "<table id='servicios'>";
		echo "<tr>";
			echo "<th></th>";
			echo "<th>Servicio</th>";
			echo "<th>Descripción</th>";
			echo "<th>Precio</th>";
		echo "</tr>";
		for($i=0;$i<$num_resul;$i++){
			$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
			if($i%2==0){
				echo "<tr>";
			}else {
				echo "<tr class='par'>";
			}
				echo "<td><img src='$datos[imagen]'</td>";
				echo "<td>$datos[nombre]</td>";
				echo "<td>$datos[descripcion]</td>";
				echo "<td>$datos[precio]€</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
		mysqli_close($conexion);
	}else{
		echo "<p class='error'>No hay servicios actualmente en la plataforma</p>";
	}
}


?>
