<?php 
include("Encabezado.php");
include("conexion.php");
include("Variables.php");
echo "
<style>
img{
	width:100%;
	max-height: 460px;
	margin-top:-20px;
}
p{
	color:#818181;
	padding-left:10px;	
}
</style>
";
date_default_timezone_set('America/Bogota'); 
$FechaHoy=date('Y-m-d');
if ($IdUsuario != ""){
$sql1=$conex->query(" SELECT canchas.IDCANCHAS FROM canchas, usuario WHERE usuario.IDUSUARIOS='$IdUsuario' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') ");
	echo "
	<div class='container-fluid'>
	<div class='row' style='margin-top:20px'>
	";
$countcanchas=mysqli_num_rows($sql1);
if ($countcanchas>=1){

while ($Id_C = mysqli_fetch_assoc($sql1)) {
$Img= "http://reservelapp.com/admin/Imagenes_Canchas/".$Id_C['IDCANCHAS']."/1.jpg";
$sql2=$conex->query(" SELECT canchas.IDCANCHAS, canchas.NOMBRECANCHA, canchas.TARIFA, canchas.BARRIO, canchas.UBICACION, departamento.NOMBREDEPARTAMENTO, ciudad.NOMBRECIUDAD FROM usuario, canchas, departamento, ciudad WHERE canchas.IDCANCHAS='$Id_C[IDCANCHAS]' AND ciudad.IDCIUDADES=canchas.ciudad_IDCIUDAD AND departamento.IDDEPARTAMENTOS=ciudad.departamento_IDDEPARTAMENTO AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') AND (usuario.IDUSUARIOS=canchas.usuario_IDUSUARIO OR usuario.IDUSUARIOS=canchas.socio_IDUSUARIO) AND usuario.IDUSUARIOS='$IdUsuario' ");

	while ($Resultado = mysqli_fetch_assoc($sql2)) {
		echo '<div class="col-xs-12 col-sm-4">
				<div class="card">
					<img class="card-img-top img-responsive" style="min-height:253px; max-height:253px" src="'.$Img.'">
					';
					echo "
					<div class='col-xs-4 col-sm-2' style='float:right; margin:15px;'>
						<a style='color:#ccc; height:35px; width:55px;' class='btn btn-raised' href='ConfCancha.php?UDI=$IdUsuario&IDC=".$Resultado['IDCANCHAS']."'>
			            	<img style='height:25px; width:25px;' src='img/Conf.svg' alt='icon'>  
			          	</a>
					</div>
					";
					echo'
					<h3 style="padding-left:10px;">'.$Resultado['NOMBRECANCHA'].' </h3>
					<h6 style="padding-left:12px;">'.$Resultado['IDCANCHAS'].'</h6>
					<p>COP$ '.$Resultado['TARIFA'].' /hora</p>
					<p>'.$Resultado['NOMBREDEPARTAMENTO'].' / '.$Resultado['NOMBRECIUDAD'].' / '.$Resultado['BARRIO'].' / '.$Resultado['UBICACION'].'</p>
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<a href="Estadisticas.php?IDC='.$Resultado['IDCANCHAS'].'&NombreCancha='.$Resultado['NOMBRECANCHA'].'&UDI='.$IdUsuario.'" class="btn btn-warning btn-raised" style="height:50px">Estadisticas</a>
						</div>
						<div class="col-xs-12 col-sm-6">
							<a class="btn btn-success btn-raised" style="height:50px" href="VerReservas.php?IDC='.$Resultado['IDCANCHAS'].'&FechaHoy='.$FechaHoy.'&UDI='.$IdUsuario.'" >Reservas</a>
						</div>
					</div>
				</div>
			</div>';
	}
}
echo "
	</div>
</div>
	";

} else{
	echo "
  	<script type='text/javascript'>
  		alert('No hay canchas asociadas a su cuenta. Cree una cancha nueva.');
    	document.location = 'CrearCancha.php?IdUsuario=$IdUsuario';
  	</script>
	";
}

include("Footer.php");
}else{
echo "
  <script type='text/javascript'>
    document.location = '../index.php';
  </script>
";
}
?>