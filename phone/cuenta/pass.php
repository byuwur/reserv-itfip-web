<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) && isset($_POST['passactual']) && isset($_POST['passnueva']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if (!empty($_POST['passactual'])){
		$passactual = trim($_POST['passactual']);
		$passactual = strip_tags($passactual);
		$passactual = htmlspecialchars($passactual);
	}
	if (!empty($_POST['passnueva'])){
		$passnueva = trim($_POST['passnueva']);
		$passnueva = strip_tags($passnueva);
		$passnueva = htmlspecialchars($passnueva);
	} 
	if (empty($passactual)) {
		$error = true;
		$success = false;
		$mensaje = "Ingrese su contraseña.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else if (strlen($passactual) < 8) {
		$error = true;
		$success = false;
		$mensaje = "La contraseña tiene al menos 8 caracteres.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
	if (empty($passnueva)) {
		$error = true;
		$success = false;
		$mensaje = "Ingrese su nueva contraseña.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else if (strlen($passnueva) < 8) {
		$error = true;
		$success = false;
		$mensaje = "La nueva contraseña tiene al menos 8 caracteres.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}

	$passwordactual = hash('sha256', $passactual);
	$passwordnueva = hash('sha256', $passnueva);

	$queryverifpass = $conex->query(" SELECT NOMBREUSUARIO FROM usuario WHERE IDUSUARIOS = '$id' AND PASSWORDUSUARIO = '$passwordactual' ");
	$count = mysqli_num_rows($queryverifpass);
	if($count!=1){
		$error = true;
		$success = false;
		$mensaje = "Contraseña incorrecta. Intente de nuevo.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
	else {
		$query = $conex->query(" UPDATE usuario SET PASSWORDUSUARIO = '$passwordnueva' WHERE IDUSUARIOS='$id'; ");
	
		if ($query) {
			$error = false;
			$success = true;
			$mensaje = "Registro actualizado. Vuelva a iniciar sesión.";
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
}
?>