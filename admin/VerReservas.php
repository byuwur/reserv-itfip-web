<?php
include("conexion.php");
$IdCancha=$_GET['IDC'];
$FechaHoy=$_GET['FechaHoy'];
if(isset($_GET['UDI'])){
$IdUsuario=$_GET['UDI'];
}
$A = substr($FechaHoy, 0, 4); 
$M = substr($FechaHoy, 5, 2); 
$D = substr($FechaHoy, 8, 2); 

  date_default_timezone_set('America/Bogota'); 

  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $Fecha=date($D)." de ".$meses[date($M)-1]. " del ".date($A);

if ($IdCancha != ""){
  $sql1=$conex->query("SELECT canchas.usuario_IDUSUARIO, canchas.NOMBRECANCHA, canchas.HORAABRIR, canchas.HORACERRAR FROM canchas WHERE canchas.IDCANCHAS='$IdCancha'");
  $Resultado=mysqli_fetch_assoc($sql1);
  $IdUsuario = $Resultado['usuario_IDUSUARIO'];
  $HORACERRAR = date($Resultado['HORACERRAR']);
  $HORAABRIR = date($Resultado['HORAABRIR']);
  $Img= "http://reservelapp.com/admin/Imagenes_Canchas/".$IdCancha;
  
  echo '
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/index2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
      <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
      <link rel="stylesheet" href="css/bootstrap-material-datetimepicker.css" />
      <script type="text/javascript" src="js/bootstrap-material-datetimepicker.js"></script>
    <style>
      .red
      {
        color: white;
        background-color: red;
      }
      .green
      {
        color: white;
        background-color: green;
      }
      .blue
      {
        color: white;
        background-color: blue;
      }
    </style>
  </head>  
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <br />

          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner" role="listbox" style="height: 500px;">
              <div class="carousel-item active">
                <img style="width: 100%;" src="'.$Img.'/1.jpg" alt="First Slide" />
                <div class="carousel-caption">
                  <h2>Imagen 1</h2>
                </div>
              </div>
              <div class="carousel-item">
                <img style="width: 100%;" src="'.$Img.'/2.jpg" alt="Second Slide" />
                <div class="carousel-caption">
                  <h2>Imagen 2</h2>
                </div>
              </div>
              <div class="carousel-item">
                <img style="width: 100%;" src="'.$Img.'/3.jpg" alt="Third Slide" />
                <div class="carousel-caption">
                  <h2>Imagen 3</h2>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="icon-prev" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="icon-next" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-7">
          <h1 style="font-size:36px;">'.$Resultado['NOMBRECANCHA'].'</h1>
          <p  style="font-size:20px;"">Reservas del dia: '.$Fecha.'</p>
        </div>
          <div class="col-xs-12 col-sm-5">
            <form action="" method="GET">
              <h1 style="font-size:28px;">Seleccionar nueva fecha</h1>
              <input type="hidden" name="IDC" value="'.$IdCancha.'">
              <input type="date" value="FechaHoy" name="FechaHoy" style="width:300px; height:40px; font-size:26px" required>
              <input class="btn" type="submit" style="color:#fff;width: 100px;height: 40px;margin-top: -17px; margin-left:10px;font-size: 20px;background: #03a9f4;border: none;" value="Buscar">
            </form>
          </div>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="row">';
      $NuevaHora=$HORAABRIR;
      $Contador=0;
      while ($HORACERRAR!=$NuevaHora) {
        $Hora = strtotime ( $NuevaHora );
        //$NuevaHora = date ( 'H:i:s' , $Hora);

        $sql2=$conex->query("SELECT IDRESERVAS,HORAINICIO FROM reservarcancha WHERE HORAINICIO='$NuevaHora' AND FECHA='$FechaHoy' AND canchas_IDCANCHA='$IdCancha'");
        $Resul1=mysqli_fetch_assoc($sql2);
        if (mysqli_num_rows($sql2)!=0) {
          $sql3=$conex->query("SELECT reservarcancha.IDRESERVAS,reservarcancha.HORAINICIO,usuario.IDUSUARIOS,usuario.NOMBREUSUARIO,usuario.CORREOUSUARIO,usuario.CELULARUSUARIO FROM reservarcancha,usuario WHERE reservarcancha.usuario_IDUSUARIO=usuario.IDUSUARIOS AND reservarcancha.canchas_IDCANCHA='$IdCancha' AND reservarcancha.IDRESERVAS='$Resul1[IDRESERVAS]'");
            $Reservas=mysqli_fetch_assoc($sql3);
            echo '
              <div class="col-xs-12 col-sm-2" style="margin-top:20px;">
                  <div class="card">
                    <img class="card-img-top img-responsive" src="">
                    <h4 style="text-align:center">'.$Reservas['NOMBREUSUARIO'].'</h4>
                    <p style="font-size:12px; padding-left:5px;">Celular: '.$Reservas['CELULARUSUARIO'].'</p>
                    <p style="font-size:12px; padding-left:5px;">Email: '.$Reservas['CORREOUSUARIO'].'</p>
                    <h4 style="text-align:left; color:#ff5722">Hora: '.date("g:i a",strtotime($NuevaHora)).'</h4>
                    <div class="row">
                      <div class="col-sm-4">
                        <a onclick="EliminarReserva(this)" data-value="'.$Reservas['IDRESERVAS'].'" style="cursor:pointer;" title="Eliminar Reserva">
                          <img class="center-block" src="img/Eliminar.svg">
                        </a>
                      </div>
                      <div class="col-sm-4">
                        <a onclick="Descuento(this)" data-value="'.$Reservas['IDRESERVAS'].'" style="cursor:pointer;" title="Dar Descuento">
                          <img class="center-block" src="img/Descuento.svg">
                        </a>
                      </div>
                      <div class="col-sm-4">
                        <a onclick="Reprogramar(this)" data-value="'.$Reservas['IDRESERVAS'].'" style="cursor:pointer;" title="Mover Reserva">
                          <img class="center-block" src="img/Calendar.svg">
                        </a>
                      </div>
                      <input type="hidden" id="IdUsuario" value="'.$Reservas['IDUSUARIOS'].'">
                      <input type="hidden" id="NuevaHora" value="'.$NuevaHora.'">
                      <input type="hidden" id="FechaHoy" value="'.$FechaHoy.'">
                      <input type="hidden" id="IdCancha" value="'.$IdCancha.'">
                      <input type="hidden" id="IdReserva" value="'.$Reservas['IDRESERVAS'].'">
                    </div>
                  </div>
              </div>
              ';
          }else{
            echo '
            <div class="col-xs-12 col-sm-2" style="margin-top:20px;">
              <div class="card">
                <img class="card-img-top img-responsive" src="img/Logo.jpg">
                <br>
                <h4 style="text-align:center; color:#11a224">DISPONIBLE</h4>
                <p style="font-size:12px; padding-left:5px;"></p>
                <h4 style="text-align:center; color:#11a224">Hora: '.date("g:i a",strtotime($NuevaHora)).'</h4>
              </div>
            </div>';
          }
        $Hora = strtotime ( '+1 hour' , strtotime ( $NuevaHora ) );
        $NuevaHora = date ( 'H:i:s' , $Hora);
      }
        echo '
      </div>
      <div style="display:none; left:0px;margin-left:0px;" class="EliminarReserva Area_Oscura2">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <div class="well" style="margin-top:55%;">
                <img src="img/Eliminar.svg" class="center-block" style="width:80px;">
                <h4 align="center">Desea cancelar la reserva.</h4>
                <div class="row">
                  <div class="col-sm-6">
                   <input onclick="Desaparecer()" class="btn" type="submit" style="color:#fff;width: 100%;height: 40px;font-size: 20px;background: #ff3e3e;border: none;" value="Volver">
                  </div>
                  <div class="col-sm-6">
                    <form action="" method="POST">
                      <input type="hidden" value="" id="IdReservaE" name="IdReservE">
                      <input type="hidden" value="'.$IdUsuario.'" name="IDE">
                      <input type="hidden" value="'.$FechaHoy.'" name="FechaRE">
                      <input type="hidden" value="'.$IdCancha.'" name="IdCanchaRE">
                      <input name="EliminarReserva" class="btn" type="submit" style="color:#fff;width: 100%;height: 40px;font-size: 20px;background: #03a9f4;border: none;" value="Aceptar">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="display:none; left:0px;margin-left:0px;" class="ReprogramarReserva Area_Oscura2">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="well" style="margin-top:25%;">
                <img src="img/Calendar.svg" class="center-block" style="width:80px;">
                <h4 style="color:#818181" align="justify">Mover Reserva a otra cancha. Ten encuenta que se movera a la misma hora y fecha en la que se encuentra programada, de lo contrario el usuario o administrador debera eliminar y programar una nueva reserva.</h4>
              <form action="" method="POST">
                <input type="hidden" value="" id="IdReservaM" name="IdReservaM">';
                echo'
                <input type="hidden" value="'.$IdUsuario.'" name="IDM">
                <input type="hidden" value="'.$FechaHoy.'" name="FechaRM">
                <input type="hidden" value="'.$IdCancha.'" name="IdCanchaRM">
                <div class="row" style="margin-top:10px;">
                  <div class="col-sm-6">
                    <h4>Mover de la cancha: <br>'.$Resultado['NOMBRECANCHA'].'</h4>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <h4>A la cancha:</h4>
                      <select style="font-size:14px; height:32px" class="form-control" id="CanchaNueva" name="CanchaNueva">
                       ';
                       $Query=$conex->query("SELECT canchas.IDCANCHAS, canchas.NOMBRECANCHA FROM canchas, usuario WHERE usuario.IDUSUARIOS='$IdUsuario' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') AND canchas.IDCANCHAS!='$IdCancha'");
                      while ($ResultadoC=mysqli_fetch_assoc($Query)) {
                        echo '<option value="'.$ResultadoC['IDCANCHAS'].'">'.$ResultadoC['NOMBRECANCHA'].'</option>';
                      }
                      echo'
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                   <a onclick="Desaparecer()" class="btn" type="submit" style="color:#fff;width: 100%;height: 40px;font-size: 20px;background: #ff3e3e;border: none;">Volver</a>
                  </div>
                  <div class="col-sm-6">
                      <input name="Mover_Reserva" class="btn" type="submit" style="color:#fff;width: 100%;height: 40px;font-size: 20px;background: #03a9f4;border: none;" value="Aceptar">
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="display:none; left:0px;margin-left:0px;" class="Descuento Area_Oscura2">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <div class="well" style="margin-top:55%;">
                <img src="img/Descuento.svg" class="center-block" style="width:80px;">
                <h4 align="center">¿Desea otorgar un descuento a esta reserva?</h4>
                <form action="" method="POST">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-group label-floating">
                        <input type="text" maxlength="50" class="form-control" name="ValorDescuento" placeholder="Ej.: 150000" required onkeypress="return valida(event)">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                     <a onclick="Desaparecer()" class="btn" type="submit" style="color:#fff;width: 100%;height: 40px;font-size: 20px;background: #ff3e3e;border: none;">Volver</a>
                    </div>
                    <div class="col-sm-6">
                      <form action="" method="POST">
                      <input type="hidden" value="'.$IdUsuario.'" name="ID2">
                      <input type="hidden" value="'.$FechaHoy.'" name="FechaR2">
                      <input type="hidden" value="'.$IdCancha.'" name="IdCanchaR2">
                      <input type="hidden" value="" name="IdReservaD" id="IdReservaD">
                        <input name="Descuento" class="btn" type="submit" style="color:#fff;width: 100%;height: 40px;font-size: 20px;background: #03a9f4;border: none;" value="Aceptar">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--form action="CanchasAdmin.php" method="GET">
        <input type="hidden" name="IDC" value="'.$IdUsuario.'">
        <input class="btn" type="submit" style="color:#fff;width: 100px;height: 40px;margin-top: 20px;font-size: 20px;background: #f44336;border: none;" value="Volver">
      </form-->
    </div>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
  </body>
</html>';
} 
if (isset($_POST['EliminarReserva'])) {
$I=$_POST['IDE'];
$H=$_POST['HoraRE'];
$F=$_POST['FechaRE'];
$C=$_POST['IdCanchaRE'];
$IdReservE=$_POST['IdReservE'];
   $sql2=$conex->query("DELETE FROM reservarcancha WHERE IDRESERVAS='$IdReservE'");
   echo"
      <script type='text/javascript'>
        document.location = 'VerReservas.php?IDC=$C&FechaHoy=$F&UDI=$I';
      </script>
      ";
 } 

