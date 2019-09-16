<?php
include_once 'conectar_bd.php';

if( isset($_POST['id']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}

	$res= $conex -> query(" SELECT * FROM canchas WHERE IDCANCHAS ='$id' ");
	$count = mysqli_num_rows($res);
	if ($count != 0){
		$error=false;
		$i=0;
		while($row = mysqli_fetch_object($res)){
			//asignar al arreglo
			$ans[$i]=$row;
				//asignar el ID de la ciudad a una variable para tomar su id
				$cityid=$row -> ciudad_IDCIUDAD;
				$idcancha=$row -> IDCANCHAS;
				//make a query asking for the name of that ID
				$res2= $conex -> query(" SELECT NOMBRECIUDAD FROM ciudad WHERE IDCIUDADES='$cityid' ");
				$res2array = mysqli_fetch_array($res2);
				//asignar al arreglo el id en un campo equivalente a la posición actual del arreglo
				$nomciu = $res2array['NOMBRECIUDAD'];
				//añadir el id al arreglo y aumentar
				$ans[$i] -> NOMBRECIUDAD= $nomciu;

				//listar los días disponibles
				$diassql= $conex -> query(" SELECT * FROM diasatencion WHERE canchas_IDCANCHA ='$idcancha' ");
				$diassqlarray = mysqli_fetch_array($diassql);

				$ans[$i] -> DIASDISPONIBLE = "";
				$primero=true;
				if ($diassqlarray['L']=="Si"){
					if ($primero){
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Lunes";
						$primero=false;	
					} else {
						$ans[$i] -> DIASDISPONIBLE = "";
					}
				}
				if ($diassqlarray['M']=="Si"){
					if ($primero){
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Martes";	
						$primero=false;
					} else {
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE.", ";	
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Martes";	
					}
				}
				if ($diassqlarray['X']=="Si"){
					if ($primero){
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Miércoles";	
						$primero=false;
					} else {
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE.", ";	
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Miércoles";	
					}
				}
				if ($diassqlarray['J']=="Si"){
					if ($primero){
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Jueves";	
						$primero=false;
					} else {
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE.", ";	
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Jueves";	
					}
				}
				if ($diassqlarray['V']=="Si"){
					if ($primero){
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Viernes";	
						$primero=false;
					} else {
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE.", ";	
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Viernes";	
					}
				}
				if ($diassqlarray['S']=="Si"){
					if ($primero){
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Sábado";	
						$primero=false;
					} else {
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE.", ";	
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Sábado";	
					}
				}
				if ($diassqlarray['D']=="Si"){
					if ($primero){
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Domingo";	
						$primero=false;
					} else {
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE.", ";	
						$ans[$i] -> DIASDISPONIBLE = $ans[$i] -> DIASDISPONIBLE."Domingo";	
					}
				}

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