<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) && isset($_POST['cancha']) ) {
	if (!empty($_POST['id']) && !empty($_POST['cancha'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);

		$cancha = trim($_POST['cancha']);
		$cancha = strip_tags($cancha);
		$cancha = htmlspecialchars($cancha);
	}

	$query= $conex -> query(" INSERT INTO favorito(usuario_IDUSUARIO,canchas_IDCANCHA) VALUES ('$id' , '$cancha') ");

	if ($query){
		$error=false;
		$mensaje = "Cancha favorita guardada.";
		$res = array('error' => $error, 'mensaje' => $mensaje);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else {
		$error=true;
	    $mensaje = "Algo salió mal. Intente más tarde.";
	    $res = array('error' => $error, 'mensaje' => $mensaje);
	    $response[]=$res;
		echo json_encode($response);
		exit;
	}
}
?>