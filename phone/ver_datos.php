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

	$queryverifpass = $conex->query(" SELECT * FROM usuario WHERE IDUSUARIOS = '$id' AND PASSWORDUSUARIO = '$pass' ");
	$count = mysqli_num_rows($queryverifpass);
	if($count!=1){
		$error = true;
		$success = false;
		$mensaje = "Parece que algo salió mal. Intente más tarde";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
	else {
		$row = mysqli_fetch_array($queryverifpass);
		$usrname=$row['NOMBREUSUARIO'];
      	$usremail=$row['CORREOUSUARIO'];
       	$usrcel=$row['CELULARUSUARIO'];
       	$usrciudad=$row['ciudad_IDCIUDAD'];

		$error = false;
		$success = true;
		
		$mensaje = "Continuar.";
		$res[] = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success, 'usrname'=>$usrname,'usremail'=>$usremail,'usrciudad'=>$usrciudad,'usrcel'=>$usrcel);
		echo json_encode($res);
		exit;
	}
}
?>