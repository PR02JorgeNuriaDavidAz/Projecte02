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
							<?php
								error_reporting(0);
								echo "<form action='principal.php' method='REQUEST' accept-charset='UTF-8'>";
								$conexion=mysqli_connect("localhost","root","","bd_empresa");
								$q="SELECT DISTINCT tipoRecursos FROM tbl_recurso";
								$querymuestra= mysqli_query($conexion, $q);
								echo "<label>Filtro tipo recurso</label><br>";
								echo "<select name='tipoRecursos'><br>";
										echo '<option>Cualquiera</option>';
									while ($row=mysqli_fetch_array($querymuestra)) {
										echo '<option value="'.$row['tipoRecursos'].'">'.$row['tipoRecursos'].'</option>';
									}
								echo "</select><br><br>";

								if ($_REQUEST['tipoRecursos'] == 'Sala') {
									$query="SELECT * FROM `tbl_recurso` WHERE tipoRecursos='Sala'";
								}
								elseif ($_REQUEST['tipoRecursos'] == 'Material') {
									$query="SELECT * FROM `tbl_recurso` WHERE tipoRecursos='Material'";
								}else{
									$query="SELECT * FROM `tbl_recurso`";
								}


								$sql=mysqli_query($conexion, $query);

									while ($row=mysqli_fetch_array($sql)) {
									echo 'Id sala: '.$row['idRecurso'].'<br>';
									echo 'Nombre de recurso: '.utf8_encode($row['nombreRecursos']).'<br>';
									echo 'Tipo de recurso: '.utf8_decode($row['tipoRecursos']).'<br>';
									//SE HACE UN IF PARA CAMBIAR EL 0 (FALSE), POR "NO" Y EL 1 (TRUE), POR "YES", SE MUESTRA LOS REGISTROS QUE SALEN DE LA BD.
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