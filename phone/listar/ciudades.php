<?php

include_once 'conectar_bd.php';
$ciudad=array();

//$dep=8;
$error=false;

if( isset($_GET['dep']) ) {

	$dep =$_GET['dep'];

	$res= $conex -> query("SELECT * FROM ciudad WHERE departamento_IDDEPARTAMENTO='$dep' ");

	while($row = mysqli_fetch_object($res)){
		$ciudad[]=$row;
	}

	echo json_encode($ciudad);

}
else{
	$error = true;
	$mensaje = "Seleccione un departamento.";
	$res = array('error' => $error, 'mensaje' => $mensaje);
	echo json_encode($res);
}

?>