<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-servicios.php");
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
	<h1> Nuevo servicio </h1>
	<hr>
	<?php
		submenuServicios();
	?>
<br><br><br>
		<?php
			//Obtenemos el próximo id de cliente
			$conexion=conectarBD();
			$con=mysqli_query($conexion, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'agenda' and TABLE_NAME = 'servicios'");
			$id=mysqli_fetch_array($con, MYSQLI_ASSOC);
			mysqli_close($conexion);
		?>
		<form action='#' method='post' enctype="multipart/form-data"></br>
			<?php
echo "Id: <input type='text' name='id' size='1' maxlength='15' value='$id[AUTO_INCREMENT]' readonly style='background-color: lightgray;'></br></br>";
			?>
			Nombre: <input type='text' name='nombre' size='90' maxlength='20' required></br>
			<p>Descripción:</p>
			<textarea name='descripcion' cols='100' rows="10" maxlength='200' required></textarea></br></br>
			Precio(€): <input type='number' name='precio' size='10' maxlength='20' required></br></br>
			Imagen (JPEG/PNG): <input type='file' name='imagen' required></br></br>
			<input type='submit' name='enviar'>
			</br></br>
		</form>
		<p><strong>(*) Todos los campos son obligatorios.</strong></p>
		<?php
		if(isset($_POST['enviar'])){
			//Recogemos los datos enviados con el formulario
			$nombre=trim($_POST['nombre']);
			$descripcion=trim($_POST['descripcion']);
			$precio=$_POST['precio'];
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
				//Copiamos imágenes a nuestra ruta del servidor
				$nom_img=$_FILES['imagen']['name'];
				$tem_img=$_FILES['imagen']['tmp_name'];
				$ruta="../../IMG/servicios/$id[AUTO_INCREMENT]"."$for";
				$ruta=str_replace(' ', '_',$ruta); //Sustituimos los espacios de la imagen por barra baja, para que luego no de problemas
				move_uploaded_file($tem_img, $ruta);
				//Insertamos los datos en la BD y mostramos si se han introducido correctamente
				$conexion=conectarBD();
				$comp=mysqli_query($conexion, "insert into servicios values (null,'$nombre','$descripcion','$precio','$ruta')");
				//Comprobamos si se ha insertado correctamente el servicio
				if($comp=='true'){
					echo "Servicio creado correctamente.";
				}else{
					echo "Ha habido un error creando el servicio. Vuelva a intentarlo.";
				}
				mysqli_close($conexion);
			}else{
				echo "Formato de imagen no soportado.";
			}

		}
	?>
	</div>
</body>
</html>
