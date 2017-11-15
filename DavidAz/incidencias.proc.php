<?php
	include('conexio.php');

	$qn="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
	$querymuestran=mysqli_query($conexion,$qn);
	$sql1="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
	$qrecu= mysqli_query($conexion, $sql1);

	if(isset($_POST['nombreRecursos'])) {
		$descripcionIncidencia=mysqli_real_escape_string($conexion, utf8_decode($_POST['descripcionIncidencia']));
		$fechaIncidencia=mysqli_real_escape_string($conexion, $_POST['fechaIncidencia']);
		$nombreRecursos=mysqli_real_escape_string($conexion, $_POST['nombreRecursos']);

		$queryanunci="INSERT INTO tbl_incidencia(descripcionIncidencia, fechaIncidencia) VALUES ('$descripcionIncidencia', '$fechaIncidencia')";

		$resul1=mysqli_query($conexion, $queryanunci);	

		header('location: principal.php');

		
		
	}


	// $nombreRecursos = $_REQUEST['nombreRecursos'];
	// $tipoRecursos = $_REQUEST['tipoRecursos'];
	// $desc = $_REQUEST['desc'];
	// $fechaIncidencia = $_REQUEST['fechaIncidencia'];

	// echo "$nombreRecursos";
	// echo "$tipoRecursos";
	// echo "$desc";
	// echo "$fechaIncidencia";



