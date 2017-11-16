<?php

	$conexion = mysqli_connect("localhost", "root", "", "bd_empresa");
	$accentos = mysqli_query($conexion, "SET NAMES 'utf8'");

	