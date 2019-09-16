<?php
    ob_start();
    session_start();
	require_once 'conectar_bd.php';
	// it will never let you open index(login) page if session is set
	if( isset($_SESSION['user'])!="" ){
		header("Location: admin/index.php");
		exit;
	}
	$error = false;
    $errorid = false;

	if( isset($_POST['btn-login']) ) {
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		//verify field
		if(empty($email)){
			$error = true;
			$emailError = "Ingrese su correo electrónico.";
		}
		//verify field
		if(empty($pass)){
			$error = true;
			$passError = "Ingrese su contraseña.";
		}
		// if there's no error, continue to login
		if (!$error) {
			$password = hash('sha256', $pass); // password hashing using SHA256
			//PARA VERIFICAR EL CORREO ELECTRÓNICO
			$res=$conex->query("SELECT IDUSUARIOS, NOMBREUSUARIO, PASSWORDUSUARIO, ROL FROM usuario WHERE CORREOUSUARIO='$email'");
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
			if( $count == 1 && $row['PASSWORDUSUARIO']==$password ) {
                //SI TODO ES CORRECTO PARA QUE VERIFIQUE QUE INGRESE COMO ADMINISTRADOR
                //PARA EVITAR QUE RESERVISTAS INGRESEN AL ENTORNO DE ADMINISTRADOR
                	if ($row['ROL']==2){
                    	$errMSG = "Este usuario es CLIENTE. Ingrese solo como ADMINISTRADOR. Para ingresar como cliente, hágalo desde la aplicación de Resérvelapp en Google Play.";
                    }
                    else{
                    	$_SESSION['user'] = $row['IDUSUARIOS'];
                    	header("Location: admin/index.php");
                    }
			}
			else {
				//PARA VERIFICAR EL PIN SI NO SE INGRESA EL CORREO
                $res=$conex->query("SELECT IDUSUARIOS, NOMBREUSUARIO, PASSWORDUSUARIO, ROL FROM usuario WHERE IDUSUARIOS='$email'");
                $row=mysqli_fetch_array($res);
                $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
                if( $count == 1 && $row['PASSWORDUSUARIO']==$password ) {
                //SI TODO ES CORRECTO PARA QUE VERIFIQUE QUE INGRESE COMO ADMINISTRADOR
                //PARA EVITAR QUE RESERVISTAS INGRESEN AL ENTORNO DE ADMINISTRADOR
                	if ($row['ROL']==2){
                    	$errMSG = "Este usuario es CLIENTE. Ingrese solo como ADMINISTRADOR. Para ingresar como cliente, hágalo desde la aplicación de Resérvelapp en Google Play.";
                    }
                    else{
                    	$_SESSION['user'] = $row['IDUSUARIOS'];
                    	header("Location: admin/index.php");
                    }
                }
                else {
                    $errMSG = "Credenciales incorrectas. Intente de nuevo.";
                }
			}
		}
	}
    if (isset($_POST['btn-reset'])){
        // prevent sql injections/ clear user invalid inputs
        $email = trim($_POST['reset-email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
        //verify field
        if(empty($email) || $errorid){
            $error = true;
            $errMSG = "Ingrese su correo electrónico para recuperar su contraseña.";
        }
        if (!$error) {
            $errMSG = "Por favor, espere. Se ha enviado una contraseña temporal a su correo electrónico.<br><small>(Sugerimos que revise su carpeta de spam.)</small><br>Se le sugiere cambiar la contraseña inmediatamente al iniciar sesión.";
        } else {
            $errMSG = "Algo no salió bien. Intente de nuevo.";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="img/favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--titulo de la pagina-->
    <title>Iniciar sesión</title>
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
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" id="mainNav">
      <div class="container">
      	<!-- navbar superior -->
        <a class="navbar-brand js-scroll-trigger" href="index.php">ATRÁS</a>
        <!-- menu responsive -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="registrar.php">REGISTRAR</a>
            </li>
          </ul>
      </div>
    </nav>
<!-- login form -->
<header class="masthead">
<div class="cd-user-modal-login">
	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    	<div class="col-md-12">
        	<div class="form-group">
            	<h1 class="">INICIAR SESIÓN</h1>
                <h5>como ADMINISTRADOR</h5>
            </div>

        	<div class="form-group">
            	<hr />
            </div>

            <?php
			if ( isset($errMSG) ) {
			?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
            <?php
			}
			?>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" name="email" class="form-control" placeholder="Número PIN o Correo electrónico" maxlength="150" />
                </div>
                <?php
                if ( isset($emailError) ) {
                ?>
                <div class="alert alert-danger">
                <span class="text-danger">
                    <?php echo $emailError; ?>
                </span>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Contraseña" maxlength="125" />
                <a href="#" class="btn btn-default hide-password">Mostrar</a>
                </div>
                <?php
                if ( isset($passError) ) {
                ?>
                <div class="alert alert-danger">
                <span class="text-danger">
                    <?php echo $passError; ?>
                </span>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="form-group">
                <a class="js-scroll-trigger" onclick="showDiv()" href="#recover-pass">¿Olvidó su contraseña?</a>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" name="btn-login">INICIAR</button>
            </div>

            <div class="form-group">
            	<a href="registrar.php"><h5><hr />REGÍSTRESE AQUÍ.</h5><br><br></a>
            </div>

        </div>
    </form>
    </div>

<!-- Feedback -->
      <div id="cd-feedback" class="cd-user-modal-feedback" style="display:none; margin-top: 0px;"> <!-- feedback form -->
        <p class="cd-form-message">¿Ha olvidado su contraseña? Ingrese su dirección de correo electrónico. Recibirá un enlace para establecer una contraseña nueva.</p>
        <form href="#" method="POST" class="cd-form">
          <p class="fieldset">
            <label class="image-replace cd-email" for="reset-email">E-mail</label>
            <input class="full-width has-padding has-border" id="reset-email" name="reset-email" type="email" placeholder="Correo electrónico">
            <span class="cd-error-message">Ingrese su correo electrónico</span>
          </p>
          <p class="fieldset">
            <input class="full-width has-padding" type="submit" name="btn-reset" value="Restablecer contraseña">
          </p>
        </form>
      </div> <!--feedback-->
</div>
</header>

<?php

function GenerarID ($length = 3){
    $cadena="";
    $opc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
    for($i=0; $i<8; $i++){
        $cadena .= substr($opc,rand(0,strlen($opc)),1);
    }
    return $cadena;
}

$error=false;

if( isset($_POST['btn-reset']) ) {

    if (!empty($_POST['reset-email'])){
        $id = trim($_POST['reset-email']);
        $id = strip_tags($id);
        $id = htmlspecialchars($id);
    }
    if(empty($id)){
        $error=true;
        $errorid = true;
        $mensaje = "Ingrese su ID o correo electrónico.";
        echo "<script>alert('$mensaje');</script>";
    }

    if (!$error) {
        //PARA VERIFICAR EL CORREO ELECTRÓNICO
        $query=$conex->query("SELECT IDUSUARIOS, CORREOUSUARIO FROM usuario WHERE CORREOUSUARIO='$id'");
        $row=mysqli_fetch_array($query);
        $count = mysqli_num_rows($query); // if uname/pass correct it returns must be 1 row

        if( $count == 1 ) {
            $passtemp = GenerarID();
            $hashpasstemp =  hash('sha256', $passtemp);
            $emailsend = $row['CORREOUSUARIO'];

            $mail_asunto = "Recuperar contraseña de Resérvelapp";

            $mail_header = "From: soporte@reservelapp.com\r\n";
            $mail_header.= "MIME-Version: 1.0\r\n";
            $mail_header.= "Content-type: text/html; charset=iso-8859-1\r\n";

            $mail_msg=' <html> <head> <title> Recuperar contraseña </title> </head> <body>
                <p>Hola, <strong>'.$emailsend.'</strong>.</p>
                <p>Se ha pedido una recuperación de contraseña a su cuenta: <strong>'.$emailsend.'</strong>.</p>
                Se le notifica que su nueva contraseña temporal con la que deberá iniciar sesión es:<br>
                <strong>'.$passtemp.'</strong><br><br>
                Sugerimos que cambie su contraseña inmediatamente después de iniciar sesión.
                <br><br><br>Gracias.<br><br>Atentamente, Resérvelapp.
            </body> </html> ';

            $query=$conex->query(" UPDATE usuario SET PASSWORDUSUARIO = '$hashpasstemp' WHERE CORREOUSUARIO='$id'; ");

            if ($query) {
                @mail($emailsend, $mail_asunto, $mail_msg, $mail_header);
                $error = false;
            }
            else {
                $error=true;
            }

        }

        else {
            $error = true;
        }
    }
}

?>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery/jquery.min.js"></script>
    <!-- Login script -->
    <script src="js/loginscript.js"></script>

    <!--Feedback slider-->
    <script type="text/javascript">
	function showDiv() {
    	document.getElementById('cd-feedback').style.display = "block";
    	document.getElementById('reset-email').focus();
	}
    </script>
<font size="1" class="container text-center" style="color: #222;">Mateus</font>
</body>
</html>
<?php ob_end_flush(); ?>
