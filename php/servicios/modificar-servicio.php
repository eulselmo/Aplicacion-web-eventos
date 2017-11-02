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
<?php
	menu_backend();
?>
<div class='cuerpo'>
<h1> Modificar servicio </h1>
<hr>
<?php
	submenuServicios();
?>
<br><br><br>
	<?php
		//Recogemos id del usuario que nos envía
		$id=$_GET['c'];
		//Obtenemos datos del cliente a modificar
		$conexion=conectarBD();
		$con=mysqli_query($conexion, "select * from servicios where id='$id'");
		$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
		mysqli_close($conexion);
		echo "
			Id: <input type='text' name='id' size='1' maxlength='15' value='$id' readonly style='background-color: lightgray;'>
			<form action='#' method='post' enctype='multipart/form-data'></br>
			Nombre: <input type='text' name='nombre' size='90' maxlength='20' value=$datos[nombre] required></br>
			<p>Descripción:</p>
			<textarea name='descripcion' cols='100' rows='10' maxlength='200' required>$datos[descripcion]</textarea></br></br>
			Precio(€): <input type='number' name='precio' size='10' maxlength='20' value=$datos[precio] required></br></br>
			<img src='$datos[imagen]' id='img_ser'></br></br>
			Imagen (JPEG/PNG): <input type='file' name='imagen'></br></br>
			<input type='submit' name='actualizar' value='Actualizar'>
			</br></br>
		</form>
		";

		if(isset($_POST['actualizar'])){
			$nombre=$_POST['nombre'];
			$descripcion=$_POST['descripcion'];
			$precio=$_POST['precio'];
			//Comprobar si sube una nueva imagen
			if($_FILES['imagen']['error']==0)
			{
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
					$ruta="../../IMG/servicios/$id"."$for";
					move_uploaded_file($tem_img, $ruta);
					$imagen=$ruta;
				}else{
					echo "Formato de imagen no reconocido. El servicio se guardará con la imagen anterior";
					$imagen=$datos['imagen'];
				}
			}else{
				$imagen=$datos['imagen'];
			}
			//Actualizar datos en la BD
				$conexion=conectarBD();
				$con=mysqli_query($conexion, "UPDATE servicios SET nombre='$nombre', descripcion='$descripcion', precio='$precio', imagen='$imagen' WHERE id='$id'");

				if($con==true){
					echo "Servicio actualizado correctamente";
				}else{
					echo "El servicio no ha podido actualizarse";
				}
				mysqli_close($conexion);

		}

	?>
	</div>
</body>
