<?php
include_once 'conectar_bd.php';

if( isset($_POST['nombre']) || isset($_POST['ciudad']) || isset($_POST['barrio']) ) {

	if (!empty($_POST['nombre'])){
		$nombre = trim($_POST['nombre']);
		$nombre = strip_tags($nombre);
		$nombre = htmlspecialchars($nombre);
	}
	if (!empty($_POST['barrio'])){
		$barrio = trim($_POST['barrio']);
		$barrio = strip_tags($barrio);
		$barrio = htmlspecialchars($barrio);
	}
	if (!empty($_POST['ciudad'])){
		$ciudad = trim($_POST['ciudad']);
		$ciudad = strip_tags($ciudad);
		$ciudad = htmlspecialchars($ciudad);
	}
	else if ( empty($_POST['ciudad']) && ( empty($_POST['nombre']) && empty($_POST['barrio']) ) ) {
		$error = true;
		$mensaje = "Considere ingresar un filtro para buscar.";
		$response[] = array('error' => $error, 'mensaje' => $mensaje);
		echo json_encode($response);
		exit;
	}
	if ( (!empty($_POST['nombre']) || !empty($_POST['barrio']) ) && !empty($_POST['ciudad']) ){
		if (empty($_POST['nombre'])){
			$nombre = "";
		}
		if (empty($_POST['barrio'])){
			$barrio = "";
		}
		$res= $conex -> query(" SELECT * FROM canchas WHERE NOMBRECANCHA LIKE '%$nombre%' AND BARRIO LIKE '%$barrio%' AND ciudad_IDCIUDAD='$ciudad' ");
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
	else if ( (!empty($_POST['nombre']) || !empty($_POST['barrio']) ) && empty($_POST['ciudad']) ){
		if (empty($_POST['nombre'])){
			$nombre = "";
		}
		if (empty($_POST['barrio'])){
			$barrio = "";
		}
		$res= $conex -> query(" SELECT * FROM canchas WHERE NOMBRECANCHA LIKE '%$nombre%' AND BARRIO LIKE '%$barrio%' ");
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
	else if ( (empty($_POST['nombre']) && empty($_POST['barrio']) ) && !empty($_POST['ciudad'])){
		$res= $conex -> query(" SELECT * FROM canchas WHERE ciudad_IDCIUDAD='$ciudad' ");
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
}
?>