<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="hojaEstilos.css">
	<title>Reservar</title>
</head>
<body>
	<form action="reserva.php" method="REQUEST">

		<?php
		$conexion=mysqli_connect("localhost", "root", "", "bd_empresa");

		if(!$conexion){
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			exit;
		} else {
			mysqli_query($conexion, "SET NAMES 'utf8'");	
			$q = "SELECT * FROM tbl_recurso where ocupado = 1 ";
			$resultados = mysqli_query($conexion, $q);	
			if(isset($_REQUEST['reserva'])){
				$m= "UPDATE tbl_recurso SET Ocupado = 0 WHERE idRecurso = $_REQUEST[reserva]";
				mysqli_query($conexion,$m);
			}

			if(mysqli_num_rows($resultados)>0){

				while($reserva = mysqli_fetch_array($resultados)){

					echo "<div class='divcentrar'>";
					echo "<div class='estilo'>";
					echo "<div class='fuenteProducto'>";
					echo "$reserva[nombreRecursos]<br>";
					echo "</div>";
					echo "<div>";
					echo "<img id='imagenProducto' src='$reserva[fotoRecursos]'>";
					echo "<p class='caracteristicasProductoPrincipal'>";
					echo "Tipo: $reserva[tipoRecursos]<br>";
					echo "<button name='reserva' value='$reserva[idRecurso]' type='submit'>Reserva</button>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
					

				}
			}else{
				echo "No hay reservas que mostrar";

			}
			
			if(isset($_REQUEST['reserva'])){
				$l= "SELECT nombreRecursos from tbl_recurso where idRecurso = $_REQUEST[reserva]";
				
				$rvis = mysqli_query($conexion, $l);
				if(mysqli_num_rows($rvis)>0){
					while($reserva = mysqli_fetch_array($rvis)){
						echo "<div class='div2'>";
						echo "<b>Has reservado</b><br>";
						echo"$reserva[nombreRecursos]";
						echo "<div>";
					}
				}
			}

		}	
		

		?>
	</form>
	</html>