<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) && isset($_POST['nombre']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if (!empty($_POST['nombre'])){
		$nombre = trim($_POST['nombre']);
		$nombre = strip_tags($nombre);
		$nombre = htmlspecialchars($nombre);
	} 
	if (empty($nombre)) {
		$error = true;
		$success = false;
		$mensaje = "Ingrese su nombre completo.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else if (strlen($nombre) < 2) {
		$error = true;
		$success = false;
		$mensaje = "Al menos dos caracteres en su nombre.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
	$query = $conex->query(" UPDATE usuario SET NOMBREUSUARIO = '$nombre' WHERE IDUSUARIOS='$id'; ");
	
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