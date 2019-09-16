<?php 
include("conexion.php");

$Id = $_POST['Id'];

$ConsultaG = $conex->query("SELECT * from ciudad WHERE departamento_IDDEPARTAMENTO='$Id'");	
$con=1;
$Ciudad = array();
while($Ciu=mysqli_fetch_array($ConsultaG)){
    $Ciudad[$con] = array('Id_Ciudad' => $Ciu['IDCIUDADES'], 'Ciudad' => $Ciu['NOMBRECIUDAD']);
	$con=$con+1;
}
  echo json_encode($Ciudad);
?>