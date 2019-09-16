<?php 
include("Encabezado.php");
include("conexion.php");
include("Variables.php");
$NombreCancha=$_GET['NombreCancha'];
$IdCancha=$_GET['IDC'];
$IdUsuario=$_GET['UDI'];
?>
<style type="text/css">
	.bmd-btn-fab.custom-file-control:before, .bmd-btn-icon.custom-file-control:before, .btn.bmd-btn-fab, .btn.bmd-btn-icon {
    color: #fff;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    padding: 0px;
}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php echo '
<div class="container" style="margin-top: 2%;">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="well">
				<button onclick="Nuevo()" type="button" class="btn btn-info bmd-btn-icon active" style="position: absolute; margin-left: 90%;z-index: 1" title="Nuevo Rango">
				  <i class="material-icons" style="color: #fff">more_vert</i>
				</button>	
		        <br>
		        <div id="top_x_div" style="width: 100%; height: 450px;"></div>
		      </div>
	    	</div>
	    	<br>
	  	</div>
	</div>
</div>
<div style="display:none; left:0px;margin-left:0px;" class="Nuevo Area_Oscura2">
    <div class="container">
        <div class="row">
           	<div class="col-sm-6 col-sm-offset-3">
              <div class="well" style="margin-top:20%;">
                <h3 align="center">Selecciona el nuevo rango.</h3>
                <form action="" method="POST">
	                <div class="row">
	                	<div class="col-sm-6">
	                  		<h4 style="color: #818181">Tipo de estadísticas:</h4>
							<select name="Tipo" class="form-control">
								<!-- <option value="Hora">Por Horas</option> -->
								<option value="Dias">Por Días</option>
							</select>
	                  	</div>
	                </div>
	                <div class="row">
		                <div class="col-sm-6">
		             	  	<h4 style="color: #818181">Desde:</h4>
							<input type="date" name="Fecha1" required>
		                </div>
		                <div class="col-sm-6">
		                  	<h4 style="color: #818181">Hasta:</h4>
							<input type="date" name="Fecha2" required>
		                </div>
	                </div>
	                <div class="row">
	                  <div class="col-sm-6">
	                   <a onclick="Ocultar()" class="btn btn-danger btn-raised" type="submit">Volver</a>
	                  </div>
	                  <div class="col-sm-6">
	                      <input type="hidden" value="'.$IdUsuario.'" name="UDI">
	                      <input type="hidden" value="'.$IdCancha.'" name="IDC">
	                      <input class="btn btn-info btn-raised" name="AceptarDias" type="submit" value="Aceptar">
	                  </div>
	                </div>
	            </form>
              </div>
            </div>
        </div>
    </div>
</div>';?>
<script type="text/javascript">
	function Nuevo(){
		$(".Nuevo").fadeIn('fast');
	}
	function Ocultar(){
		$(".Nuevo").fadeOut('fast');
	}
</script>

<?php
$Fecha1=0;
$Fecha2=0;

