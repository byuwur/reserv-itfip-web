<?php 

$Id = $_GET['UDI'];
	include("Encabezado.php");
	include("conexion.php");
	
	$datosuser = $conex->query(" SELECT * FROM usuario WHERE IDUSUARIOS='$Id' ") ;
	$datosuserarray = mysqli_fetch_assoc($datosuser);

	$res2= $conex -> query(" SELECT * FROM ciudad WHERE IDCIUDADES='$datosuserarray[ciudad_IDCIUDAD]' ");
	$res2array = mysqli_fetch_assoc($res2);

	echo '
	<div class="container">
		<h1 style="text-align:center;">EDITAR PERFIL</h1>
		<hr style="color:#818181; background:#818181; width:20%;">
		<form action="UpdateFoto_Perfil.php" method="POST">
			<div class="row">
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Nombre">Nombre de la cancha</label>
					<input type="text" maxlength="125" class="form-control" id="Nombre_Txt" name="Nombre_Txt" value="'.$datosuserarray['NOMBREUSUARIO'].'" required>
				</div>
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Barrio">Correo electrónico</label>
					<input type="text" maxlength="150" class="form-control" id="Correo_Txt" name="Correo_Txt" value="'.$datosuserarray['CORREOUSUARIO'].'" required>
				</div>
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Direccion">Teléfono de la cancha</label>
					<input type="tel" maxlength="10" class="form-control" id="Tel_Txt" name="Tel_Txt" value="'.$datosuserarray['CELULARUSUARIO'].'" required>
				</div>
			</div>
			';
			echo'
			<div class="row">
				<div class="col-xs-12 col-sm-3 " style="float:left;">
					<a style="height: 50px;" href="Update_Contra.php?Usuario='.$Id.'" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-raised" >CAMBIAR CONTRASEÑA</a>
				</div>
				<div class="col-xs-12 col-sm-3 " style="float:right;">
					<input data-toggle="modal" data-target="#processing-otros" type="submit" style="height: 50px;" name="Guardar" class="btn btn-info btn-raised" value="Siguiente">
				</div>
			</div>';echo"
			<input type='hidden' name='Id_Admin' value='$Id'>
			";
		echo "
		</form>
	</div>
	";
include("Footer.php");
?>