if (isset($_POST['Mover_Reserva'])) {
  $IdReservaMover=$_POST['IdReservaM'];
  $CanchaNueva=$_POST['CanchaNueva'];
  $Fecha=$_POST['FechaRM'];
  $Id_Cancha=$_POST['IdCanchaRM'];
  $Id_Usuario=$_POST['IDM'];

  $Sql01=$conex->query("SELECT canchas_IDCANCHA, HORAINICIO, FECHA FROM reservarcancha WHERE IDRESERVAS='$IdReservaMover'");
  $ResulSql01=mysqli_fetch_assoc($Sql01);

  $sqlM=$conex->query("SELECT IDRESERVAS FROM reservarcancha WHERE canchas_IDCANCHA='$CanchaNueva' AND HORAINICIO='$ResulSql01[HORAINICIO]' AND FECHA='$ResulSql01[FECHA]'");
    if (mysqli_num_rows($sqlM)>0) {
     echo'
      <div style="display:block; left:0px;margin-left:0px;" class="PopupMover Area_Oscura2">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <div class="well" style="margin-top:55%;">
                <img src="img/InfoN.svg" class="center-block" style="width:80px;">
                <h4 align="center">Ya existe una reserva para esta fecha y hora.</h4>
                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                   <input onclick="Desaparecer()" class="btn" type="submit" style="color:#fff;width: 100%;height: 40px;font-size: 20px;background: #ff3e3e;border: none;" value="Volver">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
    }else{
    $Sql02=$conex->query("UPDATE reservarcancha SET canchas_IDCANCHA='$CanchaNueva' WHERE IDRESERVAS='$IdReservaMover'");
   echo"
      <script type='text/javascript'>
        document.location = 'VerReservas.php?IDC=$Id_Cancha&FechaHoy=$Fecha&UDI=$Id_Usuario';
      </script>
      ";
    }
 } 
 if (isset($_POST['Descuento'])) {
$I=$_POST['ID2'];
$F=$_POST['FechaR2'];
$C=$_POST['IdCanchaR2'];
$IdReservaD=$_POST['IdReservaD'];
$ValorDescuento=$_POST['ValorDescuento'];
   $sql3=$conex->query("UPDATE reservarcancha SET VALORHORA='$ValorDescuento' WHERE IDRESERVAS='$IdReservaD'");
    echo"
      <script type='text/javascript'>
        document.location = 'VerReservas.php?IDC=$C&FechaHoy=$F&UDI=$I';
      </script>
      ";
 } 
