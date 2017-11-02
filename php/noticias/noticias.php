<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-noticias.php");
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
	<h1> Noticias </h1>
	<hr>
	<?php
		submenuNoticias();
	?>
</br><br><br>
	<div class='cuerpo_not'>
		<?php
			//Contamos el número total de noticias que tenemos
			$conexion=conectarBD();
			$con=mysqli_query($conexion, "select count(id) contar from noticias order by fecha desc");
			$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
			$total_noticias=$datos['contar'];
			if($total_noticias>0){
				$not_por_pagina=6;
				if(!isset($_GET['pagina'])){
					$inicio=1;
				}else{
					$inicio= ($_GET['pagina']-1) * $not_por_pagina;
				}

				//Obtenemos el número de páginas total que habrá
				$total_paginas = ceil($total_noticias/$not_por_pagina);

				//Consultamos las noticias limitando por la cantidad (5) y la página en la que este el usuario
				$not = mysqli_query($conexion, "select id,titular,imagen,contenido from noticias order by fecha desc LIMIT $inicio, $not_por_pagina");


				//Sacamos los datos del array obtenido
				echo "<div class='noticias'>";
					while($noticias= mysqli_fetch_array($not)) {
						echo "<div class='noticia'>";
							minNoticias($noticias['id'],$noticias['titular'],$noticias['imagen'],$noticias['contenido'],1);
						echo "</div>";
					}
				echo "</div>";
				?>
			</br></br><br><br>

	</div>
	<div class='paginacion'>
		<hr>

			| <?php
			//Paginación
			for ($i=1; $i<=$total_paginas; $i++) {
				//En el bucle se muestra la paginación
				echo "<a href='?pagina=".$i."'>".$i."</a> | ";
			}
		}else{
			echo "</br></br>";
			echo "No hay noticias actualmente";
		}
?>
	</div>
</div>
</body>
</html>
