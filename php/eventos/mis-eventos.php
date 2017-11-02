<!DOCTYPE html>
<?php
include("../funciones.php");
include("funciones-eventos.php");
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
  <br><br>
	<div class='cuerpo'>
    <h1>Mis eventos</h1>
    <?php
  		//Consultamos cuál es el año más antiguo de nuestra base de datos
  		$conexion=conectarBD();
  			$servicios=mysqli_query($conexion, "SELECT fecha FROM eventos GROUP BY fecha ORDER BY fecha ASC");
  			$datos=mysqli_fetch_array($servicios, MYSQLI_ASSOC);
  			$a_antiguo=$datos['fecha'];
  			//Obtenemos su marca de tiempo para operar luego extraer el año
  			$antigua=strtotime ($a_antiguo);
  			$a_antiguo=date('Y',$antigua);
  			//Obtenemos el año actual
  		$f_actual=time();
  		$a_actual=date('Y',$f_actual);
  		$m_actual=date('m',$f_actual);
      echo "";
  		//Opciones de mes
  		echo "<form action='mis-eventos.php' method='GET'>";
  		echo "Mes: <select name='mes'>";
  			echo "<option selected value='$m_actual'>Mes actual</option>";
  			echo "<option>**************</option>";
  			echo "<option value='01'>Enero</option>";
  			echo "<option value='02'>Febrero</option>";
  			echo "<option value='03'>Marzo</option>";
  			echo "<option value='04'>Abril</option>";
  			echo "<option value='05'>Mayo</option>";
  			echo "<option value='06'>Junio</option>";
  			echo "<option value='07'>Julio</option>";
  			echo "<option value='08'>Agosto</option>";
  			echo "<option value='09'>Septiembre</option>";
  			echo "<option value='10'>Octubre</option>";
  			echo "<option value='11'>Noviembre</option>";
  			echo "<option value='12'>Diciembre</option>";
  		echo "</select>";
  		echo "&emsp;";
  		//Opciones de año, mostrará además 2 años más en el futuro
  		echo "Año: <select name='anio'>";
  			echo "<option selected value='$a_actual'>Año actual</option>";
  			echo "<option>**************</option>";
  			for ($i=$a_antiguo;$i<=$a_actual+2;$i++){
  				echo "<option value='$i'>$i</option>";
  			}
  		echo "</select>";
  	?>
  	</br></br>
  		<input type='submit' name='enviar' value='Ir a fecha'>
  	</form>
  	</br>
  	<?php
  		if(isset($_GET['enviar']) || isset($_GET['mes'])){
  			$mes=$_GET['mes'];
  			$anio=$_GET['anio'];
  			generarCalendario_front($mes,$anio);
  		}else{
  			generarCalendario_front($m_actual,$a_actual);
  		}
  	?>
	</div>
</body>
</html>
