<?php
include_once 'conectar_bd.php';
$dep=array();

$res= $conex->query("SELECT * FROM departamento");

while($row = mysqli_fetch_object($res)){
	$dep[]=$row;
}

echo json_encode($dep);
?>