date_default_timezone_set('America/Bogota'); 
$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
if (isset($_POST['AceptarDias'])) {
	$Tipo=$_POST['Tipo'];
	$Fecha1=$_POST['Fecha1'];
	$Fecha2=$_POST['Fecha2'];
	$IdCancha=$_POST['IDC'];
	$IdUsuario=$_POST['UDI'];

	if ($Tipo=="Dias") {
		$Titulo="Estadística desde el día: ".$Fecha1." hasta el: ".$Fecha2;
		$sql1=$conex->query("SELECT FECHA, VALORHORA FROM reservarcancha, canchas WHERE reservarcancha.canchas_IDCANCHA='$IdCancha' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') AND reservarcancha.FECHA>='$Fecha1' AND reservarcancha.FECHA<='$Fecha2'");

		$DineroLunes=0;
		$DineroMartes=0;
		$DineroMier=0;
		$DineroJueves=0;
		$DineroVier=0;
		$DineroSabado=0;
		$DineroDomingo=0;
		while ($Resulsql1=mysqli_fetch_assoc($sql1)) {
			$DiaReserva=$first_day_of_September=$dias[date('w', strtotime($Resulsql1['FECHA']))];

			if ($DiaReserva=="Lunes") {
					$DineroLunes=$DineroLunes+$Resulsql1['VALORHORA'];
				}
			if ($DiaReserva=="Martes") {
					$DineroMartes=$DineroMartes+$Resulsql1['VALORHORA'];
				}
			if ($DiaReserva=="Miércoles") {
					$DineroMier=$DineroMier+$Resulsql1['VALORHORA'];
				}
			if ($DiaReserva=="Jueves") {
					$DineroJueves=$DineroJueves+$Resulsql1['VALORHORA'];
				}
			if ($DiaReserva=="Viernes") {
					$DineroVier=$DineroVier+$Resulsql1['VALORHORA'];
				}
			if ($DiaReserva=="Sábado") {
					$DineroSabado=$DineroSabado+$Resulsql1['VALORHORA'];
				}	
			if ($DiaReserva=="Domingo") {
					$DineroDomingo=$DineroDomingo+$Resulsql1['VALORHORA'];
				}	
		}
		echo '
		<script type="text/javascript">
			google.charts.load("current", {"packages":["bar"]});
		  google.charts.setOnLoadCallback(drawChart);

		  function drawChart() {
		    var data = google.visualization.arrayToDataTable([
		          ["Estadistica ganancia diaria",';
			if ($DineroLunes!=0) {
					echo '"Lunes",';
				}
			if ($DineroMartes!=0) {
					echo '"Martes",';
				}
			if ($DineroMier!=0) {
					echo '"Miércoles",';
				}
			if ($DineroJueves!=0) {
					echo '"Jueves",';
				}
			if ($DineroSabado!=0) {
					echo '"Sábado",';
				}
			if ($DineroDomingo!=0) {
					echo '"Domingo",';
				}
		echo '],
		          ["Gráfica", '; 
		    if ($DineroLunes!=0) {
					echo $DineroLunes.',';
				}
			if ($DineroMartes!=0) {
					echo $DineroMartes.',';
				}
			if ($DineroMier!=0) {
					echo $DineroMier.',';
				}
			if ($DineroJueves!=0) {
					echo $DineroJueves.',';
				}
			if ($DineroSabado!=0) {
					echo $DineroSabado.',';
				}
			if ($DineroDomingo!=0) {
					echo $DineroDomingo.',';
				}

		          echo']
		        ]);
		   var options = {
		    chart: {
		      title: "Cancha: '.$NombreCancha.'",
		      subtitle: "'.$Titulo.'",
		    }
		  };

		  var chart = new google.charts.Bar(document.getElementById("top_x_div"));

		  chart.draw(data, google.charts.Bar.convertOptions(options));
		}
		</script>';
	}else{
		$Titulo2="Estadística horas que más se utiliza la cancha, desde el día: ".$Fecha1." hasta el: ".$Fecha2;
		$sql1=$conex->query("SELECT HORAINICIO, VALORHORA FROM reservarcancha, canchas WHERE reservarcancha.canchas_IDCANCHA='$IdCancha' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') AND reservarcancha.FECHA>='$Fecha1' AND reservarcancha.FECHA<='$Fecha2' ORDER BY reservarcancha.HORAINICIO ASC");
		$con1=0;
		$con2=0;
		$Hora1=array();
		while($Horario=mysqli_fetch_array($sql1)){
		    $Hora1[]= $Horario['HORAINICIO'];
		}
		$counts = array_count_values($Hora1);
		$resultado = array_values(array_unique($Hora1));
		
		echo '
		<script type="text/javascript">
			google.charts.load("current", {"packages":["bar"]});
		  google.charts.setOnLoadCallback(drawChart);

		  function drawChart() {
		    var data = google.visualization.arrayToDataTable([
		          ["Estadistica diaria",';
			while ($resultado[$con1]!="") {
				echo '"'.date("g:i a",strtotime($resultado[$con1])).'" ,';
				$con1=$con1+1;
			}
		echo '],
		          ["Gráfica", '; 
		    while ($resultado[$con2]!="") {
				echo '"'.$counts[$resultado[$con2]].'" ,';
				$con2=$con2+1;
			}
		          echo']
		        ]);
		   var options = {
		    chart: {
		      title: "Cancha: '.$NombreCancha.'",
		      subtitle: "'.$Titulo2.'",
		    }
		  };

		  var chart = new google.charts.Bar(document.getElementById("top_x_div"));

		  chart.draw(data, google.charts.Bar.convertOptions(options));
		}
		</script>';
	}
}else{
	$Titulo="Estadística General";
	$sql1=$conex->query("SELECT FECHA, VALORHORA FROM reservarcancha, canchas WHERE reservarcancha.canchas_IDCANCHA='$IdCancha' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') ");

	$DineroLunes=0;
	$DineroMartes=0;
	$DineroMier=0;
	$DineroJueves=0;
	$DineroVier=0;
	$DineroSabado=0;
	$DineroDomingo=0;
	while ($Resulsql1=mysqli_fetch_assoc($sql1)) {
		$DiaReserva=$first_day_of_September=$dias[date('w', strtotime($Resulsql1['FECHA']))];

		if ($DiaReserva=="Lunes") {
				$DineroLunes=$DineroLunes+$Resulsql1['VALORHORA'];
			}
		if ($DiaReserva=="Martes") {
				$DineroMartes=$DineroMartes+$Resulsql1['VALORHORA'];
			}
		if ($DiaReserva=="Miércoles") {
				$DineroMier=$DineroMier+$Resulsql1['VALORHORA'];
			}
		if ($DiaReserva=="Jueves") {
				$DineroJueves=$DineroJueves+$Resulsql1['VALORHORA'];
			}
		if ($DiaReserva=="Viernes") {
				$DineroVier=$DineroVier+$Resulsql1['VALORHORA'];
			}
		if ($DiaReserva=="Sábado") {
				$DineroSabado=$DineroSabado+$Resulsql1['VALORHORA'];
			}	
		if ($DiaReserva=="Domingo") {
				$DineroDomingo=$DineroDomingo+$Resulsql1['VALORHORA'];
			}	
	}
	echo '
	<script type="text/javascript">
		google.charts.load("current", {"packages":["bar"]});
	  google.charts.setOnLoadCallback(drawChart);

	  function drawChart() {
	    var data = google.visualization.arrayToDataTable([
	          ["Estadistica ganancia diaria",';
		if ($DineroLunes!=0) {
				echo '"Lunes",';
			}
		if ($DineroMartes!=0) {
				echo '"Martes",';
			}
		if ($DineroMier!=0) {
				echo '"Miércoles",';
			}
		if ($DineroJueves!=0) {
				echo '"Jueves",';
			}
		if ($DineroSabado!=0) {
				echo '"Sábado",';
			}
		if ($DineroDomingo!=0) {
				echo '"Domingo",';
			}
	echo '],
	          ["Gráfica", '; 
	    if ($DineroLunes!=0) {
				echo $DineroLunes.',';
			}
		if ($DineroMartes!=0) {
				echo $DineroMartes.',';
			}
		if ($DineroMier!=0) {
				echo $DineroMier.',';
			}
		if ($DineroJueves!=0) {
				echo $DineroJueves.',';
			}
		if ($DineroSabado!=0) {
				echo $DineroSabado.',';
			}
		if ($DineroDomingo!=0) {
				echo $DineroDomingo.',';
			}

	          echo']
	        ]);
	   var options = {
	    chart: {
		      title: "Cancha: '.$NombreCancha.'",
		      subtitle: "'.$Titulo.'",
	    }
	  };

	  var chart = new google.charts.Bar(document.getElementById("top_x_div"));

	  chart.draw(data, google.charts.Bar.convertOptions(options));
	}
	</script>';
}


include("Footer.php");/*
echo "
  <script type='text/javascript'>
    document.location = '../index.php';
  </script>
";*/
?>