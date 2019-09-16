<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) ) {

	if (!empty($_POST['id'])){
			$id = trim($_POST['id']);
			$id = strip_tags($id);
			$id = htmlspecialchars($id);
	}
	else{
		$error = true;
		$mensaje = "Considere ingresar un ID.";
		$response[] = array('error' => $error, 'mensaje' => $mensaje);
		echo json_encode($response);
		exit;
	}
	$res= $conex -> query(" SELECT * FROM canchas WHERE IDCANCHAS='$id' ");
	$count = mysqli_num_rows($res);
	if ($count != 0){
		$error=false;
		$i=0;
		while($row = mysqli_fetch_object($res)){
			//asignar al arreglo
			$ans[$i]=$row;
			//asignar el ID de la ciudad a una variable para tomar su nombre
			$cityid=$row -> ciudad_IDCIUDAD;
				//make a query asking for the name of that ID
				$res2= $conex -> query(" SELECT NOMBRECIUDAD FROM ciudad WHERE IDCIUDADES='$cityid' ");
				$res2array = mysqli_fetch_array($res2);
				//asignar al arreglo el nombre en un campo equivalente a la posición actual del arreglo
				$nombre = $res2array['NOMBRECIUDAD'];

				//listar los días disponibles
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

				$ans[$i] -> DIASDISPONIBLE = "Ninguno";
				
			//añadir el nombre al arreglo y aumentar
			$ans[$i] -> NOMBRECIUDAD= $nombre;
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