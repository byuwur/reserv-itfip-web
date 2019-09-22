<?php
	ob_start();
	session_start();
	require_once 'conectar_bd.php';

	$error=false;
	$sesion=false;
	
	if (isset($_POST['email']) && isset($_POST['pass'])) {	
        // clean user inputs to prevent sql injections
        $email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		//
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		//verify field
		if(empty($email)){
			$error = true;
			$mensaje = "Ingrese su correo electrónico.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'sesion' => $sesion);
			$response[]=$res;
			echo json_encode($response);
			exit;
			//echo json_encode($res);
		}
		//verify field
		if(empty($pass)){
			$error = true;
			$mensaje = "Ingrese su contraseña.";
			$res = array('error' => $error, 'mensaje' => $mensaje, 'sesion' => $sesion);
			$response[]=$res;
			echo json_encode($response);
			exit;
			//echo json_encode($res);
		}
		// if there's no error, continue to login
		if (!$error) {
			$password = hash('sha256', $pass); // password hashing using SHA256
			//PARA VERIFICAR EL CORREO ELECTRÓNICO
			$query=$conex->query("SELECT * FROM usuario WHERE CORREOUSUARIO='$email'");
			$row=mysqli_fetch_array($query);
			$count = mysqli_num_rows($query); // if uname/pass correct it returns must be 1 row

			if( $count == 1 && $row['PASSWORDUSUARIO']==$password ) {
            //SI TODO ES CORRECTO PARA QUE VERIFIQUE QUE INGRESE COMO ADMINISTRADOR PARA EVITAR QUE RESERVISTAS INGRESEN AL ENTORNO DE ADMINISTRADOR
                if ($row['ROL']==1){
                   	$error=true;
	               	$mensaje = "Este usuario es ADMINISTRADOR. Ingrese solo como RESERVISTA. Para ingresar como Administrador, hágalo desde la página web de Resérvelapp.";
	                $res = array('error' => $error, 'mensaje' => $mensaje, 'sesion' => $sesion);
	                $response[]=$res;
					echo json_encode($response);
					exit;
					//echo json_encode($res);
                }
                else{
                   	$_SESSION['user'] = $row['IDUSUARIOS'];
	                   	$mensaje = "Ha ingresado correctamente.";
	                   	$sesion=true;

	                   	$usrid=$row['IDUSUARIOS'];
	                   	$usrname=$row['NOMBREUSUARIO'];
	                   	$usremail=$row['CORREOUSUARIO'];
	                   	$usrcel=$row['CELULARUSUARIO'];
	                   	$usrciudad=$row['ciudad_IDCIUDAD'];
	                   	$usrrol=$row['ROL'];
	                   	$usrpass=$row['PASSWORDUSUARIO'];

						$res = array('error'=>$error,'mensaje'=>$mensaje,'sesion'=>$sesion,'usrid'=>$usrid,'usrname'=>$usrname,'usremail'=>$usremail,'usrciudad'=>$usrciudad,'usrcel'=>$usrcel,'usrrol'=>$usrrol,'usrpass'=>$usrpass);
						$response[]=$res;
						echo json_encode($response);
						exit;
					//echo json_encode($res);
                }
			}
		
			else {
				$password = hash('sha256', $pass);
				//PARA VERIFICAR EL PIN SI NO SE INGRESA EL CORREO
	            $query=$conex->query("SELECT * FROM usuario WHERE IDUSUARIOS='$email'");
				$row=mysqli_fetch_array($query);
				$count = mysqli_num_rows($query); // if uname/pass correct it returns must be 1 row

	            if( $count == 1 && $row['PASSWORDUSUARIO']==$password ) {
	            //SI TODO ES CORRECTO PARA QUE VERIFIQUE QUE INGRESE COMO ADMINISTRADOR PARA EVITAR QUE RESERVISTAS INGRESEN AL ENTORNO DE ADMINISTRADOR
	              	if ($row['ROL']==1){
	              		$error=true;
	                   	$mensaje = "Este usuario es ADMINISTRADOR. Ingrese solo como RESERVISTA. Para ingresar como Administrador, hágalo desde la página web de Resérvelapp.";
	                    $res = array('error' => $error, 'mensaje' => $mensaje, 'sesion' => $sesion);
	                    $response[]=$res;
						echo json_encode($response);
						exit;
						//echo json_encode($res);
	                }
	                else{
	                   	$_SESSION['user'] = $row['IDUSUARIOS'];
	                   	$mensaje = "Ha ingresado correctamente.";
	                   	$sesion=true;

	                   	$usrid=$row['IDUSUARIOS'];
	                   	$usrname=$row['NOMBREUSUARIO'];
	                   	$usremail=$row['CORREOUSUARIO'];
	                   	$usrcel=$row['CELULARUSUARIO'];
	                   	$usrciudad=$row['ciudad_IDCIUDAD'];
	                   	$usrrol=$row['ROL'];
	                   	$usrpass=$row['PASSWORDUSUARIO'];

						$res = array('error'=>$error,'mensaje'=>$mensaje,'sesion'=>$sesion,'usrid'=>$usrid,'usrname'=>$usrname,'usremail'=>$usremail,'usrciudad'=>$usrciudad,'usrcel'=>$usrcel,'usrrol'=>$usrrol,'usrpass'=>$usrpass);
						$response[]=$res;
						echo json_encode($response);
						exit;
						//echo json_encode($res);
	                }
	            }
	            else {
	            	$error=true;
	                $mensaje = "Credenciales incorrectas. Intente de nuevo.";
	                $res = array('error' => $error, 'mensaje' => $mensaje, 'sesion' => $sesion);
	                $response[]=$res;
					echo json_encode($response);
					exit;
					//echo json_encode($res);
	            }
			}
		}	
	}		
	else {  
		$error=true;
		$mensaje = "Ingrese datos.";
		$res = array('error' => $error, 'mensaje' => $mensaje, 'sesion' => $sesion);
		$response[]=$res;
		echo json_encode($response);
		exit;
		//echo json_encode($res);
	}
?>