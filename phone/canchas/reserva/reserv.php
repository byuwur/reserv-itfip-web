<?php
include_once 'conectar_bd.php';

if( isset($_POST['idu']) && isset($_POST['idc']) && isset($_POST['fecha']) && isset($_POST['hora']) ) {
	if (!empty($_POST['idu']) && !empty($_POST['idc']) && !empty($_POST['fecha']) && !empty($_POST['hora']) ){
		$idu = trim($_POST['idu']);
		$idu = strip_tags($idu);
		$idu = htmlspecialchars($idu);

		$idc = trim($_POST['idc']);
		$idc = strip_tags($idc);
		$idc = htmlspecialchars($idc);

		$fecha = trim($_POST['fecha']);
		$fecha = strip_tags($fecha);
		$fecha = htmlspecialchars($fecha);

		$hora = trim($_POST['hora']);
		$hora = strip_tags($hora);
		$hora = htmlspecialchars($hora);
	}
	
	$verifestado = $conex -> query(" SELECT IDRESERVAS FROM reservarcancha WHERE canchas_IDCANCHA = '$idc' AND FECHA = '$fecha' AND HORAINICIO = '$hora' ");
	$count = mysqli_num_rows($verifestado);
	if ($count != 0){
		$error=true;
		$mensaje = "La cancha ya se encuentra reservada.";
		$res = array('error' => $error, 'mensaje' => $mensaje);
		$response[]=$res;
		echo json_encode($response);
		exit;
	} else{

		$day_of_week = date('N', strtotime($fecha));

		if ($day_of_week==1){
			$strdia="lunes";
		} elseif ($day_of_week==2) {
			$strdia="martes";
		} elseif ($day_of_week==3) {
			$strdia="miércoles";
		} elseif ($day_of_week==4) {
			$strdia="jueves";
		} elseif ($day_of_week==5) {
			$strdia="viernes";
		} elseif ($day_of_week==6) {
			$strdia="sábados";
		} elseif ($day_of_week==7) {
			$strdia="domingos";
		}
		
		$diassql= $conex -> query(" SELECT * FROM diasatencion WHERE canchas_IDCANCHA ='$idc' ");
		$diassqlarray = mysqli_fetch_array($diassql);

		if( ($diassqlarray['L']=='Si' && $day_of_week==1) || ($diassqlarray['M']=='Si' && $day_of_week==2) || ($diassqlarray['X']=='Si' && $day_of_week==3) || ($diassqlarray['J']=='Si' && $day_of_week==4) || ($diassqlarray['V']=='Si' && $day_of_week==5) || ($diassqlarray['S']=='Si' && $day_of_week==6) || ($diassqlarray['D']=='Si' && $day_of_week==7) ){

			$sql1=$conex -> query("SELECT TARIFA FROM canchas WHERE IDCANCHAS='$idc' ");
			$sql1array= mysqli_fetch_array($sql1);
			$tarifacancha = $sql1array['TARIFA'];

			$crearreserv= $conex -> query("INSERT INTO reservarcancha (usuario_IDUSUARIO, canchas_IDCANCHA, FECHA, HORAINICIO, VALORHORA, ESTADO) VALUES ('$idu', '$idc', '$fecha', '$hora', '$tarifacancha', 0)");
			if ($crearreserv){
				$error=false;
				$mensaje = "Cancha reservada.";
				$res = array('error' => $error, 'mensaje' => $mensaje);
				$response[]=$res;
				echo json_encode($response);
				exit;
			} else{
				$error=true;
				$mensaje = "La reserva no se encuentra o ya ha sido eliminada.";
				$res = array('error' => $error, 'mensaje' => $mensaje);
				$response[]=$res;
				echo json_encode($response);
				exit;
			}	
		} else {
			$error=true;
			$mensaje = "La cancha no está disponible los ".$strdia;
			$res = array('error' => $error, 'mensaje' => $mensaje);
			$response[]=$res;
			echo json_encode($response);
			exit;
		}
	}
}
?>