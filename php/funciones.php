<?php
function comprobarURL_front(){
	if(isset($_SESSION['tipo'])){
		if($_SESSION['tipo']!=1){
			header ("location: ../error/error.php");
		}
	}else {
		header ("location: ../error/error.php");
	}
}

function comprobarURL(){
	if(isset($_SESSION['tipo'])){
		if($_SESSION['tipo']!=0){
			header ("location: ../error/error.php");
		}
	}else {
		header ("location: ../error/error.php");
	}
}

function comprobarAcceder(){
	if(isset($_SESSION['tipo'])){
		if($_SESSION['tipo']==0){
			header ("location: ../noticias/noticias.php");
		}else {
			header ("location: ../../index.php");
		}
	}
}

function sesionAbierta(){
	if(isset($_COOKIE['eventos'])){
			session_decode($_COOKIE['eventos']);
	}
}

function iniciarSesion($usuario,$contrasena,$activa){
	$conexion=conectarBD();
	$con=mysqli_query($conexion, "select nick, pass from clientes where nick='$usuario'");
	$num_resul=mysqli_num_rows($con);
	if($num_resul==1){
		$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
		if($contrasena==$datos['pass']){
			$_SESSION['usuario']=$usuario;
			if($usuario=="admin"){
				$_SESSION['tipo']=0;
				header ("location: ../noticias/noticias.php");
			}else{
				$_SESSION['tipo']=1;
				header ("location: ../../index.php");

			}
			//Si $activa vale 1 el usuario ha seleccionado que desea mantener la sesión iniada
			if($activa==1){
				//Guardamos variable $_SESSION en una variable para almacenarla en la cookie que crearemos
				$sesion=session_encode();
				//Creación de cookie por 90 días
				setcookie("eventos","$sesion",time()+86400*90,'/');

			}

		}else{
				echo "<p class='error'>Contraseña inválida</p>";
		}
	}else{
		echo "<p class='error'>El usuario no existe</p>";
	}
}

function cerrarSesion($ruta){
	$_SESSION=array();
	session_destroy();
	setcookie("eventos",'',time()-86400,'/');
	if($ruta=='..'){
			header ("location: ../../index.php");
		}else{
			header ("location: index.php");
		}
}

function imprimirMenu($ruta){
	echo "
	<header>
			<nav id='navegador'>";
			if($ruta=='..'){
					echo "<img src='..\..\img\logotipo\logo.png'>";
				}else{
					echo "<img src='img\logotipo\logo.png'>";
				}

				echo "<ul>";
				if($ruta=='..'){
					echo "<li><a href='../../index.php'>Inicio</a></li>";
				}else{
					echo "<li><a href='index.php'>Inicio</a></li>";
				}
				echo "<li><a href='$ruta/servicios/servicios_front.php'>Servicios</a></li>";
				if(isset($_SESSION['tipo'])){
					if($_SESSION['tipo']!=0){
							echo "<li><a href='$ruta/contactar/contactar.php'>Contacto</a></li>";
					}
				}else{
						echo "<li><a href='$ruta/contactar/contactar.php'>Contacto</a></li>";
				}

				if(isset($_SESSION['tipo'])){
					if($_SESSION['tipo']==0){
						echo "<li class='acceder'><a href='$ruta/noticias/noticias.php'>Área interna</a></li>";
					}else{
						echo "<li><a href='$ruta/eventos/mis-eventos.php'>Mis eventos</a></li>";
						echo "<li><a href='$ruta/clientes/mis-datos.php'>Mis datos</a></li>";
						if($ruta=='..'){
								echo "<li class='acceder'><a href='../../index.php?c=true'>Cerrar Sesión \"$_SESSION[usuario]\"</a></li>";
							}else{
								echo "<li class='acceder'><a href='index.php?c=true'>Cerrar Sesión \"$_SESSION[usuario]\"</a></li>";
							}
					}
				}else{
					echo "<li class='acceder'><a href='$ruta/acceder/acceder.php'>Acceder</a></li>";
				}
			echo "</ul>
		</nav>
	</header>";
}

function menu_backend(){
	echo"
	<div id='submenu'>
		<div class='inicio'>
			<a href='../../index.php'><img src='../../img/logotipo/logo.png'></a>
		</div>
		<ul class='submenu'>
			<li><img class='iconos' src='../../img/iconos/Noticias.png'><a href='../noticias/noticias.php'> Noticias</a></li><br><br>
			<li><img class='iconos' src='../../img/iconos/Clientes.png'><a href='../clientes/clientes.php'> Clientes</a></li><br><br>
			<li><img class='iconos' src='../../img/iconos/Servicios.png'><a href='../servicios/servicios.php'> Servicios</a></li><br><br>
			<li><img class='iconos' src='../../img/iconos/Eventos.png'><a href='../eventos/eventos.php'> Eventos</a></li><br><br>
		</ul>
		<a href='../../index.php?c=true'><img class='cerrarsesion' src='../../img/iconos/cerrar.png'></a>
	</div>";
}

function imprimirFooter(){
	echo "
	<div id='footer'>
		<p>Desarrollada por José Rafael Aguilera García. 2º DAW </p>
		<p>Para la asignatura de Programación en Entorno Servidor y Diseño Web</p>
	</div>
	";
}



function submenuNoticias(){
	echo"
	<div id='opciones'>
		<ul>
			<li><img class='iconos_sub' src='../../img/iconos/Nueva.png'><a href='nueva-noticia.php'>Nueva</a></li>
			<li><img class='iconos_sub' src='../../img/iconos/Buscar.png'><a href='buscar-noticia.php'>Buscar</a></li>
			<li><img class='iconos_sub' src='../../img/iconos/Borrar.png'><a href='borrar-noticia.php'>Borrar</a></li>
		</ul>
	</div>
	";
}

function submenuClientes(){
	echo"
	<div id='opciones'>
		<ul>
			<li><img class='iconos_sub' src='../../img/iconos/Nueva.png'><a href='nuevo-cliente.php'>Nuevo</a></li>
			<li><img class='iconos_sub' src='../../img/iconos/Buscar.png'><a href='buscar-cliente.php'>Buscar</a></li>
		</ul>
	</div>
	";
}

function submenuServicios(){
	echo"
	<div id='opciones'>
		<ul>
			<li><img class='iconos_sub' src='../../img/iconos/Nueva.png'><a href='nuevo-servicio.php'>Nuevo</a></li>
			<li><img class='iconos_sub' src='../../img/iconos/Buscar.png'><a href='buscar-servicio.php'>Buscar</a></li>
		</ul>
	</div>
	";
}

function submenuEventos(){
	echo"
	<div id='opciones'>
		<ul>
			<li><img class='iconos_sub' src='../../img/iconos/Nueva.png'><a href='nuevo-evento.php'>Nuevo</a></li>
			<li><img class='iconos_sub' src='../../img/iconos/Buscar.png'><a href='buscar-evento.php'>Buscar</a></li>
			<li><img class='iconos_sub' src='../../img/iconos/Borrar.png'><a href='borrar-evento.php'>Borrar</a></li>
		</ul>
	</div>
	";
}

function conectarBD(){
	$conexion=mysqli_connect("localhost", "root","", "agenda");
	return $conexion;
}

?>
