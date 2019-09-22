<?php 		
	include("conexion.php");
	$Id_Cancha=$_POST["IDI"];
	
	@mkdir("Imagenes_Canchas/$Id_Cancha/");
	@chmod("Imagenes_Canchas/*", 777);
			
	$randon = 2;
			
	$cmdBorrarDir = "rm -R Imagenes_Canchas/$Id_Cancha/2.jpg";
  	shell_exec($cmdBorrarDir);
	
	$extension = end(explode(".", $_FILES['archivo']['name']));
	$Ruta = "Imagenes_Canchas/".$Id_Cancha."/".basename($randon).$extension.".jpg"; 
	
	$Ruta2 = "http://reservelapp.com/admin/Imagenes_Canchas/".$Id_Cancha."/".basename($randon).$extension.".jpg"; 
	$uploadedfileload2="true";

	move_uploaded_file(@$_FILES['file']['tmp_name'], $Ruta); 

	$file_name2=$_FILES[file][name];
	$NombreImagen2 = $file_name2;
	
	$Registro_Evento = "UPDATE imagen_cancha SET Imagen2='$Ruta2', canchas_IDCANCHA='$Id_Cancha' where canchas_IDCANCHA='$Id_Cancha'";
	$conex->query($Registro_Evento);
?>