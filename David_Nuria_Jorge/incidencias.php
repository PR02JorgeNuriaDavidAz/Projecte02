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
		if(isset($_REQUEST['usuario'])){
			$usuario = $_REQUEST['usuario'];
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
			<span style='font-size: 15px; color: white; position: right;' id="login"><a href="index.html"><i id="cerrar_sesion" style="font-size: 15px; color: white" class="glyphicon glyphicon-off"></a></i><?php echo " $usuario"; ?></span>			
		</div>
		
	<!-- 	<span id="titulo">RESERVA DE MATERIAL</span> -->
	</div>
	<div id="contenedor_izq">
		<div class="col-lg-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel panel-heading">FILTRAR</div>
						<div class="panel-body">
							<form action='FiltroBusqueda.php' method='REQUEST' accept-charset='UTF-8'>
								<?php
								include('conexio.php');
								include('FiltroInicial.php');

								echo "Nombre recurso<br>";
								//Se inserta información referente al tipo de recurso
								?>
								<select class='form-control' name='nombreRecursos'>
									<option></option>
									<?php
										while ($row=mysqli_fetch_array($querymuestranombre)) {
											echo '<option value="'.($row['nombreRecursos']).'">'.($row['nombreRecursos']).'</option>';
										}
									?>
								</select><br><br>
								<?php
								//Se inserta información referente al tipo de recurso
								include('conexio.php');
								include('FiltroInicial.php');

								echo "Tipo de recurso<br>";
								?>
								<select class='form-control' name='tipoRecursos'>
									<option></option>
									<?php
										include('conexio.php');
										include('FiltroInicial.php');
										
										while ($row=mysqli_fetch_array($querymuestratipo)) {
											echo '<option value="'.($row['tipoRecursos']).'">'.($row['tipoRecursos']).'</option>';
										}
									?>
								</select><br><br>
								<input type='submit' name='Enviar'>
								<!-- <input type='submit' name='Reset' value='Resetear'><br><br> -->

								
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div id="contenedor_derch">
		<div class="col-lg-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel panel-heading">INCIDENCIA</div>
						<div class="panel-body">
							<?php
								include('incidencias.proc.php');
								echo "<form name='formulario' method='POST' action='incidencias.proc.php' accept-charset='UTF-8'>";

								//DATALIST NOMBRE RECURSO
								echo "Nombre recurso<br>";
								echo "<select class='form-control' id='nombreRecursos' name='nombreRecursos'>";
										echo "<option></option>";
										while ($row=mysqli_fetch_array($querymuestran)) {
											echo '<option value="'.($row['nombreRecursos']).'">'.($row['nombreRecursos']).'</option>';
										}
								echo "</select><br>";

								//SELECT TIPO RECURSO
								echo "Tipo recurso:<br>";
									echo "<select name='tipoRecursos' class='form-control' id='textbox' required />";
									// echo "<select name='tipoRecursos' required id='textbox'><br>";
										while ($row=mysqli_fetch_array($qrecu)) {
											echo '<option value="'.$row['tipoRecursos'].'">'.$row['tipoRecursos'].'</option>';
										}
									echo "</select><br>";

								//INPUT DESCRIPCIÓN
								echo "Descripcion:<br>";
								echo "<textarea name='descripcionIncidencia' class='form-control' rows='5' id='comment' required /></textarea>";

								//INPUT INCIDENCIA
								echo "Fecha incidencia:<br>";
								echo "<input class='form-control' type='datetime-local' name='fechaIncidencia' size='20' id='textbox' required /><br>";

								//SUBMIT
								echo "<input type='submit' value='Submit' id='btnsubmit' onclick='submitForm();'><br>";
								
							?>	
						</div>
				</div>
			</div>
		</div>
	</div>
	<div id="contenedor_central">
		<table class="table">
		    <thead>
		      <tr>
		        <th class="centro">Descripción incidencia</th>
		        <th class="centro">Nombre recurso</th>
		        <th class="centro">Nombre usuario</th>
		        <th class="centro">Fecha incidencia</th>
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
					$q="SELECT 'tbl_Usuario.nombreUsuario', 'tbl_recurso.nombreRecursos', 'tbl_incidencia.descripcionIncidencia', 'tbl_incidencia.fechaIncidencia' FROM tbl_usuario INNER JOIN tbl_reserva ON 'tbl_usuario.idUsuario'='tbl_reserva.idUsuario' INNER JOIN tbl_recurso ON 'tbl_reserva.idRecurso'='tbl_recurso.idRecurso' INNER JOIN tbl_incidencia ON 'tbl_recurso.idRecurso'='tbl_incidencia.idRecurso'";
					$resultados = mysqli_query($conexion, $q);

					// if(isset($_REQUEST['reserva'])){
					// 	$m= "UPDATE tbl_recurso SET Ocupado = 0 WHERE idRecurso = $_REQUEST[reserva]";
					// 	mysqli_query($conexion,$m);
					// }

					if(mysqli_num_rows($resultados)>0){

						while($reserva = mysqli_fetch_array($resultados)){

							echo "<tr class='filas'>";
							echo "<td>$reserva[descripcionIncidencia]</td>";
							// echo "<td>$reserva[nombreRecursos]</td>";
							// echo "<td>$reserva[idRecurso]</td>";
							echo "<td>$reserva[fechaIncidencia]</td>";

							// echo "<div class='onoffswitch'>";
							    // echo "<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='myonoffswitch'>";
							    // echo "<label class='onoffswitch-label' for='myonoffswitch'>";
							    //     echo "<span class='onoffswitch-inner'></span>";
							    //     echo "<span class='onoffswitch-switch'></span>";
							    // echo "</label>";
							// echo "</div>";
							echo "<td><button name='reserva' value='$reserva[idRecurso]' type='submit'>Reserva</button>";
							echo "</tr>";

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

<!-- <script type="text/javascript">
	
	$qn="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
	$querymuestran=mysqli_query($conexion,$qn);
	$sql1="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
	$qrecu= mysqli_query($conexion, $sql1);

	if(isset($_POST['nombreRecursos'])) {
		$descripcionIncidencia=mysqli_real_escape_string($conexion, utf8_decode($_POST['descripcionIncidencia']));
		$fechaIncidencia=mysqli_real_escape_string($conexion, $_POST['fechaIncidencia']);

		$queryanunci="INSERT INTO tbl_incidencia(descripcionIncidencia, fechaIncidencia) VALUES ('$descripcionIncidencia', '$fechaIncidencia')";

		$resul1=mysqli_query($conexion, $queryanunci);
		$resul2=mysqli_query($conexion, $query);
	}


</script> -->