<?php

include_once 'conectar_bd.php';
$response=array();

if( isset($_GET['id']) ) {
	$id =$_GET['id'];
	$res= $conex -> query("SELECT NOMBRECIUDAD FROM ciudad WHERE IDCIUDADES='$id' ");
	while($row = mysqli_fetch_object($res)){
		$response[]=$row;
	}
	echo json_encode($response);
	exit;
}
?>