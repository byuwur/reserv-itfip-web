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

	$res= $conex -> query(" SELECT * FROM favorito WHERE usuario_IDUSUARIO='$id' AND canchas_IDCANCHA='$cancha' ");
	$count = mysqli_num_rows($res);
	if ($count != 0){
		$fav = true;
		$response[] = array('fav' => $fav);
		echo json_encode($response);
		exit;
	} else {
		$fav = false;
		$response[] = array('fav' => $fav);
		echo json_encode($response);
		exit;
	}
}
?>