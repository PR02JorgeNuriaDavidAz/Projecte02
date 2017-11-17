<!DOCTYPE html>
<html>
<head>

	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="js/main.js"></script>
	<meta charset="utf-8">
	<script>
		
		function validar(){
			if(document.addnew.descripcionIncidencia.value==""){
				alert("El campo descripción no puede estar en blanco!");
				return false;

			}
		}
	</script>
</head>
<body>
	<div id="color">

	</div>

	<?php
	session_start();
	
	$conexion=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");	
	if(isset($_SESSION['usuario'])){
		// echo "$_SESSION[usuario]";
		$usuario = $_SESSION['usuario'];
		if(isset($_REQUEST['reserva'])){
			
			$x = "SELECT Ocupado from tbl_recurso where idRecurso = $_REQUEST[reserva]";
			$resultados = mysqli_query($conexion, $x);
			if(mysqli_num_rows($resultados)>0){
				$reserva = mysqli_fetch_array($resultados);
				if($reserva['Ocupado'] == 0){

					$m= "UPDATE tbl_recurso SET Ocupado = 1 WHERE idRecurso = $_REQUEST[reserva]";
					mysqli_query($conexion,$m);
					if (isset($_REQUEST['reserva']) && isset($_SESSION['usuario'])) {
						$s = "INSERT INTO tbl_reserva (`fechaReserva`, `fechaLiberamiento`, `idUsuario`, `idRecurso`) VALUES (CURRENT_TIMESTAMP,null, '$_SESSION[idUsuario]','$_REQUEST[reserva]')";
						mysqli_query($conexion,$s);

					}
				} 

			}	

		}

	} else {
		$usuario = "Invitado";

	}

	if(isset($_REQUEST['devolverProducto'])){
		$m= "UPDATE tbl_recurso SET Ocupado = 0 WHERE idRecurso = $_REQUEST[devolverProducto]";

		mysqli_query($conexion,$m);
		if (isset($_REQUEST['devolverProducto']) && isset($_SESSION['usuario'])) {
			$idreserva = "select idReserva from tbl_reserva where idUsuario = $_SESSION[idUsuario] and idRecurso=$_REQUEST[devolverProducto] and fechaLiberamiento is null";

			$resultados = mysqli_query($conexion,$idreserva);
			$idreservanow = mysqli_fetch_array($resultados);
			// echo $idreservanow['idReserva'];
			$s = "UPDATE tbl_reserva SET fechaLiberamiento = CURRENT_TIMESTAMP WHERE idReserva = $idreservanow[idReserva]";

			mysqli_query($conexion,$s);

		}


	}

	?>




	<div id="cabecera" class="row">
		<div class="col-lg-4" style="text-align: left; color: white; padding-left: 2%;">
			<p><p><a href="principal.php" id="color">INICIO</a></p></p>
		</div>
		<div class="col-lg-4" style="text-align: center; color: white">
			<p class="size">Aulas y materiales</p>
		</div>

		<div class="col-lg-4" style="text-align: right; padding-right: 2%;"><t class="color2">Sesión</t>
			<span style='font-size: 18px; color: white; position: right;' id="login"><a href="index.html"><i id="cerrar_sesion" style="font-size: 15px; color: white" class="glyphicon glyphicon-off"></a></i><?php echo "$usuario"; ?> </span>	


		</div>
			
			<form action="principal.php" method="REQUEST">
			<?php

			if(isset($_REQUEST['cerrarsesion'])){
				
				session_destroy();
				
				header('location: principal.php');
			}
			if (isset($_SESSION['usuario'])) {
				header('principal.php');
				
				echo "<div id='sesion'><a href='principal.php?cerrarsesion' id='sesioncolor'>Cerrar sesión</a></div>";
				

			}
			?>
		</form>


	</div>

	<!--Filtrar!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

	<div id="contenedor_izq">
		<div class="col-lg-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel panel-heading">FILTRAR</div>
					<div class="panel-body">
						<form action='principal.php' method='REQUEST' accept-charset='UTF-8'>

							<?php
							error_reporting(0);
							//Se inserta información referente al nombre
							$conexion=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");
							$q="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
							$querymuestranombre=mysqli_query($conexion,$q);
							mysqli_set_charset($conexion, "utf8");
							echo "Filtro por nombre<br>";
							//Se inserta información referente al tipo de recurso
							?>
							<select name='nombreRecursos' required>

								<?php

								echo "<option>Todos</option>";
								while ($row=mysqli_fetch_array($querymuestranombre)) {
									echo '<option value="'.utf8_encode($row['nombreRecursos']).'">'.utf8_encode($row['nombreRecursos']).'</option>';
								}
								?>
							</select><br><br>


							<?php
							//Se inserta información referente al tipo de recurso
							$conexion1=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");
							$qn="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
							$querymuestratipo=mysqli_query($conexion1,$qn);
							echo "Filtro por tipo<br>";
							?>
							<select name='tipoRecursos' required>

								<?php
								echo "<option>Todos</option>";
								while ($row=mysqli_fetch_array($querymuestratipo)) {
									echo '<option value="'.utf8_encode($row['tipoRecursos']).'">'.utf8_encode($row['tipoRecursos']).'</option>';
								}

								?>
							</select><br><br>
							<?php

							$conexion=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");
							$q="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
							$querymuestranombre=mysqli_query($conexion,$q);
							mysqli_set_charset($conexion, "utf8");
							echo "Filtro por Disponible<br>";
							//Se inserta información referente al tipo de recurso
							?>

							<select name='Ocupado' required>
								<?php

								$conexion=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");
								$q="SELECT DISTINCT Ocupado FROM tbl_recurso";
								$querymuestraestados=mysqli_query($conexion,$q);
								mysqli_set_charset($conexion, "utf8");
								echo "<option>Todos</option>";

								while ($row=mysqli_fetch_array($querymuestraestados)) {
									echo "<tr class='filas'>";
									if($row['Ocupado']==0){
										echo "<option value='$row[Ocupado]'>Disponible</option>";
									}elseif ($row['Ocupado']==1) {
										echo "<option value='$row[Ocupado]'>NoDisponible</option>";
									}
								}

								?>
								
								
							</select><br><br>

							<input type='submit' name='filtro'>
							<input type='submit' name='Reset' value='Resetear'><br><br>

						</form>
					</div>
				</div>
			</div>
			<!-- <button type="button" id="titulo_btn" class="btn btn-primary btn-block">Historial</button> -->
		</div>
	</div>
	<div id="contenedor_derch">

		<div class="col-lg-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel panel-heading">INCIDENCIA</div>
					<div class="panel-body">
						<form  action='principal.php' method='REQUEST' onsubmit="return validar();" accept-charset='UTF-8' name="addnew">
							<?php
							error_reporting(0);
							session_start();
							$conexion=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");
							$usuario=$_SESSION['usuario'];
							$qn="SELECT DISTINCT tbl_recurso.idRecurso ,nombreRecursos 
							FROM tbl_recurso 
							INNER JOIN tbl_reserva ON tbl_recurso.idRecurso=tbl_reserva.idRecurso
							INNER JOIN tbl_usuario ON tbl_reserva.idUsuario=tbl_usuario.idUsuario
							WHERE tbl_recurso.Ocupado='1' AND tbl_usuario.nombreUsuario='$usuario'";
							$querymuestran=mysqli_query($conexion,$qn);
							echo "<label>Nombre del recurso</label>";
							echo "<select name='nombreRecursos'>";
							while ($row=mysqli_fetch_array($querymuestran)) {
								echo '<option value="'.utf8_encode($row['nombreRecursos']).'">'.utf8_encode($row['nombreRecursos']).'</option>';
							}
							echo "</select><br><br>";
							echo "<label>Descripción incidencia</label>";
							echo "<textarea type='text' name='descripcionIncidencia' style='height:120px;width:200px;'></textarea><br><br>";
							echo "<input type='submit' name='Enviar' value='Confirmar'>";
							?>
						</form>
						<form action="principal.php" method="POST">
						</div>


					</div>


				</div>
				<button type='submit' name='devolver' id='titulo_btn' class='btn btn-primary btn-block'>Devolver</button>

			</form>
		</div>

	</div>
	<?php

	$conexion=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");
	if(!$conexion){
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	} else {

		mysqli_query($conexion, "SET NAMES 'utf8'");	

			////////// DEVOLUCIÓN ///////////////////////////////

		if((isset($_REQUEST['devolver']))){
			?>
			<div id="contenedor_central">
				<table class="table">
					<thead>
						<tr>
							<th class="centro">Nombre de recurso</th>
							<th class="centro">Tipo de recurso</th>
							<th class="centro">Devolver</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$k= "SELECT tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos,tbl_recurso.idRecurso from tbl_reserva inner join tbl_recurso where tbl_reserva.idRecurso = tbl_recurso.idRecurso and idUsuario = $_SESSION[idUsuario] and tbl_reserva.fechaLiberamiento is null";
						$rvis = mysqli_query($conexion, $k);
						if(mysqli_num_rows($rvis)>0){
							while($reserva = mysqli_fetch_array($rvis)){

								echo "<form action='principal.php' method='POST'>";
								echo "<tr class='filas'>";
								echo "<td>$reserva[nombreRecursos]</td>";
								echo "<td>$reserva[tipoRecursos]</td>";

								echo "<td>";

								echo "<button type='submit'name='devolverProducto' value='$reserva[idRecurso]' id='boton_devolver' class='btn btn-primary btn-block'>Devolver</button>";
								echo"</td>";

							}
							echo "<input type='hidden' name='devolver'>";

							echo "</form>";
						}else{
							echo "<td>No tiene reservas</td>";
						}

								///////////////////////FILTRO//////////////////////////////////

					}elseif((isset($_REQUEST['filtro']))){


						?>

						<div id="contenedor_central">
							<table class="table">
								<thead>
									<tr>
										<th class="centro">Nombre de recurso</th>
										<th class="centro">Tipo de recurso</th>
										<th class="centro">Reservado</th>
										<th class="centro">Veces usado</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$query="SELECT * FROM `tbl_recurso`";



									$sql=mysqli_query($conexion, $query);
									while ($row=mysqli_fetch_array($sql)) {


										$conexion=mysqli_connect("sql206.mipropia.com", "mipc_21057600", "casamia1234", "mipc_21057600_bd_empresa");
										$value=utf8_decode($_REQUEST['nombreRecursos']);
										$value1=utf8_decode($_REQUEST['tipoRecursos']);
										$value2=$_REQUEST['Ocupado'];


										if($value2=="Todos"){
											if($value=="Todos" and $value1!= "Todos"){
													// $query="SELECT * FROM `tbl_recurso` WHERE tipoRecursos='$value1'";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso where tipoRecursos = '$value1' group by tbl_recurso.idRecurso";
											}elseif($value1== "Todos" and $value != "Todos"){
													// $query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos='$value'";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso where nombreRecursos = '$value' group by tbl_recurso.idRecurso";
											}elseif($value=="Todos" && $value1=="Todos"){
													// $query="SELECT * FROM `tbl_recurso`";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso group by tbl_recurso.idRecurso";
											}elseif($value!="Todos" && $value1!="Todos"){
													//$query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos = '$value' and tipoRecursos='$value1'";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso where tipoRecursos = '$value1' and nombreRecursos = '$value' group by tbl_recurso.idRecurso";

											}

										}else {
											if($value=="Todos" and $value1!= "Todos"){
													// $query="SELECT * FROM `tbl_recurso` WHERE tipoRecursos='$value1' and Ocupado='$value2'";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso WHERE tipoRecursos='$value1' and Ocupado='$value2' group by tbl_recurso.idRecurso";
											}elseif($value1== "Todos" and $value != "Todos"){
													// $query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos='$value' and Ocupado='$value2'";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso WHERE nombreRecursos='$value' and Ocupado='$value2' group by tbl_recurso.idRecurso";

											}elseif($value=="Todos" && $value1=="Todos"){
													// $query="SELECT * FROM `tbl_recurso` where Ocupado=$value2";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso WHERE Ocupado='$value2' group by tbl_recurso.idRecurso";

											}elseif($value!="Todos" && $value1!="Todos"){
													// $query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos = '$value' and tipoRecursos='$value1' and Ocupado='$value2'";
												$query = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso WHERE nombreRecursos = '$value' and tipoRecursos='$value1' and Ocupado='$value2' group by tbl_recurso.idRecurso";

											}
										}

												// $q = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso group by tbl_recurso.idRecurso";
										?>

										<?php
										$sql=mysqli_query($conexion, $query);

										

										$numrows=mysqli_num_rows($sql).'<br><br>';
										echo"<tbody>";
										if ($numrows>0) {
											while ($row=mysqli_fetch_array($sql)) {
												echo "<form action='principal.php' method='REQUEST'>";
												echo "<tr class='filas'>";
												// echo "El ID del recurso es: ".$row['idRecurso'].'<br>';
												echo "<td> ".utf8_encode($row['nombreRecursos']).'<br></td>';
												echo "<td>".$row['tipoRecursos'].'<br></td>';
												echo "<td>";

												echo "<div class='onoffswitch'>";
												if ($row['Ocupado']==0) {
													echo "<input type='hidden' name='reserva' value='$reserva[idRecurso]'>";
													echo "<input type='checkbox' onChange='this.form.submit()' name='reserva' value='$reserva[idRecurso]' class='onoffswitch-checkbox' id='myonoffswitch$cont' checked> ";
													echo "<label class='onoffswitch-label' for='myonoffswitch$cont'>";
													echo "<span class='onoffswitch-inner'></span>";
													echo "<span class='onoffswitch-switch'></span>";
													echo "</label>";			
												} elseif ($row['Ocupado']==1){
													echo "<input type='checkbox' onChange='this.form.submit()' name='reserva' value='$reserva[idRecurso]' class='onoffswitch-checkbox' id='myonoffswitch$cont'>";
													echo "<label class='onoffswitch-label' >";
													echo "<span class='onoffswitch-inner'></span>";
													echo "<span class='onoffswitch-switch'></span>";
													echo "</label>";

												}
												echo "</div>";
												echo "<td>$row[veces_usado]</td>";
												echo "</tr>";
												echo "</form>";
												$cont++;

											}
										}else {
											echo "<td>Su busqueda no ha generado registros</td>";
										}
									}




								}elseif((isset($_REQUEST['Enviar']))){

									session_start();



									$k= "SELECT tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos,tbl_recurso.idRecurso from tbl_reserva inner join tbl_recurso where tbl_reserva.idRecurso = tbl_recurso.idRecurso and idUsuario = $_SESSION[idUsuario] and tbl_reserva.fechaLiberamiento is null";

									$rvis = mysqli_query($conexion, $k);
									if(mysqli_num_rows($rvis)>0){
										while($reserva = mysqli_fetch_array($rvis)){
											$variable =$reserva['idRecurso'];
											
										}
									}



									$usuario=$_SESSION['usuario'];
									$idUsuario=$_SESSION['idUsuario'];
									$idRecurso=$variable;
									$nombreRecursos=$_REQUEST['nombreRecursos'];
									$descripcionIncidencia=utf8_encode($_REQUEST['descripcionIncidencia']);
									$sql=mysqli_query($conexion, "SELECT NOW()");
									$fechaIncidencia =mysqli_fetch_row($sql);

									$queryinsercionincidencias="INSERT INTO tbl_incidencia(descripcionIncidencia, fechaIncidencia, idRecurso) VALUES ('$descripcionIncidencia','$fechaIncidencia[0]','$idRecurso')";

									$queryaccionincidencias=mysqli_query($conexion, $queryinsercionincidencias);



									echo "<div id='contenedor_central'>";
									echo "<table class='table'>";
									echo "<thead>";
									echo "<tr>";
									echo "<th class='centro'>Nombre de usuario</th>";
									echo "<th class='centro'>Nombre del recurso</th>";
									echo "<th class='centro'>Descripcion incidencia</th>";
									echo "<th class='centro'>Fecha Incidencia</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									$sql="SELECT DISTINCT tbl_recurso.idrecurso, tbl_usuario.nombreUsuario, tbl_recurso.nombreRecursos, tbl_incidencia.descripcionIncidencia, tbl_incidencia.fechaIncidencia FROM tbl_usuario INNER JOIN tbl_reserva ON tbl_usuario.idUsuario=tbl_reserva.idUsuario INNER JOIN tbl_recurso ON tbl_reserva.idRecurso=tbl_recurso.idRecurso INNER JOIN tbl_incidencia ON tbl_recurso.idRecurso=tbl_incidencia.idRecurso WHERE tbl_usuario.idUsuario='$idUsuario' ORDER BY tbl_incidencia.fechaIncidencia DESC";
									$ejecutar=mysqli_query($conexion,$sql);
									if (mysqli_num_rows($ejecutar)>0) {

										while ($numincidencias=mysqli_fetch_array($ejecutar)) {
											echo "<tr class='filas'>";
											echo '<td>'.$numincidencias[nombreUsuario].'</td>';
											echo '<td>'.$numincidencias[nombreRecursos].'</td>';
											echo '<td>'.utf8_decode($numincidencias[descripcionIncidencia]).'</td>';
											echo '<td>'.$numincidencias[fechaIncidencia].'</td>';
											echo "</tr>";
										}
										echo "</tbody>";
										echo "</table>";
									}


									echo "</div>";
								}else{


									?>
									<div id="contenedor_central">
										<table class="table">
											<thead>
												<tr>
													<th class="centro">Nombre de recurso</th>
													<th class="centro">Tipo de recurso</th>
													<th class="centro">Disponible</th>
													<th class="centro">Veces usado</th>
												</tr>
											</thead>
											<tbody>
												<?php

													//$q = "SELECT nombreRecursos,tipoRecursos,Ocupado FROM tbl_recurso ";
												$q = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_reserva.idReserva) as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso group by tbl_recurso.idRecurso";


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
																//1 quiere decir que esta ocupado
																//0 quiere decir que esta libre
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
														
														echo "</div>";

														echo "<td>$reserva[veces_usado]</td>";
														
														echo "</tr>";
														echo "</form>";
														$cont++;

													}
												}
												if(isset($_REQUEST['reserva'])){
													$l= "SELECT nombreRecursos from tbl_recurso where idRecurso = $_REQUEST[reserva]";

													$rvis = mysqli_query($conexion, $l);
													if(mysqli_num_rows($rvis)>0){
														while($reserva = mysqli_fetch_array($rvis)){
															echo "<div>";
															
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