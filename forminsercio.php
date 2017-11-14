<!DOCTYPE html>
<html>
<head>
	<title>Titulo de PHP</title>
	<script>
		function submitForm() {
		   var frm = document.getElementsByName('formulario')[0];
		   frm.submit();
		   frm.reset(); 
		   return false; //
		}
	</script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<style>
		input::-webkit-calendar-picker-indicator {
  			display: none;
  		}
	</style>
</head>
<body>
<?php
	//Establecemos conexión con la base de datos
	
	if(isset($_REQUEST['descripcionIncidencia'])&&isset($_REQUEST['nombreRecursos'])&&isset($_REQUEST['fechaIncidencia'])) {

		error_reporting(0);
		$conexion=mysqli_connect("localhost","root","","bd_empresa");
		//Creamos el formulario de inserción de datos, recogeremos los valores con el método POST
		echo "<br><br><br>";
		echo "<form name='formulario' method='POST' action='forminsercio.php' accept-charset='UTF-8'>";
			echo "<div id=formanu>";
			//Comenzamos creando las primeras cajas de inserción de datos de la tabla anuncio
			echo "FORMULARIO INCIDENCIAS:<br>";

			//DATALIST NOMBRE RECURSO

			$qn="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
			$querymuestran=mysqli_query($conexion,$qn);
			echo "Nombre recurso<br>";
			echo "<select id='nombreRecursos' name='nombreRecursos'>";
					echo "<option></option>";
				while ($row=mysqli_fetch_array($querymuestran)) {
					echo '<option value="'.utf8_encode($row['nombreRecursos']).'">'.utf8_encode($row['nombreRecursos']).'</option>';
				}
			echo "</select><br>";

			//SELECT TIPO RECURSO
			echo "Tipo recurso:<br>";
				$sql1="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
				$qrecu= mysqli_query($conexion, $sql1);
				echo "<select name='tipoRecursos' required id='textbox'><br>";
					while ($row=mysqli_fetch_array($qrecu)) {
						echo '<option value="'.$row['tipoRecursos'].'">'.$row['tipoRecursos'].'</option>';
					}
				echo "</select><br>";
			//INPUT DESCRIPCIÓN
			echo "Descripcion:<br>";
			echo "<input type='text' name='descripcionIncidencia' id='textbox' required /><br>";
			//INPUT INCIDENCIA
			echo "Fecha incidencia:<br>";
			echo "<input type='datetime-local' name='fechaIncidencia' size='20' id='textbox' required /><br>";
			//SUBMIT
			echo "<input type='button' value='Submit' id='btnsubmit' onclick='submitForm();'><br>";

			
			if(isset($_POST['nombreRecursos'])) {

			$descripcionIncidencia=mysqli_real_escape_string($conexion, utf8_decode($_POST['descripcionIncidencia']));
			$fechaIncidencia=mysqli_real_escape_string($conexion, $_POST['fechaIncidencia']);


			$queryanunci="INSERT INTO tbl_incidencia(descripcionIncidencia, fechaIncidencia) VALUES ('$descripcionIncidencia', '$fechaIncidencia')";

			$resul1=mysqli_query($conexion, $queryanunci);
			$resul2=mysqli_query($conexion, $query);
			}
		}
		

	?>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>