?>
<script type="text/javascript">
var Id_ReservaVerif=0;
  function VerifReserva(elemento){
    Id_ReservaVerif = $(elemento).data('value');
    $("#IdReservaV").val(Id_ReservaVerif);

    $(".VerifReserva").fadeIn('fast');
  }
var Id_ReservaEliminar=0;
  function EliminarReserva(elemento){
    Id_ReservaEliminar = $(elemento).data('value');
    $("#IdReservaE").val(Id_ReservaEliminar);

    $(".EliminarReserva").fadeIn('fast');
  }
var Id_ReservaDescuento=0;
  function Descuento(elemento){
    Id_ReservaDescuento = $(elemento).data('value');
    $("#IdReservaD").val(Id_ReservaDescuento);

    $(".Descuento").fadeIn('fast');
  }
  var Id_ReservaMover=0;
  function Reprogramar(elemento){
    Id_ReservaMover = $(elemento).data('value');
    $("#IdReservaM").val(Id_ReservaMover);

    $(".ReprogramarReserva").fadeIn('fast');
  }
  function Desaparecer(){
    $(".EliminarReserva").fadeOut('fast');
    $(".Descuento").fadeOut('fast');
    $(".ReprogramarReserva").fadeOut('fast');
    $(".PopupMover").fadeOut('fast');
  }
</script>
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
    $(document).ready(function()
    {
      $('#date').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });

      $('#time').bootstrapMaterialDatePicker
      ({
        date: false,
        shortTime: false,
        format: 'HH:mm'
      });

      $('#date-format').bootstrapMaterialDatePicker
      ({
        format: 'dddd DD MMMM YYYY - HH:mm'
      });
      $('#date-fr').bootstrapMaterialDatePicker
      ({
        format: 'DD/MM/YYYY HH:mm',
        lang: 'fr',
        weekStart: 1, 
        cancelText : 'ANNULER',
        nowButton : true,
        switchOnClick : true
      });

      $('#date-end').bootstrapMaterialDatePicker
      ({
        weekStart: 0, format: 'DD/MM/YYYY HH:mm'
      });
      $('#date-start').bootstrapMaterialDatePicker
      ({
        weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime : true
      }).on('change', function(e, date)
      {
        $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
      });

      $('#min-date').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate : new Date()  });

      $.material.init()
    });
    </script>