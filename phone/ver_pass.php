<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) && isset($_POST['pass']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if (!empty($_POST['pass'])){
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
	}

	$queryverifpass = $conex->query(" SELECT NOMBREUSUARIO FROM usuario WHERE IDUSUARIOS = '$id' AND PASSWORDUSUARIO = '$pass' ");
	$count = mysqli_num_rows($queryverifpass);
	if($count!=1){
		$error = true;
		$success = false;
		$mensaje = "Parece que su contraseña fue actualizada recientemente. Por favor, inicie sesión nuevamente.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
	else {
		$error = false;
		$success = true;
		$mensaje = "Continuar.";
		$res[] = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		echo json_encode($res);
		exit;
	}
}
?>