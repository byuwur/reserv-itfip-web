<?php
include_once 'conectar_bd.php';

if( isset($_POST['correo']) && isset($_POST['feed']) ) {

	if (!empty($_POST['correo'])){
		$correo = trim($_POST['correo']);
		$correo = strip_tags($correo);
		$correo = htmlspecialchars($correo);
	}
	if (!empty($_POST['feed'])){
		$feed = trim($_POST['feed']);
		$feed = strip_tags($feed);
		$feed = htmlspecialchars($feed);
	} 
	if (empty($feed)) {
		$error = true;
		$success = false;
		$mensaje = "Por favor, escriba su mensaje.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}

	$query = $conex->query(" INSERT INTO feedback (CORREOFEED, MENSAJEFEED) VALUES ('$correo', '$feed') ");
	
	if ($query) {
		$error = false;
		$success = true;
		$mensaje = "Gracias por su apoyo. Su mensaje se ha subido.";
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