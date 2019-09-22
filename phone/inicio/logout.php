<?php
	session_start();
	include_once 'conectar_bd.php';

if (isset($_SESSION['user'])!="") {
	unset($_SESSION['user']);
	session_unset();
	session_destroy();
	$sesion=false;
	$mensaje="Sesión cerrada.";
	$res = array('sesion' => $sesion, 'mensaje' => $mensaje);
	$response[]=$res;
	echo json_encode($response);
	exit;
}
else{
	$mensaje="No hay sesión.";
	$res = array('mensaje' => $mensaje);
	$response[]=$res;
	echo json_encode($response);
	exit;
}
?>