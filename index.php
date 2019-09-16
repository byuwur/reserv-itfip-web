<?php
  ob_start();
  session_start();
  require_once 'conectar_bd.php';
  
  // it will never let you open index(login) page if session is set
  if ( isset($_SESSION['user'])!="" ) {
    header("Location: admin/index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="img/favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--titulo de la pagina-->
    <title>Sistema de Reservas para Canchas</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/custom.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css'>
    <!--For login-->
    <link rel="stylesheet" href="css/loginstyle.css">
  </head>

<!-- body -->
  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
      	<!-- navbar superior -->
        <a class="navbar-brand js-scroll-trigger" href="#page-top"> INICIO </a>
        <!-- menu responsive -->
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menú
          <i class="fa fa-bars"></i>
        </button>
        <!-- botones navbar -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#download">Reservar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login.php">Administrar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<!-- Intro Header -->
    <header class="masthead">
      <div class="intro-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
				<br><br><br><br>
              <h5 class="brand-heading">resérvelapp</h5>
				<br><br><br>
              <p class="intro-text"><br>Software administrador de reservas para canchas sintéticas.<br><font size="2"><b>TRAÍDO POR Another Programming Crew.</b></font></p>
          <a href="login.php" class="main-nav cd-signin btn btn-default"><h2>INICIAR SESIÓN</h2><h5>REGISTRAR</h5></a>
            </div>
          </div>
        </div>
      </div>
    </header>

<!-- Download Section -->
    <section id="download" class="download-section content-section text-center">
      <div class="container">
        <div class="col-lg-8 mx-auto">
          <h2>DESCARGAR PARA RESERVAR</h2>
          <p>Realice reservas en sus canchas preferidas desde nuestra aplicación. Comience pulsando el botón debajo.</p>
          <a href="https://play.google.com/store/apps/details?id=com.apc.reserv" class="btn btn-default btn-lg">
            <span class="network-name margintext">Descárguela desde<br>Google Play</span></a>
        </div>
      </div>
    </section>

<!-- Contact Section -->
    <section id="contact" class="content-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>Contacto</h2><br>
            <p id="contact-title">No dude en usar nuestra 
              <a class="js-scroll-trigger" onclick="showDiv()" href="#contact-title">Sección de Comentarios</a>
              para enviar sus opiniones y sugerencias.
              </p>

<!-- Feedback -->
      <div id="cd-feedback" class="cd-user-modal-feedback" style="display:none;"> <!-- feedback form -->
        <form href="#" class="cd-form" method="POST">
        	<p class="cd-form-message"><font size="3">Permítanos su correo electrónico para poder comunicarnos con usted. A continuación envíe su mensaje.</font></p>
          <p class="fieldset">
            <label class="image-replace cd-email" for="feed-email">E-mail</label>
            <input class="full-width has-padding has-border" id="feed-email" name="feed-email" type="email" placeholder="Correo electrónico">
            <span class="cd-error-message">Ingrese su correo electrónico</span>
          </p>

          <p class="fieldset">
            <label class="image-replace cd-username" for="feed-message">Message</label>
            <input class="full-message has-padding has-border" id="feed-message" name="feed-message" type="text" placeholder="Mensaje">
            <span class="cd-error-message">Escriba su mensaje</span>
          </p>

          <p class="fieldset">
            <input class="full-width has-padding" type="submit" id="enviarfeed" name="enviarfeed" value="Enviar">
          </p>
        </form>
      </div> <!--feedback-->
        <!-- Footer -->
        <p class="container text-center"><h6>&copy; 2018, Another Programming Crew</h6></p>
          </div>
        </div>
      </div>
    </section>

    <font size="1" class="container text-center" style="color: #111;">Mateus</font>

    <?php

if( isset($_POST['enviarfeed']) ) {

  if (!empty($_POST['feed-email'])){
    $correo = trim($_POST['feed-email']);
    $correo = strip_tags($correo);
    $correo = htmlspecialchars($correo);
  }
  if (!empty($_POST['feed-message'])){
    $feed = trim($_POST['feed-message']);
    $feed = strip_tags($feed);
    $feed = htmlspecialchars($feed);
  } 
  if (empty($correo)) {
    //echo "<script>parent.window.location.reload(true);</script>";
    echo "<script>alert('Ingrese un correo de contacto.');</script>";
        exit;
  }
  if (empty($feed)) {
    //echo "<script>parent.window.location.reload(true);</script>";
    echo "<script>alert('Ingrese un mensaje.');</script>";
        exit;
  }

  $query = $conex->query(" INSERT INTO feedback (CORREOFEED, MENSAJEFEED) VALUES ('$correo', '$feed') ");
  
  if ($query) {
    //echo "<script>parent.window.location.reload(true);</script>";
    echo "<script>alert('Su mensaje ha sido recibido. Gracias por su apoyo.');</script>";
        exit;
  }
  else {
    //echo "<script>parent.window.location.reload(true);</script>";
    echo "<script>alert('Algo salió mal. Intente de nuevo.');</script>";
        exit;
  }
}

    ?>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="js/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for this template -->
    <script src="js/custom.min.js"></script>
    <!-- Login script -->
    <script src="js/loginscript.js"></script>

    <!--Feedback slider-->
    <script type="text/javascript">
	function showDiv() {
    document.getElementById('cd-feedback').style.display = "block";
    document.getElementById('feed-email').focus();
	}    	
    </script>

  </body>
</html>