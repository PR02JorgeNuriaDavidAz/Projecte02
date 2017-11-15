<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<style>
		input::-webkit-calendar-picker-indicator {
  			display: none;
  		}
	</style>
	<script>
		function funcion() {
		    $("select").each(function() { this.selectedIndex = 0 });
		}
	</script>
</head>
	<body>
		<form action='FiltroBusqueda.php' method='REQUEST' accept-charset='UTF-8'>
			<?php
			error_reporting(0);
			//Se inserta información referente al nombre
			$conexion=mysqli_connect("localhost","root","","bd_empresa");
			$q="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
			$querymuestranombre=mysqli_query($conexion,$q);
			echo "Filtro por nombre<br>";
			//Se inserta información referente al tipo de recurso
			?>
			<select name='nombreRecursos'>
				<option>Cualquiera</option>
				<?php
					while ($row=mysqli_fetch_array($querymuestranombre)) {
						echo '<option value="'.utf8_encode($row['nombreRecursos']).'">'.utf8_encode($row['nombreRecursos']).'</option>';
					}
				?>
			</select><br><br>
			<?php
			//Se inserta información referente al tipo de recurso
			$conexion1=mysqli_connect("localhost","root","","bd_empresa");
			$qn="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
			$querymuestratipo=mysqli_query($conexion1,$qn);
			echo "Filtro por nombre<br>";
			?>
			<select name='tipoRecursos'>
				<option>Cualquiera</option>
				<?php
					while ($row=mysqli_fetch_array($querymuestratipo)) {
						echo '<option value="'.utf8_encode($row['tipoRecursos']).'">'.utf8_encode($row['tipoRecursos']).'</option>';
					}
				?>
			</select><br><br>
			Filtro por disponibilidad:<br>
			<select name='Ocupado'>
				<option value="Cualquiera">Cualquiera</option>
				<option value="1">Disponible</option>
				<option value="0">Ocupado</option>
			</select><br><br>



			<input type='submit' name='Enviar'><br><br>

			<?php
				$query="SELECT * FROM `tbl_recurso`";
				$sql=mysqli_query($conexion, $query);
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
			?>
		</form>
	</body>
</html>