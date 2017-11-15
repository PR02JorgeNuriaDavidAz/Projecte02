<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$conexion=mysqli_connect("localhost","root","","bd_empresa");
		$sql=mysqli_query($conexion, "SELECT NOW()");
		$row =mysqli_fetch_row($sql);
		echo $row[0];
	?>
</body>
</html>