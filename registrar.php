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

	if ( isset($_POST['btnsignup']) ) {
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		//
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		//
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		//
		$phone = trim($_POST['phone']);
		$phone = strip_tags($phone);
		$phone = htmlspecialchars($phone);
		//random
		$count = 1;
		while ($count!=0) {
			$chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   			$randomString = '';
    		for ($i = 0; $i < 6; $i++) {
        		$randomString .= $chars[rand(0, strlen($chars) - 1)];
    		}
    		//id verification
			$query = $conex->query("SELECT IDUSUARIOS FROM usuario WHERE IDUSUARIOS='$randomString'");
			$count = mysqli_num_rows($query);
		}
		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Ingrese su nombre completo.";
		} else if (strlen($name) < 2) {
			$error = true;
			$nameError = "El nombre debe tener al menos 2 caracteres.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Los nombres pueden tener letras y espacios.";
		}
		// basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Ingrese una dirección de correo electrónico válida.";
		} else {
			// check email exist or not
			$query = $conex->query("SELECT CORREOUSUARIO FROM usuario WHERE CORREOUSUARIO='$email'");
			$count = mysqli_num_rows($query);
			if($count!=0){
				$error = true;
				$emailError = "Este correo ya está registrado.";
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Ingrese una contraseña.";
		} else if(strlen($pass) < 8) {
			$error = true;
			$passError = "La contraseña debe tener mínimo 8 caracteres.";
		}
		// phone validation
		if (strlen($phone) < 10) {
			$error = true;
			$phoneError = "El número telefónico tiene diez caracteres.";
		} else if (strlen($phone) > 10) {
			$error = true;
			$phoneError = "El número telefónico tiene diez caracteres.";
		} else if (preg_match("/^[a-zA-Z ]+$/",$phone)) {
      		$error = true;
     		$phoneError = "El número telefónico tiene solo números.";
 		}
		//terms validation
		if (empty($_POST['acceptterms'])) {
			$error = true;
			$termsError = "Acepte los términos y condiciones.";
		}
		//set admin role
		$rol=1;
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		// if there's no error, continue to signup
		if( !$error ) {
			$query = $conex->query("INSERT INTO usuario(IDUSUARIOS,NOMBREUSUARIO,CORREOUSUARIO,PASSWORDUSUARIO,CELULARUSUARIO,ROL) VALUES('$randomString','$name','$email','$password','$phone','$rol')");
			//register if it all ok
			if ($query) {
				$errTyp = "success";
				$errMSG = "Registrado satisfactoriamente. Revise su correo electrónico para verificar su cuenta.
				Su ID es $randomString";
				unset($name);
				unset($email);
				unset($pass);
				unset($phone);
			} else {
				$errTyp = "danger";
				$errMSG = "Algo salió mal. Intente más tarde.";	
			}	
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
    <title>Registrar</title>
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
              <a class="nav-link js-scroll-trigger" href="login.php">INICIAR</a>
            </li>
          </ul>
      </div>
    </nav>
    <!-- login form -->
<header class="masthead">
<div class="cd-user-modal-login">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    	<div class="col-md-12">
        	<div class="form-group">
            	<h1 class="">REGISTRARSE</h1>
                <h5>como ADMINISTRADOR</h5>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
			?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
            <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Nombre" maxlength="125" value="" />
                </div>
                <?php
                if ( isset($nameError) ) { 
                ?>
                <div class="alert alert-danger">
                <span class="text-danger">
                    <?php echo $nameError; ?>
                </span>
                </div>
                <?php
                }
                ?>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Correo electrónico" maxlength="150" value="" />
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
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" name="phone" class="form-control" placeholder="Teléfono" maxlength="10" value="" />
                </div>
                <?php
                if ( isset($phoneError) ) { 
                ?>
                <div class="alert alert-danger">
                <span class="text-danger">
                    <?php echo $phoneError; ?>
                </span>
                </div>
                <?php
                }
                ?>
            </div>
            
            <div class="form-group" align="left">
            	<input type="checkbox" name="acceptterms">	Acepto <a href="#">Términos y Condiciones</a> para registrarme como <b>ADMINISTRADOR</b>
            	<?php
                if ( isset($termsError) ) { 
                ?>
                <div class="alert alert-danger">
                <span class="text-danger">
                    <?php echo $termsError; ?>
                </span>
                </div>
                <?php
                }
                ?>
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btnsignup">REGISTRAR</button>
            </div>
            
            <div class="form-group">
            	<a href="login.php"><h5>INICIE SESIÓN AQUÍ.</h5><br></a>
            </div>
            
            <div class="form-group">
            </div>
        
        </div>
    </form>
    </div>	
</div>
</header>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery/jquery.min.js"></script>
    <!-- Login script -->
    <script src="js/loginscript.js"></script>
<font size="1" class="container text-center" style="color: #222;">Mateus</font>
</body>
</html>
<?php ob_end_flush(); ?>