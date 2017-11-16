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
	<div id="color">

	</div>

	<?php
	session_start();
	
	$conexion=mysqli_connect("localhost", "root", "", "bd_empresa");
	
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
			<div class="color">

			</div>
		</div>

	</div>

	<!--        Filtrar!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
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
							$conexion=mysqli_connect("localhost","root","","bd_empresa");
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
							$conexion1=mysqli_connect("localhost","root","","bd_empresa");
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

							$conexion=mysqli_connect("localhost","root","","bd_empresa");
							$q="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
							$querymuestranombre=mysqli_query($conexion,$q);
							mysqli_set_charset($conexion, "utf8");
							echo "Filtro por Disponible<br>";
							//Se inserta información referente al tipo de recurso
							?>

							<select name='Ocupado' required>
								<?php

								$conexion=mysqli_connect("localhost","root","","bd_empresa");
								$q="SELECT DISTINCT Ocupado FROM tbl_recurso";
								$querymuestraestados=mysqli_query($conexion,$q);
								mysqli_set_charset($conexion, "utf8");
								echo "<option>Todos</option>";

								while ($row=mysqli_fetch_array($querymuestraestados)) {
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
							<form  action='principal.php' method='REQUEST' accept-charset='UTF-8'>
								<?php
//ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
									error_reporting(0);
									$conexion=mysqli_connect("localhost","root","","bd_empresa");
									$qn="SELECT idRecurso, nombreRecursos, tipoRecursos, Ocupado FROM tbl_recurso WHERE 'tbl_recurso.Ocupado'='1'";
										$querymuestran=mysqli_query($conexion,$qn);
										echo "<label>Nombre del recurso</label>";
										echo "<select name='nombreRecurso'>";
											while ($row=mysqli_fetch_array($querymuestran)) {
												echo '<option value="'.utf8_encode($row['nombreRecurso']).'">'.utf8_encode($row['nombreRecursos']).'</option>';
											}
										echo "</select><br><br>";
									echo "<label>Descripción incidencia</label>";
									echo "<textarea type='text' name='descripcionIncidencia' style='height:120px;width:230px;'></textarea><br><br>";
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
		$conexion=mysqli_connect("localhost", "root", "", "bd_empresa");
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
										</tr>
									</thead>
									<tbody>
										<?php

										$query="SELECT * FROM `tbl_recurso`";
								// 	$sql=mysqli_query($conexion, $query);
								// 	while ($row=mysqli_fetch_array($sql)) {
								// 		echo "<tr class='filas'>";
								// // echo "<td> ".$row['idRecurso'].'<br><td>';
								// 		echo "<td>  ".utf8_encode($row['nombreRecursos']).'<br></td>';
								// 		echo "<td> ".$row['tipoRecursos'].'<br></td>';
								// 		if ($row['Ocupado']==1) {
								// 			echo '<td>Disponible: No <br><td>';				
								// 		} elseif ($row['Ocupado']==0){
								// 			echo '<td>Disponible: Sí <br><td>';
								// 		}
								// // echo 'Veces reservado: '.$row[''].'<br>';
								// // echo 'Hora de la reserva: '.$row[''].'<br><br><br>';
								// 	}


										
										$sql=mysqli_query($conexion, $query);
										while ($row=mysqli_fetch_array($sql)) {


											$conexion=mysqli_connect("localhost","root","","bd_empresa");
											$value=utf8_decode($_REQUEST['nombreRecursos']);
											$value1=utf8_decode($_REQUEST['tipoRecursos']);
											$value2=$_REQUEST['Ocupado'];


											if($value2=="Todos"){
												if($value=="Todos" and $value1!= "Todos"){
													$query="SELECT * FROM `tbl_recurso` WHERE tipoRecursos='$value1'";

												}elseif($value1== "Todos" and $value != "Todos"){
													$query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos='$value'";

												}elseif($value=="Todos" && $value1=="Todos"){
													$query="SELECT * FROM `tbl_recurso`";

												}elseif($value!="Todos" && $value1!="Todos"){
													$query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos = '$value' and'tipoRecursos='$value1'";

												}
											}else {
												if($value=="Todos" and $value1!= "Todos"){
													$query="SELECT * FROM `tbl_recurso` WHERE tipoRecursos='$value1' and Ocupado='$value2'";

												}elseif($value1== "Todos" and $value != "Todos"){
													$query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos='$value' and Ocupado='$value2'";

												}elseif($value=="Todos" && $value1=="Todos"){
													$query="SELECT * FROM `tbl_recurso` where Ocupado=$value2";

												}elseif($value!="Todos" && $value1!="Todos"){
													$query="SELECT * FROM `tbl_recurso` WHERE nombreRecursos = '$value' and tipoRecursos='$value1' and Ocupado='$value2'";

												}
											}


											$sql=mysqli_query($conexion, $query);

											$numrows=mysqli_num_rows($sql).'<br><br>';

											if ($numrows>0) {
												while ($row=mysqli_fetch_array($sql)) {
													echo "<tr class='filas'>";
												// echo "El ID del recurso es: ".$row['idRecurso'].'<br>';
													echo "<td> ".utf8_encode($row['nombreRecursos']).'<br></td>';
													echo "<td>".$row['tipoRecursos'].'<br></td>';
													if ($row['Ocupado']==1) {
														echo '<td>Disponible: No <br></td>';				
													} elseif ($row['Ocupado']==0){
														echo '<td>Disponible: Sí <br></td>';
													}
										// 		// echo 'Veces reservado: '.$row[''].'<br>';
										// 		// echo 'Hora de la reserva: '.$row[''].'<br><br><br>';

												}
											}else {
												echo "Su busqueda no ha generado registros.";
											}
										}

//dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd

									}elseif((isset($_REQUEST['Enviar']))){
										$q="SELECT idUsuario,nombreUsuario FROM tbl_usuario WHERE nombreUsuario='$usuario'";
										$dadesUsuaris = mysqli_query($conexion, $q);
										while($myquery=mysqli_fetch_array($dadesUsuaris)){		
											$idUsuario=$myquery[idUsuario];
									}


										$idRecurso=$_REQUEST['idRecurso'];
										$descripcionIncidencia=utf8_decode($_REQUEST['descripcionIncidencia']);
										$sql=mysqli_query($conexion, "SELECT NOW()");
										$fechaIncidencia =mysqli_fetch_row($sql);
	
										


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
													echo "<tr class='filas'>";
													echo '<td>'.$usuario.'</td>';
													echo '<td>'.$idRecurso.'</td>';
													echo '<td>'.utf8_encode($descripcionIncidencia).'</td>';
													echo '<td>'.$fechaIncidencia[0].'</td>';
												echo "</tbody>";
											echo "</table>";
										echo "</div>";

								
										$queryinsercionincidencias="INSERT INTO tbl_incidencia(descripcionIncidencia, fechaIncidencia, idRecurso) VALUES ('$descripcionIncidencia','$fechaIncidencia[0]', '$idRecurso')";
										$queryaccionincidencias=mysqli_query($conexion, $queryinsercionincidencias);



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
													// $q = "SELECT tbl_recurso.idRecurso ,tbl_recurso.nombreRecursos,tbl_recurso.tipoRecursos, tbl_recurso.Ocupado, count(tbl_recurso.idRecurso), as veces_usado from tbl_recurso LEFT JOIN tbl_reserva on tbl_recurso.idRecurso = tbl_reserva.idRecurso group by tbl_recurso.idRecurso";
													$resultados = mysqli_query($conexion, $q);

													if(mysqli_num_rows($resultados)>0){
														$cont=0;

														while($reserva = mysqli_fetch_array($resultados)){

															echo "<form action='principal.php' method='REQUEST'>";
															echo "<tr class='filas'>";
															//echo "<td>$reserva[nombreRecursos]</td>";
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
															// echo "<label class='onoffswitch-label' for='myonoffswitch$cont'>";
															// echo "<span class='onoffswitch-inner'></span>";
															// echo "<span class='onoffswitch-switch'></span>";
															// echo "</label>";
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