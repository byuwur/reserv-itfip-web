<?php 
include("Encabezado.php");
include("conexion.php");
$IdCancha=$_GET['IDC'];
$FechaHoy=$_GET['FechaHoy'];
$IdUsuario=$_GET['UDI'];
if ($IdCancha!="" && $IdUsuario!="") {
echo'
<div class="container" style="margin-top: 2%;">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<div class="well" style="text-align:center">
				<h2>Selecciona el tipo de estadística que deseas visualizar</h2>
		        <br>
		        <div class="row">
			        <div class="form-group col-xs-12 col-sm-12">
						<label for="Dias_Apertura_Txt" class="bmd-label-floating">Estadísticas</label>
					    <select class="form-control" id="" name="TipoEsta">
					      <option>Diario, Semanal, Mensual o anual</option>
					      <option></option>
					    </select>
					</div>
				</div>
		      	<a href="Seleccionar_Estadistica.php?Usuario=$Usuario&IDI=$IDI" style="margin-top: 35px; height: 50px;"class="btn btn-danger btn-raised">Volver</a>
    		</div>
  		</div>
	</div>
</div>';
include("Footer.php");
}else{ echo "
  <script type='text/javascript'>
    document.location = '../index.php';
  </script>
";}
?>