<?php
include_once 'conectar_bd.php';

function GenerarID ($length = 3){
    $cadena="";
    $opc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
    for($i=0; $i<8; $i++){
        $cadena .= substr($opc,rand(0,strlen($opc)),1);
    }
    return $cadena;
}

$error = false;

if( isset($_POST['id']) ) {

	if (!empty($_POST['id'])){
		$id = trim($_POST['id']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if(empty($id)){
			$error = true;
			$mensaje = "Ingrese su ID o correo electrónico.";
			$res = array('error' => $error, 'mensaje' => $mensaje);
			$response[]=$res;
			echo json_encode($response);
			exit;
			//echo json_encode($res);
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
                $success = true;
				$mensaje = "Por favor, espere. Se ha enviado una contraseña temporal a su correo electrónico. (Sugerimos que revise su carpeta de spam). Se le sugiere cambiar la contraseña inmediatamente al iniciar sesión.";
				$res[] = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
				echo json_encode($res);
				exit;
            }
            else {
                $error=true;
				$success = false;
			    $mensaje = "Algo salió mal. Intente más tarde.";
			    $res[] = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
				echo json_encode($res);
				exit;
            }      
			//echo json_encode($res);
		}
		
		else {
			$error=true;
			$success = false;
			$mensaje = "Ingrese el correo electrónico de la cuenta.";
			$res[] = array('error' => $error, 'mensaje' => $mensaje, 'success' => $success);
			echo json_encode($res);
			exit;
		}
	}
}
?>