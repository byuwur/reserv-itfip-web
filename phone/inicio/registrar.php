<?php
	ob_start();
	session_start();
	require_once 'conectar_bd.php';

	$error=false;
	$success=false;
	$mensaje="";

	if (( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['phone']) ) || isset($_POST['ciudad'])) {
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
		//ciudad validation
		if (!empty($_POST['ciudad'])){
			$ciudad = trim($_POST['ciudad']);
			$ciudad = strip_tags($ciudad);
			$ciudad = htmlspecialchars($ciudad);
		}
		//random unique 6 char id
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
			$mensaje = "Ingrese su nombre completo.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		} else if (strlen($name) < 2) {
			$error = true;
			$mensaje = "Al menos dos caracteres en su nombre.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		} /*else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$mensaje = "El nombre puede tener letras y espacios.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		}*/
		// basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$mensaje = "Ingrese una dirección de correo electrónico válida.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		} else {
			// check email exist or not
			$query = $conex->query("SELECT CORREOUSUARIO FROM usuario WHERE CORREOUSUARIO='$email'");
			$count = mysqli_num_rows($query);
			if($count!=0){
				$error = true;
				$mensaje = "Este correo electrónico ya está registrado.";
				$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
				$response[]=$res;
				echo json_encode($response);
				exit;
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$mensaje = "Ingrese una contraseña.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		} else if(strlen($pass) < 8) {
			$error = true;
			$mensaje = "La contraseña debe tener mínimo 8 caracteres.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		}
		// phone validation
		if (strlen($phone) < 10) {
			$error = true;
			$mensaje = "El número telefónico tiene 10 caracteres.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		} else if (strlen($phone) > 10) {
			$error = true;
			$mensaje = "El número telefónico tiene 10 caracteres.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
		} else if (preg_match("/^[a-zA-Z ]+$/",$phone)) {
      		$error = true;
			$mensaje = "El número telefónico tiene únicamente números.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			$response[]=$res;
			echo json_encode($response);
			exit;
 		}
 		//set reserver role
		$rol=2;
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		// if there's no error, continue to signup
		if( !$error ) {
			//ciudad validation
 			if (!empty($_POST['ciudad'])) {
				$query = $conex->query("INSERT INTO usuario(IDUSUARIOS,NOMBREUSUARIO,CORREOUSUARIO,PASSWORDUSUARIO,CELULARUSUARIO,ROL,ciudad_IDCIUDAD) VALUES('$randomString','$name','$email','$password','$phone','$rol','$ciudad')");
 			}
			else{
				$query = $conex->query("INSERT INTO usuario(IDUSUARIOS,NOMBREUSUARIO,CORREOUSUARIO,PASSWORDUSUARIO,CELULARUSUARIO,ROL) VALUES('$randomString','$name','$email','$password','$phone','$rol')");
			}
			//register if it's all ok
			if ($query) {
				$error = false;
				$success = true;
				if(!empty($_POST['ciudad'])){
					$mensaje = "Registrado satisfactoriamente. Revise su correo electrónico para verificar su cuenta.\n\nSu ID es $randomString";
				}
				else{
					$mensaje = "Registrado satisfactoriamente. Revise su correo electrónico para verificar su cuenta.\n\nSu ID es $randomString\n\nConsidere modificar su ciudad para presentarle canchas cercanas.";
				}
				$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
				$response[]=$res;
				echo json_encode($response);
				exit;
			}
			else {
				$error=true;
	            $mensaje = "Algo salió mal. Intente más tarde.";
	            $res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
	            $response[]=$res;
				echo json_encode($response);
				exit;
			}	
		}
	}
	else {  
		$error=true;
		$mensaje = "Ingrese datos.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
		$response[]=$res;
		echo json_encode($response);
		exit;
	}
?>