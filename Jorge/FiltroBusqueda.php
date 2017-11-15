<?php 
	error_reporting(0);
	$cont=0;


	$conexion=mysqli_connect("localhost","root","","bd_empresa");

		$query="SELECT * FROM `tbl_recurso`";

		if (($_REQUEST['nombreRecursos'])!='Cualquiera') {
				$nombreRecursos=utf8_decode($_REQUEST['nombreRecursos']);
			if ($cont==0) {
				$query=$query." WHERE nombreRecursos='$nombreRecursos'";
				$mysql=mysqli_query($conexion,$query);
				// echo $query;
			}else{
				$query=$query."AND WHERE nombreRecursos='$nombreRecursos'";				
				$mysql=mysqli_query($conexion,$query);
				// echo $query;
			}
			$cont++;
		}
				
		if (($_REQUEST['tipoRecursos'])!='Cualquiera') {
			$tipoRecursos=$_REQUEST['tipoRecursos'];
			if ($cont==0) {
				$query=$query. "WHERE tipoRecursos='$tipoRecursos'";
				$mysql=mysqli_query($conexion,$query);
				// echo $query;
			}else{
				$query=$query."AND WHERE tipoRecursos='$tipoRecursos'";				
				$mysql=mysqli_query($conexion,$query);
				// echo $query;
			
			}
			$cont++;
		}

		if (($_REQUEST['Ocupado'])!='Cualquiera') {
			$Ocupado=$_REQUEST['Ocupado'];
			if ($cont==0) {
				$query=$query. "WHERE Ocupado='$Ocupado'";
				$mysql=mysqli_query($conexion,$query);
				// echo $query;
			}else{
				$query=$query."AND WHERE Ocupado='$Ocupado'";				
				$mysql=mysqli_query($conexion,$query);
				// echo $query;
			
			}
			$cont++;
		}

		$numrows=mysqli_num_rows($mysql).'<br><br>';
		if ($numrows>0) {
			while ($row=mysqli_fetch_array($mysql)) {
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
		}
			

?>
