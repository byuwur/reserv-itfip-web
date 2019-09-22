<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) && isset($_POST['ciudad']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if (!empty($_POST['ciudad'])){
		$ciudad = trim($_POST['ciudad']);
		$ciudad = strip_tags($ciudad);
		$ciudad = htmlspecialchars($ciudad);
	}
	if (empty($ciudad)) {
		$error = true;
		$success = false;
		$mensaje = "Ingrese una ciudad.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
	$query = $conex->query(" UPDATE usuario SET ciudad_IDCIUDAD = '$ciudad' WHERE IDUSUARIOS='$id'; ");
	
	if ($query) {
		$error = false;
		$success = true;
		$mensaje = "Registro actualizado.";
		$res[] = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		echo json_encode($res);
		exit;
	}
	else {
		$error=true;
		$success = false;
	    $mensaje = "Algo salió mal. Intente más tarde.";
	    $res[] = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		echo json_encode($res);
		exit;
	}
}
?>