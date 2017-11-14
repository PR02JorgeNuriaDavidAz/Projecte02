<!DOCTYPE html>
<html>
<head>
	<title>Titulo de PHP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<?php
	//Establecemos conexión con la base de datos

	error_reporting(0);
	$conexion=mysqli_connect("localhost","root","","bd_empresa");
	//Creamos el formulario de inserción de datos, recogeremos los valores con el método POST
	echo "<br><br><br>";
	echo "<form name='formulario' method='POST' action='forminsercio.php' accept-charset='UTF-8'>";
		echo "<div id=formanu>";
		//Comenzamos creando las primeras cajas de inserción de datos de la tabla anuncio
		echo "FORMULARIO INCIDENCIAS:<br>";
		echo "Nombre recurso:<br>";
		echo "<input required type='text' name='nombreRecursos' id='textbox'/><br>";
		echo "Tipo recurso:<br>";
			$sql1="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
			$qrecu= mysqli_query($conexion, $sql1);
			echo "<select name='tipoRecursos' required id='textbox'><br>";
				while ($row=mysqli_fetch_array($qrecu)) {
					echo '<option value="'.$row['tipoRecursos'].'">'.$row['tipoRecursos'].'</option>';
				}
			echo "</select><br>";

		echo "Descripcion:<br>";
		echo "<input type='text' name='descripcionIncidencia' id='textbox' required /><br>";
		echo "Fecha incidencia:<br>";
		echo "<input type='date' name='fechaIncidencia' min='2011-01-01' max='2017-12-10' id='textbox' required /><br>";
		echo "<input type='submit' name='Enviar'/><br>";

		
		if(isset($_POST['nombreRecursos'])) {

		$nombreRecursos=mysqli_real_escape_string($conexion, $_POST['nombreRecursos']);
		$tipoRecursos=mysqli_real_escape_string($conexion, $_POST['tipoRecursos']);
		$descripcionIncidencia=mysqli_real_escape_string($conexion, $_POST['descripcionIncidencia']);
		$fechaIncidencia=mysqli_real_escape_string($conexion, $_POST['fechaIncidencia']);

		$query="INSERT INTO tbl_recurso(nombreRecursos, tipoRecursos) VALUES ('$nombreRecursos', '$tipoRecursos')";
		$queryanunci="INSERT INTO tbl_incidencia(descripcionIncidencia, fechaIncidencia) VALUES ('$descripcionIncidencia', '$fechaIncidencia')";

		$resul1=mysqli_query($conexion, $queryanunci);
		$resul2=mysqli_query($conexion, $query);
		}

		

	?>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>