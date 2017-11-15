<?php 
	error_reporting(0);
			//Se inserta información referente al nombre
	include('conexio.php');

	if (null!==($_REQUEST['tipoRecursos']) AND ($_REQUEST['nombreRecursos'])){
		header('location: principal.php');
	}else{
		$q="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
		$querymuestranombre=mysqli_query($conexion,$q);


		$qn="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
		$querymuestratipo=mysqli_query($conexion,$qn);
	}