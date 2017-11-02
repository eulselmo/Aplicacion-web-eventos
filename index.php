<!DOCTYPE html>
<?php
session_start();
include("PHP/funciones.php");
include("PHP/noticias/funciones-noticias.php");
sesionAbierta();
if(isset($_GET['c'])){
	cerrarSesion();
}
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link href="css/estilos_frontend.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
	<?php imprimirMenu("php") ;?>
	<div id='principal'>
	<?php
		//Imagen aleatoria evento
		$conexion=conectarBD();
		//Comprobamos número de servicios en la plataforma
		$conec=mysqli_query($conexion, "select imagen from servicios");
		$num_resul=mysqli_num_rows($conec);
		$random=rand (1,$num_resul);
		for($i=0;$i<$random;$i++){
			$imagenes=mysqli_fetch_array($conec, MYSQLI_ASSOC);
		}
		$banner = substr ($imagenes['imagen'] ,6);
		echo "<img src='$banner' id='banner'>";
		//Obtenemos fecha actual
		$f_actual=time();
		$d_actual=date('d',$f_actual);
		$a_actual=date('Y',$f_actual);
		$m_actual=date('m',$f_actual);
		$fe=$a_actual."-".$m_actual."-"."$d_actual";
		//Últimas 3 noticias publicadas
		echo "<div id='ultimas_noticias' align='center'>";
		echo "<h1><strong>ÚLTIMAS NOTICIAS </strong></h1>";
		$con=mysqli_query($conexion, "select id, titular, contenido, imagen from noticias where '$fe'>=fecha order by fecha DESC LIMIT 3");
		$num_resul=mysqli_num_rows($con);
			if($num_resul>0){
				for($i=0;$i<$num_resul;$i++){
					$datos=mysqli_fetch_array($con, MYSQLI_ASSOC);
					$img = substr ($datos['imagen'] ,6);
					echo "<div class='elemento'>";
					minNoticias($datos['id'],$datos['titular'],$img,$datos['contenido'],0);
					echo "</div>";
				}
			}else{
				echo "<p class='error'> No hay noticias en la plataforma</p>";
			}
		echo "</div>";
		mysqli_close($conexion);
	?>
	</div>
	<?php
		//Footer
		imprimirFooter();
	?>

</body>
</html>
