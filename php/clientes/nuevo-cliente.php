<!DOCTYPE html>
<?php
	include("../funciones.php");
	include("funciones-clientes.php");
		session_start();
		sesionAbierta();
		comprobarURL();
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nuevo cliente</title>
	<link href="../../CSS/estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		menu_backend();
	?>
	<div class='cuerpo'>
	<h1> Nuevo cliente </h1>
	<hr>
	<?php
		submenuClientes();
	?>
	<br><br><br>
		<?php
			//Obtenemos el próximo id de cliente
			$conexion=conectarBD();
			$con=mysqli_query($conexion, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA =  'agenda' and TABLE_NAME = 'clientes'");
			$id=mysqli_fetch_array($con, MYSQLI_ASSOC);
			mysqli_close($conexion);
		?>
		<form action='#' method='post'></br>
		<?php
			echo "Id: <input type='text' name='id' size='1' maxlength='15' value='$id[AUTO_INCREMENT]' readonly style='background-color: lightgray;'></br></br>";
			?>
			Nombre*: <input type='text' name='nombre' size='30' maxlength='15' required>&nbsp&nbsp&nbsp&nbspApellidos*: <input type='text' name='apellidos' size='30' maxlength='30' required></br></br>
			Dirección*: <input type='text' name='direccion' size='50' maxlength='50' required></br></br>
			Teléfono*: <input type='text' name='telefono' size='9' maxlength='9' required>&nbsp&nbsp&nbsp&nbspTeléfono 2: <input type='text' name='telefono2' size='9' maxlength='9'></br></br>
			Nick*: <input type='text' name='nick' size='30' maxlength='15' required></br></br>
			Password*: <input type='text' name='password' size='30' maxlength='15' required></br></br>
			<input type='submit' name='enviar'>
			</br></br>
			<p><strong>Los campos marcados con (*) con obligatorios</strong></p>
		</form>
		<?php
		if(isset($_POST['enviar'])){
			$telefono=$_POST['telefono'];
			if(preg_match("/^[1-9]{9}$/",$telefono)){
				$telefono2=$_POST['telefono2'];
				if(preg_match("/^[1-9]{9}$/",$telefono2) || $telefono2==""){
					$nombre=trim($_POST['nombre']);
					$apellidos=trim($_POST['apellidos']);
					$direccion=trim($_POST['direccion']);
					$nick=trim($_POST['nick']);
					$password=($_POST['password']);
					//Comprobamos que el nick de usuario no exista
					$num_resul=comprobarUsuario($nick);
					if($num_resul==0){
						//Insertamos los datos en la BD y mostramos si se han introducido correctamente
						$conexion=conectarBD();
						$comp=mysqli_query($conexion, "insert into clientes values (null,'$nombre','$apellidos','$direccion','$telefono','$telefono2','$nick','$password')");
						if($comp=='true'){
							echo "Cliente subido correctamente.";
						}else{
							echo "Ha habido un error al dar de alta el cliente. Vuelva a intentarlo.";
						}
						mysqli_close($conexion);
					}else{
						echo "El nick que ha introducido ya existe. Pruebe con otro.";
					}
				}else{
					echo "El teléfono 2 introducido no es correcto";
				}
			}else{
				echo "El teléfono 1 introducido no es correcto";
			}

		}
	?>
	</div>
</body>
</html>
