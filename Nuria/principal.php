<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="js/main.js"></script>
	<meta charset="utf-8">
</head>
<body>

	<?php
	session_start();
	
	$conexion=mysqli_connect("localhost", "root", "", "bd_empresa");
	
	if(isset($_SESSION['usuario'])){
		echo "$_SESSION[usuario]";
		$usuario = $_SESSION['usuario'];
		if(isset($_REQUEST['reserva'])){
			
			$x = "select Ocupado from tbl_recurso where idRecurso = $_REQUEST[reserva]";
			$resultados = mysqli_query($conexion, $x);
			if(mysqli_num_rows($resultados)>0){
				$reserva = mysqli_fetch_array($resultados);
				if($reserva['Ocupado'] == 0){

					$m= "UPDATE tbl_recurso SET Ocupado = 1 WHERE idRecurso = $_REQUEST[reserva]";
					mysqli_query($conexion,$m);
					if (isset($_REQUEST['reserva']) && isset($_SESSION['usuario'])) {
						$s = "INSERT INTO tbl_reserva (`fechaReserva`, `fechaLiberamiento`, `idUsuario`, `idRecurso`) VALUES (CURDATE(),null, '$_SESSION[idUsuario]','$_REQUEST[reserva]')";
						mysqli_query($conexion,$s);

					}
				} 
				// else{
				// 	$m= "UPDATE tbl_recurso SET Ocupado = 0 WHERE idRecurso = $_REQUEST[reserva]";

				// 	mysqli_query($conexion,$m);
				// 	if (isset($_REQUEST['reserva']) && isset($_SESSION['usuario'])) {
				// 		$idreserva = "select idReserva from tbl_reserva where idUsuario = $_SESSION[idUsuario] and idRecurso=$_REQUEST[reserva] and fechaLiberamiento is null";

				// 		$resultados = mysqli_query($conexion,$idreserva);
				// 		$idreservanow = mysqli_fetch_array($resultados);
				// 		echo $idreservanow['idReserva'];
				// 		$s = "UPDATE tbl_reserva SET fechaLiberamiento = CURDATE() WHERE idReserva = $idreservanow[idReserva]";


				// 		echo $s;
				// 		mysqli_query($conexion,$s);
				
				// 	}

				// }
			}	

		}

	} else {
		$usuario = "Invitado";

	}


	?>

	<div id="cabecera" class="row">
		<div class="col-lg-4" style="text-align: left; color: white; padding-left: 2%;">
			<p>LOGO</p>
		</div>
		<div class="col-lg-4" style="text-align: center; color: white">
			<p>TITULO</p>
		</div>
		<div class="col-lg-4" style="text-align: right; padding-right: 2%;">
			<span style='font-size: 15px; color: white; position: right;' id="login"><a href="index.html"><i id="cerrar_sesion" style="font-size: 15px; color: white" class="glyphicon glyphicon-off"></a></i><?php echo "$usuario"; ?></span>			
		</div>


	</div>
	<div id="contenedor_izq">
		<div class="col-lg-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel panel-heading">FILTRAR</div>
					<div class="panel-body">
						<form>
							<label>Nom Article</label>
							<input type="text" name="nom">

							<label>Tipus article</label>
							<input type="text" name="tipus">
						</form>
					</div>
				</div>
			</div>
			<button type="button" id="titulo_btn" class="btn btn-primary btn-block">Historial</button>
		</div>
	</div>
	<div id="contenedor_derch">

		<div class="col-lg-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel panel-heading">INCIDENCIA</div>
					<div class="panel-body">
						<form>
							<label>Nom Article</label>
							<input type="text" name="nom">

							<label>Tipus articcle</label>
							<input type="text" name="tipus">

						</form>
					</div>

				</div>

			</div>



	
		<!-- 	// $conexion=mysqli_connect("localhost", "root", "", "bd_empresa");
				// mysqli_query($conexion, "SET NAMES 'utf8'");	

				// 	$q = "SELECT * FROM tbl_recurso ";
				// 	$resultados = mysqli_query($conexion, $q);


				// 	if(mysqli_num_rows($resultados)>0){
				// 		while($reserva = mysqli_fetch_array($resultados)){

						
				// 		}
				// 	}
					
				// if(($_REQUEST['devolver'])){

				// 			echo "<form action='principal.php' method='REQUEST'>";
				// 			echo "<tr class='filas'>";
				// 			echo "<td>$reserva[nombreRecursos]</td>";
				// 			echo "<td>$reserva[tipoRecursos]</td>";
				// 			echo "<td>";


				// }			 -->
				

		</div>

	</div>
	
	<div id="contenedor_central">
		<table class="table">
			<thead>
				<tr>
					<th class="centro">Nombre de recurso</th>
					<th class="centro">Tipo de recurso</th>
					<th class="centro">Reservado</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$conexion=mysqli_connect("localhost", "root", "", "bd_empresa");
				if(!$conexion){
					echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
					echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
					echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
					exit;
				} else {
					mysqli_query($conexion, "SET NAMES 'utf8'");	

					$q = "SELECT * FROM tbl_recurso ";
					$resultados = mysqli_query($conexion, $q);


					if(mysqli_num_rows($resultados)>0){
						$cont=0;

						while($reserva = mysqli_fetch_array($resultados)){

							echo "<form action='principal.php' method='REQUEST'>";
							echo "<tr class='filas'>";
							echo "<td>$reserva[nombreRecursos]</td>";
							echo "<td>$reserva[tipoRecursos]</td>";
							echo "<td>";
							echo "<div class='onoffswitch'>";
							if($reserva['Ocupado']==0){
								//1 quiere decir que esta libre
								//0 quiere decir que esta ocupado
								echo "<input type='hidden' name='reserva' value='$reserva[idRecurso]'>";
								echo "<input type='checkbox' onChange='this.form.submit()' name='reserva' value='$reserva[idRecurso]' class='onoffswitch-checkbox' id='myonoffswitch$cont' checked> ";
								echo "<label class='onoffswitch-label' for='myonoffswitch$cont'>";
								echo "<span class='onoffswitch-inner'></span>";
								echo "<span class='onoffswitch-switch'></span>";
								echo "</label>";
							}else{
								echo "<input type='checkbox' onChange='this.form.submit()' name='reserva' value='$reserva[idRecurso]' class='onoffswitch-checkbox' id='myonoffswitch$cont'>";
								echo "<label class='onoffswitch-label' >";
								echo "<span class='onoffswitch-inner'></span>";
								echo "<span class='onoffswitch-switch'></span>";
								echo "</label>";
							}
							// echo "<label class='onoffswitch-label' for='myonoffswitch$cont'>";
							// echo "<span class='onoffswitch-inner'></span>";
							// echo "<span class='onoffswitch-switch'></span>";
							// echo "</label>";
							echo "</div>";
							echo "<td>";
							//"<td><button name='reserva' value='$reserva[idRecurso]' type='submit'>Reserva</button>";
							echo "</tr>";
							echo "</form>";
							$cont++;

						}

						if(isset($_REQUEST['reserva'])){
							$l= "SELECT nombreRecursos from tbl_recurso where idRecurso = $_REQUEST[reserva]";

							$rvis = mysqli_query($conexion, $l);
							if(mysqli_num_rows($rvis)>0){
								while($reserva = mysqli_fetch_array($rvis)){
									echo "<div>";
									echo "<b>Has reservado</b><br>";
									echo"$reserva[nombreRecursos]";
									echo "<div>";
								}
							}
						}	
					}	
				}

				?>

			</tbody>
		</table>
	</div>



</body>
</html>