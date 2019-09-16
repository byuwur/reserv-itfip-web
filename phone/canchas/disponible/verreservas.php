<?php

include("conexion.php");
$IdCancha=$_GET['id'];
$fecha=$_GET['fecha'];

$A = substr($fecha, 0, 4); 
$M = substr($fecha, 5, 2); 
$D = substr($fecha, 8, 2); 

  date_default_timezone_set('America/Bogota'); 

  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $Fecha=date($D)." de ".$meses[date($M)-1]. " del ".date($A);

if ($IdCancha != ""){
  $sql1=$conex->query("SELECT IDCANCHAS, NOMBRECANCHA, HORAABRIR, HORACERRAR FROM canchas WHERE IDCANCHAS='$IdCancha' ");
  $Resultado=mysqli_fetch_assoc($sql1);

  $HORACERRAR = date($Resultado['HORACERRAR']);
  $HORAABRIR = date($Resultado['HORAABRIR']);
?>
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
      .red{
        color: white;
        background-color: red;
      }
      .green{
        color: white;
        background-color: green;
      }
      .blue{
        color: white;
        background-color: blue;
      }
    </style>
  </head>  
  <body>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12">
          <h1 style="font-size:27px;"><?php echo $Resultado['NOMBRECANCHA'] ?></h1>
          <h1 style="font-size:10px; text-align:left;">#<?php echo $Resultado['IDCANCHAS'] ?></h1>
          <p  style="font-size:12px; text-align:right;">Disponibilidad del dia:</p>
          <h6 style="font-size:17px; text-align:right;"><?php echo $Fecha ?></h6>
        </div>
        <?php
        echo '
        <div class="col-xs-12 col-sm-12">
            <form action="" method="get">
            <br><br>
              <h1 style="font-size:14px;">Seleccionar nueva fecha</h1>
              <input type="hidden" name="id" value="'.$IdCancha.'">
              <input type="date" value="fecha" name="fecha" style="width:150px; height:25px; font-size:12px" required>
              <input class="btn" type="submit" style="color:#fff;width: 50px;height: 40px;margin-top: -25px; margin-left:10px;font-size: 12px;background: #03a9f4;border: none;" value="Buscar">
            </form>
          </div>
          '
        ?>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="row">

    <?php

      $NuevaHora=$HORAABRIR;
      while ($HORACERRAR!=$NuevaHora) {
        $sql2=$conex->query("SELECT HORAINICIO FROM reservarcancha WHERE HORAINICIO='$NuevaHora' AND FECHA='$fecha' AND canchas_IDCANCHA='$IdCancha'");
        if (mysqli_num_rows($sql2)!=0) {
          $sql3=$conex->query("SELECT reservarcancha.HORAINICIO,usuario.IDUSUARIOS,usuario.NOMBREUSUARIO,usuario.CORREOUSUARIO,usuario.CELULARUSUARIO FROM reservarcancha,usuario WHERE reservarcancha.usuario_IDUSUARIO=usuario.IDUSUARIOS AND reservarcancha.canchas_IDCANCHA='$IdCancha'");
            $Reservas=mysqli_fetch_assoc($sql3);
    ?>
              <div class="col-xs-4 col-sm-4" style="margin-top:20px;">
                  <div class="card">
                    <br>
                      <h4 style="text-align:center; color:#ff3311">RESERVADA</h4>
                      <p style="font-size:12px; padding-left:5px;"></p>
                      <h4 style="text-align:center; color:#ff3311"><?php echo date("h:i a",strtotime($NuevaHora)) ?></h4>
                  </div>
              </div>
    <?php
          }else{
    ?>
            <div class="col-xs-4 col-sm-4" style="margin-top:20px;">
              <div class="card">
                <br>
                  <h4 style="text-align:center; color:#11a224">DISPONIBLE</h4>
                  <p style="font-size:12px; padding-left:5px;"></p>
                  <h4 style="text-align:center; color:#11a224"><?php echo date("h:i a",strtotime($NuevaHora)) ?></h4>
              </div>
            </div>
    <?php
          }
        $Hora = strtotime ( '+1 hour' , strtotime ( $NuevaHora ) ) ;
        $NuevaHora = date ( 'H:i:s' , $Hora);
      }
    ?>
      </div>
    </div>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
    <br><br><br><br><br><br>
  </body>
</html>
<?php
} 
?>
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