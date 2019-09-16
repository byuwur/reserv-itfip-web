<?php 

$Id = $_GET['IdUsuario'];
/*if ($Id!="") {*/
	include("Encabezado.php");
	include("conexion.php");
	$count = 1;
		while ($count!=0) {
			$chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   			$randomString = '';
    		for ($i = 0; $i < 6; $i++) {
        		$randomString .= $chars[rand(0, strlen($chars) - 1)];
    		}
			$query = "SELECT IDCANCHAS FROM canchas WHERE IDCANCHAS='$randomString'";
			$result = $conex->query($query);
			$count = mysqli_num_rows($result);
		}

	echo '
	<div class="container">
		<h1 style="text-align:center;">CREAR CANCHA</h1>
		<hr style="color:#818181; background:#818181; width:20%;">
		<form action="Fotos.php" method="POST">
			<div class="row">
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Barrio">Nombre de la cancha</label>
					<input type="text" maxlength="100" class="form-control" name="Nombre_Cancha_Txt" required>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group label-floating">
						<label for="Grados" class="control-label">Departamento</label>
						<select name="Departamento_Txt" class="form-control" id="Departamento" onchange="Cargar()">';
							$ConsultaG = $conex->query("SELECT * FROM departamento");
							while($Dep=mysqli_fetch_assoc($ConsultaG)){
								$Dep2 = $Dep["NOMBREDEPARTAMENTO"];
								echo "<option id=".$Dep["IDDEPARTAMENTOS"]." value=".$Dep["IDDEPARTAMENTOS"].">".$Dep["NOMBREDEPARTAMENTO"]."</option>";  
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
					<input type="text" maxlength="25" class="form-control" name="Barrio_Txt" required>
				</div>
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Direccion">Dirección de la cancha</label>
					<input type="text"  maxlength="50" class="form-control" name="Dir_Txt" required>
				</div>
				<div class="form-group label-floating col-xs-12 col-sm-4">
					<label class="control-label" for="Direccion">Teléfono de la cancha</label>
					<input type="tel" maxlength="10" class="form-control" name="Tel_Txt" required>
				</div>
			</div>
			<h4 style="color:#818181; margin-left:15px;">Dias de atención</h4>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dias_Apertura_Txt" class="bmd-label-floating">Lunes</label>
				    <select class="form-control" id="Lunes" name="Lunes">
				      <option>Si</option>
				      <option>No</option>
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Martes</label>
				    <select class="form-control" id="Martes" name="Martes">
				      <option>Si</option>
				      <option>No</option>
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Miércoles</label>
				    <select class="form-control" id="Miercoles" name="Miercoles">
				      <option>Si</option>
				      <option>No</option>
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Jueves</label>
				    <select class="form-control" id="Jueves" name="Jueves">
				      <option>Si</option>
				      <option>No</option>
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Viernes</label>
				    <select class="form-control" id="Viernes" name="Viernes">
				      <option>Si</option>
				      <option>No</option>
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Sábado</label>
				    <select class="form-control" id="Sabado" name="Sabado">
				      <option>Si</option>
				      <option>No</option>
				    </select>
				</div>
				<div class="form-group col-xs-12 col-sm-1">
					<label for="Dia_Cierre_Txt" class="bmd-label-floating">Domingo</label>
				    <select class="form-control" id="Domingo" name="Domingo">
				      <option>Si</option>
				      <option>No</option>
				    </select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-2">
					<label class="control-label" for="Hora">Hora de Apertura (Ej.: 09:00am)</label>
					<input type="time" min="00:00" max=23:00" class="form-control" name="Apertura_Txt" required>
				</div>
				<div class="form-group col-xs-12 col-sm-2">
					<label class="control-label" for="Hora">Hora de Cierre (Ej.: 10:00pm)</label>
					<input type="time" min="00:00" max=23:00" class="form-control" name="Cierre_Txt" required>
				</div>
				<div class="form-group col-xs-12 col-sm-2">
					<label class="control-label" for="Hora">Valor Hora (Ej.: 150000)</label>
					<input type="text" maxlength="10" class="form-control" name="Valor_Txt" required onkeypress="return valida(event)">
				</div>
			</div>
			<div class="row">
				<div class="form-group label-floating col-xs-12 col-sm-12">
					<label class="control-label" for="Hora">Información de la cancha</label>
					<textarea maxlength="199" class="form-control" name="Info_Txt" required></textarea>
				</div>
			</div>
			<div class="row" style="margin-top:50px;">
				<p style="color:#f44336">Si desea asociar su cancha con otro administrador, ingrese el ID del socio aquí.</p>
				<div class="form-group label-floating col-xs-12 col-sm-3">
					<label class="control-label" for="Hora">Codigo del asociado (opcional)</label>
					<input type="text" maxlength="6" class="form-control" name="Cod_Aso_Txt">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-sm-offset-9">
					<input data-toggle="modal" data-target="#processing-otros" type="submit" style="height: 50px;" name="Guardar" class="btn btn-info btn-raised" value="Siguiente">
				</div>
			</div>';echo"
			<input type='hidden' name='Id_Admin' value='$Id'>
			<input type='hidden' name='Id_Img' value='$randomString'>
		</form>
	</div>
	";
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

			var dataJson = eval(Ciudad);
				for(var i in dataJson){
					var u = document.createElement('option');
					u.value = dataJson[i].Id_Ciudad;
					u.style.color = '#818181';
					u.innerText = dataJson[i].Ciudad;
					document.getElementById("Ciudad").appendChild(u);
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

			var dataJson = eval(Ciudad);
				for(var i in dataJson){
					var u = document.createElement('option');
					u.value = dataJson[i].Id_Ciudad;
					u.style.color = '#818181';
					u.innerText = dataJson[i].Ciudad;
					document.getElementById("Ciudad").appendChild(u);
				}
		});
	}
</script>