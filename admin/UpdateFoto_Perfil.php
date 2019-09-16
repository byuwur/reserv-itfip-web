<?php
	include("Encabezado.php");
	include("conexion.php");
	$Id_Admin = $_POST['Id_Admin'];
	$Nombre = $_POST['Nombre_Txt'];
	//$Departamento = $_POST['Departamento_Txt'];
	//$Ciudad  = $_POST['Ciudad_Txt'];
	$Correo  = $_POST['Correo_Txt'];
	$Telefono = $_POST['Tel_Txt'];

	echo "
	<script type='text/javascript'>
	jQuery(document).ready(function($){
		Dropzone.options.myDrop1={
			maxFileSize:3,
			acceptedFiles: 'image/*',

			init: function init(){
				this.on('error', function(){
					alert('Error al cargar el arhivo');
				});
			}
		}
	});
</script>
	";
	echo '
		<script src="js/dropzone.js"></script>
		<link rel="stylesheet" type="text/css" href="css/dropzone.css">
		<div class="container">
			<h1 style="text-align:center">ACTUALIZAR FOTO DE PERFIL</h1>
			<hr style="color:#818181; background:#818181; width:20%;">
			<p style="color:#f44336">*Las imágenes deben pesar menos de 5 megabytes.</p>
			<h3 style="color:#000">Si no desea cambiar la foto, puede pulsar "Finalizar" y actualizar los registros.</h3>
			<br>
			<div class="row">
				<div class="col-sm-4">';echo "
					<form action='UploadFotoUsuario.php' class='dropzone animar4' id='myDrop1'>
						<h2 style='text-align:center; color:#ff5722;'>Imagen 1</h2>
						<div class='form-group label-floating'>
							<input type='file' name='file' required>
						</div>
						<input type='hidden' name='IDI' value='$Id_Admin' required>
					</form>"; echo'
				</div>
			
				<div class="animar4 col-xs-12 col-sm-3 col-sm-offset-6">
					<a href="ConfPerfil.php?UDI='.$Id_Admin.'" style="margin-top: 35px; height: 50px;" class="btn btn-danger btn-raised">CANCELAR</a>
				</div>
				<div class="animar4 col-xs-12 col-sm-3">
					<a data-toggle="modal" data-target="#processing-otros" value="Crear" style="margin-top: 35px; height: 50px;" class="btn btn-info btn-raised">Finalizar</a>
				</div>
			
			</div>	
		</div>	
			<div class="modal modal-static fade" id="processing-otros" role="dialog" aria-hidden="false">
					<div class="modal-dialog">
						<div style="height:auto;" class="modal-content">
							<div class="modal-body">
								<div class="">
									<div class="row">
										<div style="text-align:center; height:40px;">
											<h4>¿Estás seguro que deseas guardar esta información?</h4>
										</div>
										<div class="col-xs-12 col-sm-6">
											<a style="height: 50px;" href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-raised" >Cancelar</a>
										</div>
										<div class="col-xs-12 col-sm-6">
										<form action="#" method="POST">';
											echo "
											<input type='hidden' name='Nombre_Txt' value='$Nombre'>
											<input type='hidden' name='Correo_Txt' value='$Correo'>
											<input type='hidden' name='Tel_Txt' value='$Telefono'>
											<input type='hidden' name='Id_Admin' value='$Id_Admin'>
											";
											echo '
											<input data-toggle="modal" data-target="#Mensaje" type="submit" style="height: 50px;" name="Crear" class="btn btn-info btn-raised" value="Aceptar">
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	';
	if (isset($_POST['Crear'])) {
		
		$Id_Admin = $_POST['Id_Admin'];
		$Nombre = $_POST['Nombre_Txt'];
		//$Departamento = $_POST['Departamento_Txt'];
		//$Ciudad  = $_POST['Ciudad_Txt'];
		$Correo  = $_POST['Correo_Txt'];
		$Tel = $_POST['Tel_Txt'];

		$sql = $conex->query(" UPDATE usuario SET NOMBREUSUARIO='$Nombre', CORREOUSUARIO='$Correo', CELULARUSUARIO='$Tel' WHERE IDUSUARIOS='$Id_Admin' ");

		if ($sql){
			echo "
		      <div style='display:block;left:0px;' class='Area_Oscura2'>
		        <div class='container'>
		          <div class='row'>
		            <div class='col-sm-4 col-sm-offset-4'>
		              <div class='well' style='margin-top:55%;'>
		                <h4 align='center'>El perfil ha sido modificado.</h4>
		                <div class='row'>
		                  <div class='col-sm-8 col-sm-offset-2'>
		                    <form action='' method='GET'>
		                    	<script>alert('Perfil modificado.');parent.window.location.reload(true);</script>
		                    </form>
		                  </div>
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		      ";
		} else {
			echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>Algo salió mal. Intente más tarde.</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                    <form action='' method='GET'>
	                    	";
	                    	echo '
	                    	<div class="col-xs-12 col-sm-6">
								<a style="height: 50px;" href="ConfPerfil.php?UDI='.$Id.'" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-raised" >Aceptar</a>
							</div>
	                    	';
	                    	echo"
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
		}
	}
	include("Footer.php");
?>