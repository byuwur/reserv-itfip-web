<?php
	include 'conexion.php';

if (isset($_POST['id'])){
	
	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}

		$Registro_Img = "INSERT INTO imagen_usuario (usuario_IDUSUARIO) VALUES ('$id')";
		$conex->query($Registro_Img);
	
	echo "
	<script src='js/jquery-1.10.2.min.js'></script>
	<script type='text/javascript'>
	jQuery(document).ready(function($){
		Dropzone.options.myDrop1={
			maxFileSize:5,
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
		<p style="color:#f44336">*La imagen debe tener un peso máximo de 5 megabytes.</p>
		<div class="row">
			<div class="">';
			echo "
				<form action='upload.php' class='dropzone animar4' id='myDrop1'>
					<div class='form-group label-floating'>
					</div>
					<input type='hidden' name='IDI' value='$id'>
				</form>";
				echo'
			</div>
		</div>
		<p style="color:#000"><font size="2">La imagen se cargará automáticamente cuando la seleccione.</font></p>
	</div>	
	';
}
//<input type='file' name='file' required>
?>