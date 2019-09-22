<?php

include("Encabezado.php");
include("conexion.php");
include("Variables.php");

$IdUsuario = $_GET['Usuario'];

?>
<!DOCTYPE html>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="js/pass.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>

<div class="container">
<div class="row">
<div class="col-sm-12">
<h1 class="text-center">Cambiar contraseña</h1>
</div>
</div>
<br>
<div class="row">
<div class="col-sm-6 col-sm-offset-3">
<p class="text-center">Use el formulario debajo para cambiar su contraseña.<br>Se recomienda que no use su ID o datos similares como contraseña o datos de ella.</p>
<form method="post" id="passwordForm">
<?php
echo "
<input type='hidden' name='Id_Admin' value='$IdUsuario'>
"
?>
<input type="password" class="input-lg form-control" name="password0" id="password0" placeholder="Contraseña actual" maxlength="125" autocomplete="off">
<input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="Contraseña nueva" maxlength="125" autocomplete="off">
<div class="row">
<div class="col-sm-6">
<span id="8char" class="" style="color:#FF0004; size:3;">*Mínimo 8 caracteres</span>
</div>
</div>
<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." name="cambiarpass" style="color:#06C;" value="CAMBIAR CONTRASEÑA">
</form>
</div><!--/col-sm-6-->
</div><!--/row-->
</div>

<?php

if (isset($_POST['cambiarpass'])){

if( isset($_POST['Id_Admin']) && isset($_POST['password0']) && isset($_POST['password1']) ) {

	if (!empty($_POST['Id_Admin'])){
		$id = trim($_POST['Id_Admin']);
		$id = strip_tags($id);
		$id = htmlspecialchars($id);
	}
	if (!empty($_POST['password0'])){
		$passactual = trim($_POST['password0']);
		$passactual = strip_tags($passactual);
		$passactual = htmlspecialchars($passactual);
	}
	if (!empty($_POST['password1'])){
		$passnueva = trim($_POST['password1']);
		$passnueva = strip_tags($passnueva);
		$passnueva = htmlspecialchars($passnueva);
	} 
	if (empty($passactual)) {
		$error = true;
		$success = false;
		$mensaje = "Ingrese su contraseña.";
		echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>$mensaje</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                    <form action='Update_Contra.php' method='GET'>
	                      <input type='hidden' name='Usuario' value='$IdUsuario'>
	                      <input type='submit' style='height:45px;' class='btn btn-info btn-raised' value='Aceptar'>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
		exit;
	} else if (strlen($passactual) < 8) {
		$error = true;
		$success = false;
		$mensaje = "La contraseña tiene al menos 8 caracteres.";
		echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>$mensaje</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                    <form action='Update_Contra.php' method='GET'>
	                      <input type='hidden' name='Usuario' value='$IdUsuario'>
	                      <input type='submit' style='height:45px;' class='btn btn-info btn-raised' value='Aceptar'>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
		exit;
	}
	if (empty($passnueva)) {
		$error = true;
		$success = false;
		$mensaje = "Ingrese su nueva contraseña.";
		echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>$mensaje</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                    <form action='Update_Contra.php' method='GET'>
	                      <input type='hidden' name='Usuario' value='$IdUsuario'>
	                      <input type='submit' style='height:45px;' class='btn btn-info btn-raised' value='Aceptar'>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
		exit;
	} else if (strlen($passnueva) < 8) {
		$error = true;
		$success = false;
		$mensaje = "La nueva contraseña tiene al menos 8 caracteres.";
		echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>$mensaje</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                    <form action='Update_Contra.php' method='GET'>
	                      <input type='hidden' name='Usuario' value='$IdUsuario'>
	                      <input type='submit' style='height:45px;' class='btn btn-info btn-raised' value='Aceptar'>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
		exit;
	}

	$passwordactual = hash('sha256', $passactual);
	$passwordnueva = hash('sha256', $passnueva);

	$queryverifpass = $conex->query(" SELECT NOMBREUSUARIO FROM usuario WHERE IDUSUARIOS = '$id' AND PASSWORDUSUARIO = '$passwordactual' ");
	$count = mysqli_num_rows($queryverifpass);
	if($count!=1){
		$error = true;
		$success = false;
		$mensaje = "Contraseña incorrecta. Intente de nuevo.";
		echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>$mensaje</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                    <form action='Update_Contra.php' method='GET'>
	                      <input type='hidden' name='Usuario' value='$IdUsuario'>
	                      <input type='submit' style='height:45px;' class='btn btn-info btn-raised' value='Aceptar'>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
		exit;
	}
	else {
		$query = $conex->query(" UPDATE usuario SET PASSWORDUSUARIO = '$passwordnueva' WHERE IDUSUARIOS='$id'; ");
	
		if ($query) {
			$error = false;
			$success = true;
			$mensaje = "Registro actualizado. Vuelva a iniciar sesión.";
			echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>$mensaje</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                      <a style='height:45px;' class='btn btn-info btn-raised' href='../logout.php?logout' onclick='reload()' >Aceptar</a>
	                      <script>function reload(){ parent.window.location.reload(true); }</script>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
			exit;
		}
		else {
			$error=true;
			$success = false;
		    $mensaje = "Algo salió mal. Intente más tarde.";
		    echo "
	      <div style='display:block;left:0px;' class='Area_Oscura2'>
	        <div class='container'>
	          <div class='row'>
	            <div class='col-sm-4 col-sm-offset-4'>
	              <div class='well' style='margin-top:55%;'>
	                <h4 align='center'>$mensaje</h4>
	                <div class='row'>
	                  <div class='col-sm-8 col-sm-offset-2'>
	                    <form action='Update_Contra.php' method='GET'>
	                      <input type='hidden' name='Usuario' value='$IdUsuario'>
	                      <input type='submit' style='height:45px;' class='btn btn-info btn-raised' value='Aceptar'>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      ";
			exit;
		}
	}
}

}
?>