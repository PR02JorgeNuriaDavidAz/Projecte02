<?php 
	error_reporting(0);
	if (isset($_REQUEST['Enviar'])) {

	$conexion=mysqli_connect("localhost","root","","bd_empresa");
		$value=utf8_decode($_REQUEST['nombreRecursos']);
		$value1=utf8_decode($_REQUEST['tipoRecursos']);

		$query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos='$value' AND tipoRecursos='$value1'";

		$sql=mysqli_query($conexion, $query);

		$numrows=mysqli_num_rows($sql).'<br><br>';

		if ($numrows>0) {
			while ($row=mysqli_fetch_array($sql)) {
				echo "El ID del recurso es: ".$row['idRecurso'].'<br>';
				echo "El nombre del recurso es: ".utf8_encode($row['nombreRecursos']).'<br>';
				echo "El tipo de recurso es: ".$row['tipoRecursos'].'<br>';
				if ($row['Ocupado']==0) {
						echo 'Disponible: No <br>';				
					} elseif ($row['Ocupado']==1){
						echo 'Disponible: Sí <br>';
					}
				echo 'Veces reservado: '.$row[''].'<br>';
				echo 'Hora de la reserva: '.$row[''].'<br><br><br>';
			}
		}else {
			echo "Su busqueda no ha generado registros.";
		}
	}
?>
