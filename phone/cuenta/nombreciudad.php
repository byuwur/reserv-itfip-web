<?php
include_once 'conectar_bd.php';

if( isset($_GET['ciudad']) ) {

	if (!empty($_GET['ciudad'])){
		$ciudad = trim($_GET['ciudad']);
		$ciudad = strip_tags($ciudad);
		$ciudad = htmlspecialchars($ciudad);
	}
	$query= $conex -> query(" SELECT NOMBRECIUDAD FROM ciudad WHERE IDCIUDADES='$ciudad' ");
	
	if ($query) {
		$queryarray = mysqli_fetch_array($query);
		$nombre = $queryarray['NOMBRECIUDAD'];

		$res[] = array('nombre' => $nombre);
		echo json_encode($res);
		exit;
	}
	else {
	    $mensaje = "Algo salió mal. Intente más tarde.";
	    $res[] = array('mensaje' => $mensaje);
		echo json_encode($res);
		exit;
	}
}
?>