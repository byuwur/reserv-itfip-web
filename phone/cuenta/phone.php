<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) && isset($_POST['phone']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if (!empty($_POST['phone'])){
		$phone = trim($_POST['phone']);
		$phone = strip_tags($phone);
		$phone = htmlspecialchars($phone);
	}
	if (empty($phone)){
		$error = true;
		$success = false;
		$mensaje = "Ingrese un número.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else if (strlen($phone) < 10) {
		$error = true;
    	$success = false;
		$mensaje = "El número telefónico tiene 10 caracteres.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else if (strlen($phone) > 10) {
		$error = true;
    	$success = false;
		$mensaje = "El número telefónico tiene 10 caracteres.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else if (preg_match("/^[a-zA-Z ]+$/",$phone)) {
    	$error = true;
    	$success = false;
		$mensaje = "El número telefónico tiene únicamente números.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
 	}

	$query = $conex->query(" UPDATE usuario SET CELULARUSUARIO = '$phone' WHERE IDUSUARIOS='$id'; ");
	
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