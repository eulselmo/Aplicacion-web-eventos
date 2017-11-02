<!DOCTYPE html>
<?php
include("../funciones.php");
session_start();
comprobarAcceder();
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="../../CSS/estilos_frontend.css" rel="stylesheet" type="text/css">
  <link href="../../CSS/estilo_login.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php imprimirMenu("..") ;?>
	<div class='cuerpo'>
  <br><br>
    <div class="container">
      <div class="card"></div>
      <div class="card">
        <h1 class="title">Iniciar sesión</h1>
        <form action='#' method='POST'>
          <div class="input-container">
            <input type="text" id="#{label}" name='nick' required="required"/>
            <label for="#{label}">Usuario</label>
            <div class="bar"></div>
          </div>
          <div class="input-container">
            <input type="password" id="#{label}" name='pass' required="required"/>
            <label for="#{label}">Contraseña</label>
            <div class="bar"></div>
          </div>
          <div>
            <label >Mantener sesión abierta</label> <input type='checkbox'  name='sesion_activa'>
          </div>
          <div class="button-container">
            	<input type='submit' id='acceder' name='enviar' id='enviar' value='Acceder'>
          </div>
        </form>
      </div>
    </div>

		<?php
			if(isset($_POST['enviar'])){
				$usuario=$_POST['nick'];
				$contrasena=$_POST['pass'];
        if(isset($_POST['sesion_activa'])){
          iniciarSesion($usuario,$contrasena,1);
        }else{
          iniciarSesion($usuario,$contrasena,0);
        }

			}
		 ?>
	</div>
	<?php
		imprimirFooter();
	?>
</body>
</html>
