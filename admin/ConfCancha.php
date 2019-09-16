<?php 

$Id = $_GET['UDI'];
$IdCancha = $_GET['IDC'];
/*if ($Id!="") {*/
	include("Encabezado.php");
	include("conexion.php");
	
	$datoscancha = $conex->query(" SELECT * FROM canchas WHERE IDCANCHAS='$IdCancha' AND (usuario_IDUSUARIO='$Id' OR socio_IDUSUARIO='$Id') ") ;
	$datoscanchaarray = mysqli_fetch_assoc($datoscancha);

	$res2= $conex -> query(" SELECT * FROM ciudad WHERE IDCIUDADES='$datoscanchaarray[ciudad_IDCIUDAD]' ");
	$res2array = mysqli_fetch_assoc($res2);

	$diascancha = $conex->query(" SELECT * FROM diasatencion WHERE canchas_IDCANCHA='$IdCancha' ") ;
	$diascanchaarray = mysqli_fetch_assoc($diascancha);
	echo '
	<div class="container">
		<h1 style="text-align:center;">MODIFICAR CANCHA</h1>
		<hr style="color:#818181; background:#818181; width:20%;">
		<form action="UpdateFotos.php" method="POST">
			<div class="row">
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Barrio">Nombre de la cancha</label>
					<input type="text" maxlength="100" class="form-control" id="Nombre_Cancha_Txt" name="Nombre_Cancha_Txt" value="'.$datoscanchaarray['NOMBRECANCHA'].'" required>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group label-floating">
						<label for="Grados" class="control-label">Departamento</label>
						<select name="Departamento_Txt" class="form-control" id="Departamento" onchange="Cargar()">';
							$ConsultaG = $conex->query("SELECT * FROM departamento");
							while($Dep=mysqli_fetch_assoc($ConsultaG)){
								if ($Dep["IDDEPARTAMENTOS"] == $res2array["departamento_IDDEPARTAMENTO"]){
									$Dep2 = $Dep["NOMBREDEPARTAMENTO"];
									echo "<option id=".$Dep["IDDEPARTAMENTOS"]." value=".$Dep["IDDEPARTAMENTOS"]." selected>".$Dep["NOMBREDEPARTAMENTO"]."</option>";  
								}else{
									$Dep2 = $Dep["NOMBREDEPARTAMENTO"];
									echo "<option id=".$Dep["IDDEPARTAMENTOS"]." value=".$Dep["IDDEPARTAMENTOS"].">".$Dep["NOMBREDEPARTAMENTO"]."</option>";  
								}
								};				
						echo '</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group" style="margin-top:0px;">
						<label for="Grados" class="control-label">Ciudad</label>
						<select id="Ciudad" name="Ciudad_Txt" class="form-control">
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Barrio">Barrio</label>
					<input type="text" maxlength="25" class="form-control" id="Barrio_Txt" name="Barrio_Txt" value="'.$datoscanchaarray['BARRIO'].'" required>
				</div>
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Direccion">Dirección de la cancha</label>
					<input type="text"  maxlength="50" class="form-control" id="Dir_Txt" name="Dir_Txt" value="'.$datoscanchaarray['UBICACION'].'" required>
				</div>
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Direccion">Teléfono de la cancha</label>
					<input type="tel" maxlength="10" class="form-control" id="Tel_Txt" name="Tel_Txt" value="'.$datoscanchaarray['TELEFONOCANCHA'].'" required>
				</div>
			</div>
			';
			echo '
			<h4 style="color:#818181; margin-left:15px;">Dias de atención</h4>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dias_Apertura_Txt" class="bmd-label-floating">Lunes</label>
				    <select class="form-control" id="Lunes" name="Lunes">
				    ';
				    if ($diascanchaarray['L']=="Si"){	
					    echo'
					      <option selected>Si</option>
					      <option>No</option>
					    ';
				    }else{
					    echo'
					      <option >Si</option>
					      <option selected>No</option>
					    ';
				    }
				    echo '
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Martes</label>
				    <select class="form-control" id="Martes" name="Martes">
				      ';
				    if ($diascanchaarray['M']=="Si"){	
					    echo'
					      <option selected>Si</option>
					      <option>No</option>
					    ';
				    }else{
					    echo'
					      <option >Si</option>
					      <option selected>No</option>
					    ';
				    }
				    echo '
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Miércoles</label>
				    <select class="form-control" id="Miercoles" name="Miercoles">
				      ';
				    if ($diascanchaarray['X']=="Si"){	
					    echo'
					      <option selected>Si</option>
					      <option>No</option>
					    ';
				    }else{
					    echo'
					      <option >Si</option>
					      <option selected>No</option>
					    ';
				    }
				    echo '
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Jueves</label>
				    <select class="form-control" id="Jueves" name="Jueves">
				      ';
				    if ($diascanchaarray['J']=="Si"){	
					    echo'
					      <option selected>Si</option>
					      <option>No</option>
					    ';
				    }else{
					    echo'
					      <option >Si</option>
					      <option selected>No</option>
					    ';
				    }
				    echo '
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Viernes</label>
				    <select class="form-control" id="Viernes" name="Viernes">
				      ';
				    if ($diascanchaarray['V']=="Si"){	
					    echo'
					      <option selected>Si</option>
					      <option>No</option>
					    ';
				    }else{
					    echo'
					      <option >Si</option>
					      <option selected>No</option>
					    ';
				    }
				    echo '
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Sábado</label>
				    <select class="form-control" id="Sabado" name="Sabado">
				      ';
				    if ($diascanchaarray['S']=="Si"){	
					    echo'
					      <option selected>Si</option>
					      <option>No</option>
					    ';
				    }else{
					    echo'
					      <option >Si</option>
					      <option selected>No</option>
					    ';
				    }
				    echo '
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Domingo</label>
				    <select class="form-control" id="Domingo" name="Domingo">
				      ';
				    if ($diascanchaarray['D']=="Si"){	
					    echo'
					      <option selected>Si</option>
					      <option>No</option>
					    ';
				    }else{
					    echo'
					      <option >Si</option>
					      <option selected>No</option>
					    ';
				    }
				    echo '
				    </select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-2">
					<label class="control-label" for="Hora">Hora de Apertura (Ej.: 09:00am)</label>
					<input type="time" min="00:00" max=23:00" class="form-control" id="Apertura_Txt" name="Apertura_Txt" value="'.$datoscanchaarray['HORAABRIR'].'" required>
				</div>
				<div class="form-group col-xs-12 col-sm-2">
					<label class="control-label" for="Hora">Hora de Cierre (Ej.: 10:00pm)</label>
					<input type="time" min="00:00" max=23:00" class="form-control" id="Cierre_Txt" name="Cierre_Txt" value="'.$datoscanchaarray['HORACERRAR'].'" required>
				</div>
				<div class="form-group col-xs-12 col-sm-2">
					<label class="control-label" for="Hora">Valor Hora (Ej.: 150000)</label>
					<input type="text" maxlength="10" class="form-control" id="Valor_Txt" name="Valor_Txt" value="'.$datoscanchaarray['TARIFA'].'" required onkeypress="return valida(event)">
				</div>
			</div>
			<div class="row">
				<div class="form-group label-floating col-xs-12 col-sm-12">
					<label class="control-label" for="Hora">Información de la cancha</label>
					<textarea maxlength="199" class="form-control" id="Info_Txt" name="Info_Txt" required>'.$datoscanchaarray['CARACTERISTICAS'].'</textarea>
				</div>
			</div>
			<div class="row" style="margin-top:50px;">
				<p style="color:#f44336">Si desea asociar su cancha con otro administrador, ingrese el ID del socio aquí.</p>
				<div class="form-group label-floating col-xs-12 col-sm-3">
					<label class="control-label" for="Hora">Codigo del asociado (opcional)</label>
					<input type="text" maxlength="6" class="form-control" id="Cod_Aso_Txt" name="Cod_Aso_Txt" value="'.$datoscanchaarray['socio_IDUSUARIO'].'">
				</div>
			</div>
			';
			$verifadmin = $conex->query(" SELECT * FROM canchas WHERE IDCANCHAS='$IdCancha' AND usuario_IDUSUARIO='$Id' ") ;
			$countverifadmin = mysqli_num_rows($verifadmin);
			if ($countverifadmin == 1){
			echo'
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-sm-offset-9">
					<input data-toggle="modal" data-target="#processing-otros" type="submit" style="height: 50px;" name="Guardar" class="btn btn-info btn-raised" value="Siguiente">
				</div>
			</div>';echo"
			<input type='hidden' name='Id_Admin' value='$Id'>
			<input type='hidden' name='Id_Img' value='$IdCancha'>
			</form>
			";
			echo'
			<div class="row">
					<div class="col-xs-12 col-sm-3 col-sm-offset-9">
						<input data-toggle="modal" data-target="#delete-cancha" type="submit" style="height: 50px;" name="Eliminar" class="btn btn-warning btn-raised" value="ELIMINAR CANCHA">
					</div>
			</div>
			<form action="#" method="POST">
			<div class="modal modal-static fade" id="delete-cancha" role="dialog" aria-hidden="false">
					<div class="modal-dialog">
						<div style="height:auto;" class="modal-content">
							<div class="modal-body">
								<div class="">
									<div class="row">
										<div style="text-align:center; height:40px;">
											<h4>¿Está seguro que desea eliminar esta cancha?<br><h5 style="color:#b33;">*Recuerde que esta acción es permanente y no se puede deshacer.</h5></h4>
										</div>
										<br><br><br>
										<div class="col-xs-12 col-sm-6">
											<a style="height: 50px;" href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-raised" >Cancelar</a>
										</div>
										<div class="col-xs-12 col-sm-6">
										<form action="#" method="POST">';
											echo '
											<input data-toggle="modal" data-target="#Mensaje" type="submit" style="height: 50px;" name="Eliminar" class="btn btn-info btn-raised" value="Aceptar">
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			';
			} else {
				echo"
				<script type='text/javascript'>
				    document.getElementById('Nombre_Cancha_Txt').readOnly = true;
				    document.getElementById('Departamento').readOnly = true;
				    document.getElementById('Ciudad').readOnly = true;
				    document.getElementById('Barrio_Txt').readOnly = true;
				    document.getElementById('Dir_Txt').readOnly = true;
				    document.getElementById('Tel_Txt').readOnly = true;
				    document.getElementById('Apertura_Txt').readOnly = true;
				    document.getElementById('Cierre_Txt').readOnly = true;
				    document.getElementById('Valor_Txt').readOnly = true;
				    document.getElementById('Info_Txt').readOnly = true;
				    document.getElementById('Cod_Aso_Txt').readOnly = true;
				    document.getElementById('Departamento').disabled = true;
				    document.getElementById('Ciudad').disabled = true;
				    document.getElementById('Lunes').disabled = true;
				    document.getElementById('Martes').disabled = true;
				    document.getElementById('Miercoles').disabled = true;
				    document.getElementById('Jueves').disabled = true;
				    document.getElementById('Viernes').disabled = true;
				    document.getElementById('Sabado').disabled = true;
				    document.getElementById('Domingo').disabled = true;
				</script>
				";
			}
		echo "
		<input type='hidden' name='Id_Admin' value='$Id'>
		<input type='hidden' name='Id_Img' value='$IdCancha'>
		</form>
	</div>
	";

	if (isset($_POST['Eliminar'])){

		$sql = $conex->query(" DELETE FROM calificarcancha WHERE canchas_IDCANCHA='$IdCancha'; ");
		$sql = $conex->query(" DELETE FROM diasatencion WHERE canchas_IDCANCHA='$IdCancha'; ");
		$sql = $conex->query(" DELETE FROM favorito WHERE canchas_IDCANCHA='$IdCancha'; ");
		$sql = $conex->query(" DELETE FROM diasatencion WHERE canchas_IDCANCHA='$IdCancha'; ");
		$sql = $conex->query(" DELETE FROM imagen_cancha WHERE canchas_IDCANCHA='$IdCancha'; ");
		$sql = $conex->query(" DELETE FROM reservarcancha WHERE canchas_IDCANCHA='$IdCancha'; ");
		$sql = $conex->query(" DELETE FROM reservascancel WHERE canchas_IDCANCHA='$IdCancha'; ");
		$sql = $conex->query(" DELETE FROM canchas WHERE IDCANCHAS='$IdCancha'; ");
		 
		if ($sql){
			echo "
		      <div style='display:block;left:0px;' class='Area_Oscura2'>
		        <div class='container'>
		          <div class='row'>
		            <div class='col-sm-4 col-sm-offset-4'>
		              <div class='well' style='margin-top:55%;'>
		                <h4 align='center'>La cancha ha sido eliminada.</h4>
		                <div class='row'>
		                  <div class='col-sm-8 col-sm-offset-2'>
		                    <form action='' method='GET'>
		                    	<script>alert('Cancha eliminada');parent.window.location.reload(true);</script>
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
								<a style="height: 50px;" href="ConfCancha.php?UDI='.$Id.'&IDC='.$IdCancha.'" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-raised" >Aceptar</a>
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
/*}*/
include("Footer.php");
?>

<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>
<script type="text/javascript">
$(document).ready(function(){
  	$IdCiudad = document.getElementById("Departamento").value;
		var data = {Id:$IdCiudad};
		$("#Ciudad").empty();
		$.ajax({
			url: 'Service/Ciudad.php',
			type: 'POST',
			data: data,
			dataType: "json",
			beforeSend: function(){
				console.log('enviando datos a la BD.... :)');
			}
		}).done(function(Ciudad) {

		var php_idcity = <?php echo $datoscanchaarray['ciudad_IDCIUDAD']; ?> ;

			var dataJson = eval(Ciudad);
				for(var i in dataJson){
					var u = document.createElement('option');
					u.value = dataJson[i].Id_Ciudad;
					u.style.color = '#818181';
					u.innerText = dataJson[i].Ciudad;
					document.getElementById("Ciudad").appendChild(u);

					if ( u.value==php_idcity){
						document.getElementById("Ciudad").value=php_idcity;
					}
				}
		});
  });
	function Cargar(){
		$IdCiudad = document.getElementById("Departamento").value;
		var data = {Id:$IdCiudad};
		$("#Ciudad").empty();
		$.ajax({
			url: 'Service/Ciudad.php',
			type: 'POST',
			data: data,
			dataType: "json",
			beforeSend: function(){
				console.log('enviando datos a la BD.... :)');
			}
		}).done(function(Ciudad) {

		var php_idcity = <?php echo $datoscanchaarray['ciudad_IDCIUDAD']; ?> ;

			var dataJson = eval(Ciudad);
				for(var i in dataJson){
					var u = document.createElement('option');
					u.value = dataJson[i].Id_Ciudad;
					u.style.color = '#818181';
					u.innerText = dataJson[i].Ciudad;
					document.getElementById("Ciudad").appendChild(u);

					if ( u.value==php_idcity){
						document.getElementById("Ciudad").value=php_idcity;
					}
				}
		});
	}
</script>