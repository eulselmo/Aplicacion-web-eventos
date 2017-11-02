<!DOCTYPE html>
<?php
include("../funciones.php");
include("funciones-clientes.php");
  session_start();
  sesionAbierta();
  comprobarURL_front();
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="../../CSS/estilos_frontend.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php imprimirMenu("..") ;?>
	<div class='cuerpo'>
    <?php

		//Obtenemos datos del usuario activo
		$conexion=conectarBD();
		$con=mysqli_query($conexion, "select * from clientes where nick='$_SESSION[usuario]'");
		$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
		mysqli_close($conexion);
		//Formulario relleno con los datos del cliente y que podrá modificar
    echo "<h1>Mis datos</h1>";
	echo "
	<form action='#' method='post'></br>
      <input type='hidden' name='id' value='$datos[id]'>
			Nombre: <input type='text' name='nombre' size='30' maxlength='15' value='$datos[nombre]' required></br></br>
      Apellidos: <input type='text' name='apellidos' size='30' maxlength='30' value='$datos[apellidos]' required></br></br>
			Dirección: <input type='text' name='direccion' size='50' maxlength='50' value='$datos[direccion]' required></br></br>
			Teléfono: <input type='tel' name='telefono' size='9' maxlength='9' value='$datos[telefono1]' required></br></br>
      Teléfono 2: <input type='tel' name='telefono2' size='9' maxlength='9' value='$datos[telefono2]''></br></br>
			Nick: <input type='text' name='nick' size='30' maxlength='15' value='$datos[nick]' required readonly='readonly' style='background-color: lightgray;'></br></br>
			Password: <input type='text' name='pass' size='30' maxlength='15' value='$datos[pass]' required></br></br>
			<input type='submit' name='actualizar' value='Actualizar'>
			</br></br>
		</form>";

		if(isset($_POST['actualizar'])){
      $id=$_POST['id'];
			$nombre=$_POST['nombre'];
			$apellidos=$_POST['apellidos'];
			$direccion=$_POST['direccion'];
			$telefono=$_POST['telefono'];
			$telefono2=$_POST['telefono2'];
			$nick=$_POST['nick'];
			$pass=$_POST['pass'];
				$conexion=conectarBD();
				$con=mysqli_query($conexion, "UPDATE clientes SET nombre='$nombre', apellidos='$apellidos', direccion='$direccion', telefono1='$telefono', telefono2='$telefono2', nick='$nick', pass='$pass' WHERE id='$id'");

				if($con==true){
					echo "Cliente actualizado correctamente";
          header('refresh:0.2;url= mis-datos.php');
				}else{
					echo "El usuario no ha podido actualizarse";
				}
				mysqli_close($conexion);
		}
	?>

	</div>
	<?php
		imprimirFooter();
	?>
</body>
</html>
