<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) && isset($_POST['correo']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if (!empty($_POST['correo'])){
		$correo = trim($_POST['correo']);
		$correo = strip_tags($correo);
		$correo = htmlspecialchars($correo);
	} 
	if (empty($correo)){
		$error = true;
		$success = false;
		$mensaje = "Ingrese un correo.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else if ( !filter_var($correo,FILTER_VALIDATE_EMAIL) ) {
		$error = true;
		$success = false;
		$mensaje = "Ingrese una dirección de correo electrónico válida.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else {
		// check email exist or not
		$query = $conex->query("SELECT CORREOUSUARIO FROM usuario WHERE CORREOUSUARIO='$correo'");
		$count = mysqli_num_rows($query);
		if($count!=0){
			$error = true;
			$success = false;
			$mensaje = "Este correo electrónico ya existe.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		}
	}
	
	$query = $conex->query(" UPDATE usuario SET CORREOUSUARIO = '$correo' WHERE IDUSUARIOS='$id'; ");
	
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