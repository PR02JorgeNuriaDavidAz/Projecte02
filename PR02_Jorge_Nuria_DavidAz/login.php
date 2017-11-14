<?php

	include('conexio.php');
	
	
	//miramos si la conexión se ha realizado correctamente
	//si no es correcta, mostrar error
	if(!$conexion){
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	//si es correcta, seguimos trabajando
	} else {
		$usuario=$_REQUEST['usuario'];
		$password=$_REQUEST['password'];

		$q = "SELECT * FROM tbl_usuario WHERE nombreUsuario='$usuario' AND passwordUsuario='$password'";
		$dadesUsuaris = mysqli_query($conexion, $q);
		echo $q;
		// echo "$q";
		
		if(mysqli_num_rows($dadesUsuaris)>0){
			echo "Bienvenido $usuario";
			header('location: principal.php');			
		}else{
			echo "Usuario o contraseña erroneos";
		}		
	}
	echo "<br><br>";
	echo "<a href='index.html'>LOGIN</a>";

?>