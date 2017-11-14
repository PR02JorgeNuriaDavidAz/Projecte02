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
							<form>
								<label>Nom Article</label>
								<input type="text" name="nom">

								<label>Tipus articcle</label>
								<input type="text" name="tipus">
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
								// $qn="SELECT DISTINCT nombreRecursos FROM tbl_recurso";
								// $querymuestran=mysqli_query($conexion,$qn);
								echo "Nombre recurso<br>";
								echo "<select class='form-control' id='nombreRecursos' name='nombreRecursos'>";
								// echo "<select id='nombreRecursos' name='nombreRecursos'>";
										echo "<option></option>";
										while ($row=mysqli_fetch_array($querymuestran)) {
											echo '<option value="'.utf8_encode($row['nombreRecursos']).'">'.utf8_encode($row['nombreRecursos']).'</option>';
										}
								echo "</select><br>";

								//SELECT TIPO RECURSO
								echo "Tipo recurso:<br>";
									// $sql1="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
									// $qrecu= mysqli_query($conexion, $sql1);
									echo "<select name='tipoRecursos' class='form-control' id='textbox' required />";
									// echo "<select name='tipoRecursos' required id='textbox'><br>";
										while ($row=mysqli_fetch_array($qrecu)) {
											echo '<option value="'.$row['tipoRecursos'].'">'.$row['tipoRecursos'].'</option>';
										}
									echo "</select><br>";

								//INPUT DESCRIPCIÓN
								echo "Descripcion:<br>";
								echo "<textarea name='desc' class='form-control' rows='5' id='comment' required /></textarea>";

								//INPUT INCIDENCIA
								echo "Fecha incidencia:<br>";
								echo "<input class='form-control' type='datetime-local' name='fechaIncidencia' size='20' id='textbox' required /><br>";

								//SUBMIT
								echo "<input type='submit' value='Submit' id='btnsubmit' onclick='submitForm();'><br>";
								
								// if(isset($_POST['nombreRecursos'])) {
								// 	$descripcionIncidencia=mysqli_real_escape_string($conexion, utf8_decode($_POST['descripcionIncidencia']));
								// 	$fechaIncidencia=mysqli_real_escape_string($conexion, $_POST['fechaIncidencia']);

								// 	$queryanunci="INSERT INTO tbl_incidencia(descripcionIncidencia, fechaIncidencia) VALUES ('$descripcionIncidencia', '$fechaIncidencia')";

								// 	$resul1=mysqli_query($conexion, $queryanunci);
								// 	$resul2=mysqli_query($conexion, $query);
								// }
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
		        <th class="centro">Firstname</th>
		        <th class="centro">Lastname</th>
		        <th class="centro">Email</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr class="filas">
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		      </tr>
		      <tr class="filas">
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		      </tr>
		      <tr class="filas">
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		      </tr>
		      <tr class="filas">
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		      </tr>
		      <tr class="filas">
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		      </tr>
		      <tr class="filas">
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		      </tr>
		      <tr class="filas">
		        <td>Mary</td>
		        <td>Moe</td>
		        <td>mary@example.com</td>
		      </tr>
		      <tr class="filas">
		        <td>July</td>
		        <td>Dooley</td>
		        <td>july@example.com</td>
		      </tr>
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