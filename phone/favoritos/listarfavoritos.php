<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	$res= $conex -> query(" SELECT * FROM favorito WHERE usuario_IDUSUARIO='$id' ");
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
				//asignar al arreglo el nombre en un campo equivalente a la posición actual del arreglo
				$nombrecancha = $res2array['NOMBRECANCHA'];
				$horaabrir = $res2array['HORAABRIR'];
				$horacerrar = $res2array['HORACERRAR'];
				$tarifa = $res2array['TARIFA'];
				$dircancha = $res2array['UBICACION'];
					//asignar el ID de la ciudad a una variable para tomar su nombre
					$cityid= $res2array['ciudad_IDCIUDAD'];
						//make a query asking for the name of that ID
						$res3= $conex -> query(" SELECT NOMBRECIUDAD FROM ciudad WHERE IDCIUDADES='$cityid' ");
						$res3array = mysqli_fetch_array($res3);
						//asignar al arreglo el nombre en un campo equivalente a la posición actual del arreglo
						$nombreciudad = $res3array['NOMBRECIUDAD'];

				//listar los días disponibles
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

				$ans[$i] -> DIASDISPONIBLE = "Ninguno";
				
			//añadir el nombre al arreglo y aumentar
			$ans[$i] -> NOMBRECANCHA = $nombrecancha;
			$ans[$i] -> HORAABRIR = $horaabrir;
			$ans[$i] -> HORACERRAR = $horacerrar;
			$ans[$i] -> TARIFA = $tarifa;
			$ans[$i] -> UBICACION = $dircancha;
			$ans[$i] -> NOMBRECIUDAD= $nombreciudad;
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