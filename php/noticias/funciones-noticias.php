<?php

	/* Buscar y mostrar noticia completa */

	function buscarNoticia($titular,$ordenar){
		$conexion=conectarBD();
		//Dependiendo del valor de $ordenar la consulta ordenará los datos por distintos campos
		if($ordenar=='titular'){
			$con=mysqli_query($conexion, "select id, titular, contenido, imagen, fecha from noticias where titular LIKE '%$titular%' ORDER BY titular asc");
		}else{
			$con=mysqli_query($conexion, "select id, titular, contenido, imagen, fecha from noticias where titular LIKE '%$titular%' ORDER BY fecha asc");
		}
			$num_resul=mysqli_num_rows($con);
			if($num_resul>0){
				for($i=0;$i<$num_resul;$i++){
					$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
					minNoticias($datos['id'],$datos['titular'],$datos['imagen'],$datos['contenido'],1);
				}
			}else{
				echo "No se han encontrado resultados.";
			}
			mysqli_close($conexion);
	}

	function minNoticias($id,$tit,$img,$cont,$r){
		echo"
			</br></br>
			<div class='contenedor_not'>
				<h2>$tit</h2>
				<div class='contenedor_not2'>
					<img src=$img alt=$tit>";

					if($r==0){
						echo "<a class='enlaceboton' href='PHP/noticias/noticia-completa_front.php?c=$id'>Leer más...</a>";
					}else{
							//Enviamos a "noticia completa" los datos de la noticia
						echo "<a class='enlaceboton' href='noticia-completa.php?c=$id'>Leer más...</a>";
					}
				echo "</div>";
			echo "</div>";
	}

	function noticiaCompleta($id,$zona){
		$conexion=conectarBD();
		$con=mysqli_query($conexion, "select titular, contenido, imagen from noticias where id=$id");
		$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
		echo"
			</br></br>
			<div id='noticiaCompleta'>
				<h2>$datos[titular]</h2>
				</br>";
				echo "<img src=$datos[imagen]>";
				echo "<p>$datos[contenido]</p>";
				echo "</br></br>";
				if($zona==1){
					echo "<a href='noticias.php'>Volver atrás...</a>";
				}
			echo "</div>";
		mysqli_close($conexion);
	}

	/* Borrar noticia */

	function borrar($borrar){
				$conexion2=conectarBD();
				$img=mysqli_query($conexion2, "select imagen from noticias where id=$borrar");
				$img_result=mysqli_fetch_array($img, MYSQLI_ASSOC);
				$con=mysqli_query($conexion2, "delete from noticias where id='$borrar'");
				unlink("$img_result[imagen]");

				if($con=='true'){
					echo "Noticia borrada correctamente.";
				}else{
					echo "Ha habido un error al borrar la notica. Vuelva a intentarlo.";
				}
				mysqli_close($conexion2);
	}


?>
