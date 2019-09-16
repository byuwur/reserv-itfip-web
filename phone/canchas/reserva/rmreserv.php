<?php
include_once 'conectar_bd.php';

if( isset($_POST['idu']) && isset($_POST['idr']) ) {
	if (!empty($_POST['idu']) && !empty($_POST['idr'])){
		$idu = trim($_POST['idu']);
		$idu = strip_tags($idu);
		$idu = htmlspecialchars($idu);

		$idr = trim($_POST['idr']);
		$idr = strip_tags($idr);
		$idr = htmlspecialchars($idr);
	}

	$verifestado = $conex -> query(" SELECT IDRESERVAS FROM reservarcancha WHERE IDRESERVAS = '$idr' AND usuario_IDUSUARIO = '$idu' ");
	$count = mysqli_num_rows($verifestado);
	if ($count == 0){
		$error=true;
		$mensaje = "La reserva no se encuentra o ya ha sido eliminada.";
		$res = array('error' => $error, 'mensaje' => $mensaje);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else{
		$datosreserva = $conex -> query(" SELECT * FROM reservarcancha WHERE IDRESERVAS = '$idr' AND usuario_IDUSUARIO = '$idu' ");
		$resarray = mysqli_fetch_array($datosreserva);
		$idcancha = $resarray['canchas_IDCANCHA'];
		$fecha = $resarray['FECHA'];
		$horainicio = $resarray['HORAINICIO'];
		$valorhora = $resarray['VALORHORA'];

		$queryeliminar = $conex -> query("DELETE FROM reservarcancha WHERE IDRESERVAS = '$idr' AND usuario_IDUSUARIO = '$idu' ");
		$queryinsertar = $conex -> query("INSERT INTO reservascancel (usuario_IDUSUARIO, canchas_IDCANCHA, FECHA, HORAINICIO, VALORHORA) VALUES ('$idu', '$idcancha', '$fecha', '$horainicio', '$valorhora') ");

		if ($queryeliminar && $queryinsertar){	
			$error=false;
			$mensaje = "Reserva cancelada.";
			$res = array('error' => $error, 'mensaje' => $mensaje);
			$response[]=$res;
			echo json_encode($response);
			exit;
		}
		else{
			$error=true;
		    $mensaje = "Algo salió mal. Intente más tarde.";
		    $res = array('error' => $error, 'mensaje' => $mensaje);
		    $response[]=$res;
			echo json_encode($response);
			exit;
		}
	}
}
?>