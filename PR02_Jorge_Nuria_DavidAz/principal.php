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