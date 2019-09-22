<?php
	include("Encabezado.php");
	include("conexion.php");
	$NombreCancha = $_POST['Nombre_Cancha_Txt'];
	$Departamento = $_POST['Departamento_Txt'];
	$Ciudad  = $_POST['Ciudad_Txt'];
	$Barrio  = $_POST['Barrio_Txt'];
	$Direccion = $_POST['Dir_Txt'];
	$HoraA = $_POST['Apertura_Txt'];
	$HoraC = $_POST['Cierre_Txt'];
	$Info = $_POST['Info_Txt'];
	$CodigoAsociado = $_POST['Cod_Aso_Txt'];
	$Telefono = $_POST['Tel_Txt'];
	$Lunes = $_POST['Lunes'];
	$Martes = $_POST['Martes'];
	$Miercoles = $_POST['Miercoles'];
	$Jueves = $_POST['Jueves'];
	$Viernes = $_POST['Viernes'];
	$Sabado = $_POST['Sabado'];
	$Domingo = $_POST['Domingo'];
	$Tarifa = $_POST['Valor_Txt'];
	$Id_Admin = $_POST['Id_Admin'];
	$randomString = $_POST['Id_Img'];

$Consulta=$conex->query("SELECT canchas_IDCANCHA FROM imagen_cancha WHERE canchas_IDCANCHA='$randomString'");
if (mysqli_num_rows($Consulta)==0){
	$Registro_Img = "INSERT INTO imagen_cancha VALUES('$randomString','Img1','Img2','Img3')";
	$conex->query($Registro_Img);
}
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
			<h1 style="text-align:center">ACTUALIZAR FOTOS</h1>
			<hr style="color:#818181; background:#818181; width:20%;">
			<p style="color:#f44336">*Las imágenes deben pesar menos de 5 megabytes y se mostrarán en el orden que aquí se presentan.</p>
			<h3 style="color:#000">Si no desea cambiar ninguna foto, puede pulsar "Finalizar" y actualizar los registros.</h3>
			<br>
			<div class="row">
				<div class="col-sm-4">';echo "
					<form action='Upload.php' class='dropzone animar4' id='myDrop1'>
						<h2 style='text-align:center; color:#ff5722;'>Imagen 1</h2>
						<div class='form-group label-floating'>
							<input type='file' name='file' required>
						</div>
						<input type='hidden' name='IDI' value='$randomString' required>
					</form>"; echo'
				</div>
				<div class="col-sm-4">';echo "
					<form action='Upload2.php' class='dropzone animar4' id='myDrop1'>
						<h2 style='text-align:center; color:#ff5722;'>Imagen 2</h2>
						<div class='form-group label-floating'>
							<input type='file' name='file' required>
						</div>
						<input type='hidden' name='IDI' value='$randomString' required>
					</form>"; echo'
				</div>
				<div class="col-sm-4">';echo "
					<form action='Upload3.php' class='dropzone animar4' id='myDrop1'>
						<h2 style='text-align:center; color:#ff5722;'>Imagen 3</h2>
						<div class='form-group label-floating'>
							<input type='file' name='file' required>
						</div>
						<input type='hidden' name='IDI' value='$randomString' required>
					</form>"; echo'
				</div>
			</div>	
			<div class="row">
				<div class="animar4 col-xs-12 col-sm-3 col-sm-offset-6">
					<a href="ConfCancha.php?UDI='.$Id_Admin.'&IDC='.$randomString.'" style="margin-top: 35px; height: 50px;" class="btn btn-danger btn-raised">CANCELAR</a>
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
											<input type='hidden' name='Nombre_Cancha_Txt' value='$NombreCancha'>
											<input type='hidden' name='Id_Cancha_Txt' value='$randomString'>
											<input type='hidden' name='Departamento_Txt' value='$Departamento'>
											<input type='hidden' name='Ciudad_Txt' value='$Ciudad'>
											<input type='hidden' name='Barrio_Txt' value='$Barrio'>
											<input type='hidden' name='Dir_Txt' value='$Direccion'>
											<input type='hidden' name='Apertura_Txt' value='$HoraA'>
											<input type='hidden' name='Cierre_Txt' value='$HoraC'>
											<input type='hidden' name='Info_Txt' value='$Info'>
											<input type='hidden' name='Cod_Aso_Txt' value='$CodigoAsociado'>
											<input type='hidden' name='Tel_Txt' value='$Telefono'>
											<input type='hidden' name='Lunes' value='$Lunes'>
											<input type='hidden' name='Martes' value='$Martes'>
											<input type='hidden' name='Miercoles' value='$Miercoles'>
											<input type='hidden' name='Jueves' value='$Jueves'>
											<input type='hidden' name='Viernes' value='$Viernes'>
											<input type='hidden' name='Sabado' value='$Sabado'>
											<input type='hidden' name='Domingo' value='$Domingo'>
											<input type='hidden' name='Valor_Txt' value='$Tarifa'>
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
		
		$Id_Cancha=$_POST['Id_Cancha_Txt'];
		$NombreCancha = $_POST['Nombre_Cancha_Txt'];
		$Departamento = $_POST['Departamento_Txt'];
		$Ciudad  = $_POST['Ciudad_Txt'];
		$Barrio  = $_POST['Barrio_Txt'];
		$Direccion = $_POST['Dir_Txt'];
		$HoraA = $_POST['Apertura_Txt'];
		$HoraC = $_POST['Cierre_Txt'];
		$Info = $_POST['Info_Txt'];
		$CodigoAsociado = $_POST['Cod_Aso_Txt'];
		$Telefono = $_POST['Tel_Txt'];
		$Lunes = $_POST['Lunes'];
		$Martes = $_POST['Martes'];
		$Miercoles = $_POST['Miercoles'];
		$Jueves = $_POST['Jueves'];
		$Viernes = $_POST['Viernes'];
		$Sabado = $_POST['Sabado'];
		$Domingo = $_POST['Domingo'];
		$Tarifa = $_POST['Valor_Txt'];
		$Id_Admin = $_POST['Id_Admin'];
		$sql = $conex->query(" UPDATE canchas SET NOMBRECANCHA='$NombreCancha', TELEFONOCANCHA='$Telefono', HORAABRIR='$HoraA', HORACERRAR='$HoraC', UBICACION='$Direccion', BARRIO='$Barrio', TARIFA='$Tarifa', CARACTERISTICAS='$Info', ciudad_IDCIUDAD='$Ciudad', socio_IDUSUARIO='$CodigoAsociado' WHERE IDCANCHAS='$Id_Cancha' AND usuario_IDUSUARIO='$Id_Admin' ");
		if ($sql){
			$s1= $conex->query( "SELECT * FROM diasatencion WHERE canchas_IDCANCHA='$Id_Cancha'" );
			$s1count = mysqli_num_rows($s1);
			if ($s1count==0){
				$sql2= $conex->query( "INSERT INTO diasatencion VALUES('$Id_Cancha','$Lunes','$Martes','$Miercoles','$Jueves','$Viernes','$Sabado','$Domingo')" );
			} else{
				$sql2= $conex->query( "UPDATE diasatencion SET L='$Lunes', M='$Martes', X='$Miercoles', J='$Jueves', V='$Viernes', S='$Sabado', D='$Domingo' WHERE canchas_IDCANCHA='$Id_Cancha'" );
			}
			echo "
		      <div style='display:block;left:0px;' class='Area_Oscura2'>
		        <div class='container'>
		          <div class='row'>
		            <div class='col-sm-4 col-sm-offset-4'>
		              <div class='well' style='margin-top:55%;'>
		                <h4 align='center'>El registro de la cancha se ha realizado correctamente.</h4>
		                <div class='row'>
		                  <div class='col-sm-8 col-sm-offset-2'>
		                    <form action='' method='GET'>
		                    	<script>alert('Datos modificados');parent.window.location.reload(true);</script>
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
								<a style="height: 50px;" href="CrearCancha.php" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-raised" >Aceptar</a>
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