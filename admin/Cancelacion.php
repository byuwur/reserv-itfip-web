<?php 
include("Encabezado.php");
include("conexion.php");
include("Variables.php");
$NombreCancha=$_GET['NombreCancha'];
$IdCancha=$_GET['IDC'];
$IdUsuario=$_GET['UDI'];
echo '
<div class="container" style="margin-top:20px;">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3>Usuarios que han cancelado las reservas de la cancha: '.$NombreCancha.'</h3>
		</div>
		<br>
		<br>
		<br>';
	$sql1=$conex->query("SELECT DISTINCT usuario_IDUSUARIO FROM reservascancel WHERE canchas_IDCANCHA='$IdCancha'");

	while ($Resultado=mysqli_fetch_assoc($sql1)) {

		$sql = $conex->query("SELECT count(*) as cant FROM reservascancel WHERE usuario_IDUSUARIO='$Resultado[usuario_IDUSUARIO]'");
		$Res = mysqli_fetch_array($sql);

		$sql2=$conex->query("SELECT NOMBREUSUARIO, CELULARUSUARIO, CORREOUSUARIO FROM usuario WHERE IDUSUARIOS='$Resultado[usuario_IDUSUARIO]'");
		while ($Resultado2=mysqli_fetch_assoc($sql2)) {
		echo '
		<div class="col-xs-12 col-sm-12" style=" border-bottom:1px solid #ccc">
			<div class="row">
				<div class="col-sm-3"><p style="color:#818181; font-size:18px;">
					<h3 style="font-size:18px;">Usuario</h3>'
					.$Resultado2['NOMBREUSUARIO'].
				'</p></div>
				<div class="col-sm-3"><p style="color:#818181; font-size:18px;">
				<h3 style="font-size:18px;">Celular</h3>'
					.$Resultado2['CELULARUSUARIO'].
				'</p></div>
				<div class="col-sm-3"><p style="color:#818181; font-size:18px;">
				<h3 style="font-size:18px;">Email</h3>'
					.$Resultado2['CORREOUSUARIO'].
				'</p></div>
				<div class="col-sm-3"><p style="color:#818181; font-size:18px;">
				<h3 style="font-size:18px;">Cantidad cancelaciones</h3>
				<p>'.$Res['cant'].'
				</p></div>
			</div>
		</div>
		';}
	}
		echo'
	</div>
</div>';

include("Footer.php");
?>