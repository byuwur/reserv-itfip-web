<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}

	$res= $conex -> query(" SELECT * FROM reservarcancha WHERE IDRESERVAS ='$id' ");
	$count = mysqli_num_rows($res);
	if ($count != 0){
		$error=false;
		$i=0;
		while($row = mysqli_fetch_object($res)){
			//asignar al arreglo
			$ans[$i]=$row;
			//asignar el ID de la ciudad a una variable para tomar su nombre
			$canchaid=$row -> canchas_IDCANCHA;
				//make a query asking for the name of that ID
				$res2= $conex -> query(" SELECT * FROM canchas WHERE IDCANCHAS='$canchaid' ");
				$res2array = mysqli_fetch_array($res2);
				$res3= $conex -> query(" SELECT * FROM reservarcancha WHERE IDRESERVAS ='$id' ");
				$res3array = mysqli_fetch_array($res3);
				//asignar al arreglo el nombre en un campo equivalente a la posición actual del arreglo
				$nombrecancha = $res2array['NOMBRECANCHA']; $dircancha = $res2array['UBICACION'];
				$tarifacancha = $res3array['VALORHORA']; $telefonocancha = $res2array['TELEFONOCANCHA'];
					//asignar el ID de la ciudad a una variable para tomar su nombre
					$cityid= $res2array['ciudad_IDCIUDAD'];
						//make a query asking for the name of that ID
						$res3= $conex -> query(" SELECT NOMBRECIUDAD FROM ciudad WHERE IDCIUDADES='$cityid' ");
						$res3array = mysqli_fetch_array($res3);
						//asignar al arreglo el nombre en un campo equivalente a la posición actual del arreglo
						$nombreciudad = $res3array['NOMBRECIUDAD'];
				//para dar la hora de término de la reserva
				$horainicio = $row -> HORAINICIO;
				$ihorafin = (int)substr($horainicio, 0, 2) + 1;
				$shorafin = (string)$ihorafin.":00:00";
			//añadir el nombre al arreglo y aumentar
			$ans[$i] -> NOMBRECANCHA = $nombrecancha;
			$ans[$i] -> DIRCANCHA = $dircancha;
			$ans[$i] -> NOMBRECIUDAD= $nombreciudad;
			$ans[$i] -> TARIFA= $tarifacancha;
			$ans[$i] -> TELEFONOCANCHA= $telefonocancha;
			$ans[$i] -> HORAFIN= $shorafin;

			$i=$i+1;
		}
		echo json_encode($ans);
		exit;
	} else {
		$error = true;
		$mensaje = "No hay coincidencias.";
		$response[] = array('error' => $error, 'mensaje' => $mensaje);
		echo json_encode($response);
		exit;
	}
}
?>