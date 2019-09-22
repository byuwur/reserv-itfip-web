<?php 
include("Encabezado.php");
include("conexion.php");
include("Variables.php");
$Logos="Imagenes_Admin/".$IdUsuario."/1.jpg";
date_default_timezone_set('America/Bogota'); 
$FechaHoy=date('Y-m-d');
$Usuario = $_SESSION['user'];
//$IDI = $_SESSION['IDI'];
if ($IdUsuario != ""){
  echo "
  <script type='text/javascript'>
  jQuery(document).ready(function($){
    Dropzone.options.myDrop1={
      maxFileSize:2,
      acceptedFiles: 'image/*',

      init: function init(){
        this.on('error', function(){
          alert('Error al cargar el arhivo');
        });
      }
    }
  });
</script>
<div onclick='Refe_Ex()' class='menu-toggle Area_Oscura Ocultar_A'></div>
<div class='navbar-fixed-top navbar navbar-warning'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-warning-collapse'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      <a href='#' onclick='Refe_Ex()' class='menu-toggle navbar-brand'>

        <img href='javascript:void(0)' class='img-responsive center-block' src='img/Menu.svg' alt='icon'>
      </a>
    </div>
    <div class='navbar-collapse collapse navbar-warning-collapse'>
      <ul class='nav navbar-nav navbar-right'>
        <li class='dropdown'>
          <a href='javascript:void(0)' data-target='#' class='dropdown-toggle' data-toggle='dropdown'>";
            echo "<font>$Email</font>";
          echo "
          <span> </span><b class='caret'></b></a>
          <ul class='dropdown-menu'>
            <li><a href='../logout.php?logout'>Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class='container'>
  <div id='wrapper' class='active'>  
    <div id='sidebar-wrapper'>
      <div class='row'>
        <div class='container-fluid' style='background-image:url(img/intro-bg.jpg); background-size:cover; filter: blur(0px); height:125px; width:100%;'> 
        </div>
          <div class='row'>
            <div class='col-xs-5'>
                <br>
                <img class='img-responsive' src='".$Logos."' style='margin-left:5px; margin-top:-65px; border:solid 1px #fff;'>
            </div>
            <div class='col-xs-7' style='color:#fff; text-align:left'>
              <h5>Nombre: <span style='color:#818181; font-size:14px'>$Nombre</span></h5>
              <p>PIN: <span style='color:#818181; font-size:14px'>$IdUsuario</span></p>
            </div>
            <br>
          </div>
        <div style='margin-top: 15px;' class='col-xs-12'>
          <a style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='menu-toggle Ocultar_A btn btn-default' href='CanchasAdmin.php?IdUsuario=$IdUsuario' target='iframe_thingy'>
            <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Canchas Administradas</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Administradas2.svg' alt='icon'>
              </div>
            </div>
          </a>  
          <a style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='btn btn-default' data-toggle='collapse' href='#collapseExample' role='button' aria-expanded='false' aria-controls='collapseExample'>
              <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Reservas de canchas</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Calendario.svg' alt='icon'>
              </div>
            </div>
          </a>
          <div class='collapse' id='collapseExample'>
            <div class=''>";
            $sql1=$conex->query(" SELECT canchas.IDCANCHAS, canchas.NOMBRECANCHA FROM canchas, usuario WHERE usuario.IDUSUARIOS='$IdUsuario' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') ");
            while ($ResulC=mysqli_fetch_assoc($sql1)) {
              echo "
              <a id='Grados' target='iframe_thingy' href='VerReservas.php?UDI=$IdUsuario&IDC=".$ResulC['IDCANCHAS']."&FechaHoy=$FechaHoy' style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px; width:100%;' class='menu-toggle Ocultar_A btn btn-default'>
                <div class='row' style='padding-top: 0px;'>
                  <div class='col-xs-12'>
                    <p style='color:#818181'>".$ResulC['NOMBRECANCHA']."</p>
                  </div>
                </div>
              </a>";
            }
            echo "
            </div>
          </div>
          <a style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='btn btn-default' data-toggle='collapse' href='#collapseEstadisticas' role='button' aria-expanded='false' aria-controls='collapseExample'>
              <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Estadísticas de canchas</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Estadisticas.svg' alt='icon'>
              </div>
            </div>
          </a>
          <div class='collapse' id='collapseEstadisticas'>
            <div class=''>";
            $sql2=$conex->query(" SELECT canchas.IDCANCHAS, canchas.NOMBRECANCHA FROM canchas, usuario WHERE usuario.IDUSUARIOS='$IdUsuario' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') ");
            while ($ResulC=mysqli_fetch_assoc($sql2)) {
              echo "
              <a id='Grados' target='iframe_thingy' href='Estadisticas.php?UDI=$IdUsuario&IDC=".$ResulC['IDCANCHAS']."&FechaHoy=$FechaHoy&NombreCancha=".$ResulC['NOMBRECANCHA']."' style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px; width:100%;' class='menu-toggle Ocultar_A btn btn-default'>
                <div class='row' style='padding-top: 0px;'>
                  <div class='col-xs-12'>
                    <p style='color:#818181'>".$ResulC['NOMBRECANCHA']."</p>
                  </div>
                </div>
              </a>";
            }
            echo "
            </div>
          </div>
          
          <a style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='btn btn-default' data-toggle='collapse' href='#collapseInfo' role='button' aria-expanded='false' aria-controls='collapseExample'>
              <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Editar canchas</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Info.svg' alt='icon'>
              </div>
            </div>
          </a>
          <div class='collapse' id='collapseInfo'>
            <div class=''>";
            $sql3=$conex->query(" SELECT canchas.IDCANCHAS, canchas.NOMBRECANCHA FROM canchas, usuario WHERE usuario.IDUSUARIOS='$IdUsuario' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') ");
            while ($ResulC=mysqli_fetch_assoc($sql3)) {
              echo "
              <a id='Grados' target='iframe_thingy' href='ConfCancha.php?UDI=$IdUsuario&IDC=".$ResulC['IDCANCHAS']."' style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px; width:100%;' class='menu-toggle Ocultar_A btn btn-default'>
                <div class='row' style='padding-top: 0px;'>
                  <div class='col-xs-12'>
                    <p style='color:#818181'>".$ResulC['NOMBRECANCHA']."</p>
                  </div>
                </div>
              </a>";
            }
            echo "
            </div>
          </div>
          <a style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='btn btn-default' data-toggle='collapse' href='#collapseCanelacion' role='button' aria-expanded='false' aria-controls='collapseExample'>
              <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Reservas Canceladas</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Estadisticas.svg' alt='icon'>
              </div>
            </div>
          </a>
          <div class='collapse' id='collapseCanelacion'>
            <div class=''>";
            $sql2=$conex->query(" SELECT canchas.IDCANCHAS, canchas.NOMBRECANCHA FROM canchas, usuario WHERE usuario.IDUSUARIOS='$IdUsuario' AND (canchas.socio_IDUSUARIO='$IdUsuario' OR canchas.usuario_IDUSUARIO='$IdUsuario') ");
            while ($ResulC=mysqli_fetch_assoc($sql2)) {
              echo "
              <a id='Grados' target='iframe_thingy' href='Cancelacion.php?UDI=$IdUsuario&IDC=".$ResulC['IDCANCHAS']."&NombreCancha=".$ResulC['NOMBRECANCHA']."' style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px; width:100%;' class='menu-toggle Ocultar_A btn btn-default'>
                <div class='row' style='padding-top: 0px;'>
                  <div class='col-xs-12'>
                    <p style='color:#818181'>".$ResulC['NOMBRECANCHA']."</p>
                  </div>
                </div>
              </a>";
            }
            echo "
            </div>
          </div>
          <a id='Grados' target='iframe_thingy' href='CrearCancha.php?IdUsuario=$IdUsuario' style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='menu-toggle Ocultar_A btn btn-default'>
            <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Crear Canchas</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Crear.svg' alt='icon'>
              </div>
            </div>
          </a>
          <a style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='menu-toggle Ocultar_A btn btn-default' href='ConfPerfil.php?UDI=$IdUsuario' target='iframe_thingy'>
          ";
          echo "
            <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Editar Perfil</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Perfil.svg' alt='icon'>
              </div>
            </div>
          </a>
          <a style='color:#fff; padding: 10px 1px; text-align: left; margin-top: 0px;' class='menu-toggle Ocultar_A btn btn-light' href='Update_Contra.php?Usuario=$Usuario' target='iframe_thingy'>
          ";
          echo "
            <div class='row' style='padding-top: 0px;'>
              <div class='col-xs-9'>
                <p>Cambiar Contraseña</p>
              </div>
              <div class='col-xs-3'>
                <img class='center-block' id='' src='img/Contraseña.svg' alt='icon'>
              </div>
            </div>
          </a>
        </div>
      </div>
<font size='1' class='container text-center' style='color: #111;'>Mateus</font>
    </div>
  </div>
</div>
<br><br><br><br><br><br>
<iframe style='height:90%; margin-top:-65px' class='foo'  scrolling='yes' name='iframe_thingy' src='CanchasAdmin.php'>
</iframe>
";
include("Footer.php");
}else{
echo "
  <script type='text/javascript'>
    document.location = '../index.php';
  </script>
";
}
?>