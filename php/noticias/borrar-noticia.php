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
	<h1> Borrar noticia </h1>
	<hr>
	<?php
		submenuNoticias();
	?>
<br><br><br>
	<p>Introduca el titular de la noticia para realizar una búsqueda:</p>
	<form action='#' method='post' enctype="multipart/form-data"></br>
			<input type='text' name='titular' size='90' maxlength='100' required>
			<input type='submit' name='enviar' value='Buscar'>
	</form>
	<?php
		if(isset($_POST['enviar'])){
			//Recogemos datos del formulario
			$titular=$_POST['titular'];
			$conexion=conectarBD();
			$con=mysqli_query($conexion, "select id, titular, imagen from noticias where titular LIKE '%$titular%'");
			$num_resul=mysqli_num_rows($con);
			//Si devuelve resultados los muestra, sino da un mensaje
				if($num_resul>0){
					for($i=0;$i<$num_resul;$i++){
						$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
						echo"
							</br></br>
							<div class='contenedor_not'>
								<h2>$datos[titular]</h3>
								<hr>
								<div class='contenedor_not2'>
									<img src=$datos[imagen] alt=$datos[titular]>
								</div>
								<div class='contenedor_not3'>
								<a href='bnoticia.php?i=$datos[id]'>Borrar</a>
								</div>
							</div>";
					}//Cierre for
			}
			else{
				echo "</br>";
				echo "No se han encontrado resultados.";
			}

			mysqli_close($conexion);
		}

	?>
	</div>
</body>
</html>
