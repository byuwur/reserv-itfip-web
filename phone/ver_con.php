<?php
    $s="localhost";
    $u="mateus_root";
    $p="Andres1235$";
    $b="reserv";

	$conex = new mysqli($s, $u, $p, $b) or die('No se pudo conectar a la Base de Datos');
	mysqli_set_charset($conex, "utf8");
	if ($conex->connect_errno) {
		printf("Conncect failed: %s\n", $conex->connect_error);

		$conexion = false;
		$res = array('conexion' => $conexion);
		$response[]=$res;
		echo json_encode($response);
		exit();
	}
	else{
		$conexion = true;
		$res = array('conexion' => $conexion);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
?>