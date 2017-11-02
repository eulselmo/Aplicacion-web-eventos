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
	<title>Nueva noticia</title>
	<link href="../../CSS/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		menu_backend();
	?>
	<div class='cuerpo'>
	<h1> Nueva noticia </h1>
	<hr>
	<?php
		submenuNoticias();
	?>
<br><br><br>
		<?php
			//Obtenemos el próximo id de la próxima noticia
			$conexion=conectarBD();
			$con=mysqli_query($conexion, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'agenda' and TABLE_NAME = 'noticias'");
			$id=mysqli_fetch_array($con, MYSQLI_ASSOC);
			mysqli_close($conexion);
		?>
		<form action='#' method='post' enctype="multipart/form-data"></br>
			<?php
				echo "Id: <input type='text' name='id' size='1' maxlength='15' value='$id[AUTO_INCREMENT]' readonly style='background-color: lightgray;'></br></br>";
			?>
			Titular: <input type='text' name='titular' size='90' maxlength='100' required></br>
			<p>Contenido:</p>
			<textarea name='contenido' cols='100' rows="10" maxlength='1000' required></textarea></br></br>
			Imagen (JPEG/PNG): <input type='file' name='imagen' required></br>
			<p>Disponibilidad de la noticia:</p>
			<input type='date' name='fecha' required></br></br>
			<input type='submit' name='enviar'>
			</br></br>
		</form>
		<p><strong>(*) Todos los campos son obligatorios.</strong></p>
		<?php
		//Obtenemos fecha actual para comprobar que la fecha de activación de la noticia
		//no sea pasada
		$f_actual=time();
		$d_actual=date('d',$f_actual);
		$a_actual=date('Y',$f_actual);
		$m_actual=date('m',$f_actual);
		$fe_actual=$a_actual."-".$m_actual."-".$d_actual;
		//Recogemos datos y realizamos comprobaciones, si el contenido es adecuado se subirá la noticia
		if(isset($_POST['enviar'])){

			$fecha=$_POST['fecha'];
			if($fecha>=$fe_actual){
				//Comprobamos que la imagen tenga uno de los formatos admitidos
				$formato=$_FILES['imagen']['type'];
				$for="";
				switch ($formato) {
					case 'image/jpeg': $for='.jpg';
						break;

					case 'image/png': $for='.png';
						break;
				}

				if($for=='.jpg' || $for=='.png'){
					//Recogemos el resto de datos de la noticia
					$titular=trim($_POST['titular']);
					$contenido=trim($_POST['contenido']);
					//Copiamos imágenes a nuestra ruta del servidor
					$nom_img=$_FILES['imagen']['name'];
					$tem_img=$_FILES['imagen']['tmp_name'];
					//Comprobamos el próximo valor id que tomará en la BD para ponérselo como nombre a la imagen
					$conexion=conectarBD();
					$con=mysqli_query($conexion, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'agenda' and TABLE_NAME = 'noticias'");
					mysqli_close($conexion);
					$id=mysqli_fetch_array($con, MYSQLI_ASSOC);
					$ruta="../../IMG/noticias/$id[AUTO_INCREMENT]"."$for";
					move_uploaded_file($tem_img, $ruta);
					//Insertamos los datos en la BD y mostramos si se han introducido correctamente
					$conexion=conectarBD();
					$comp=mysqli_query($conexion, "insert into noticias values (null,'$titular','$contenido','$ruta','$fecha')");
					if($comp=='true'){
						echo "Noticia subida correctamente.";
					}else{
						echo "Ha habido un error al subir la notica. Vuelva a intentarlo.";
					}
					mysqli_close($conexion);
				}else{
					echo "Formato de imagen no soportado.";
				}
			}else{
				echo "La fecha de activación de una noticia no puede ser pasada";
			}
		}
	?>
	</div>
</body>
</html>
