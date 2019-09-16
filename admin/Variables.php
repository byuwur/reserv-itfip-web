<?php 
//session_start();
$IdUsuario = $_SESSION['user'];
$Sql=$conex->query("SELECT NOMBREUSUARIO, CORREOUSUARIO, CELULARUSUARIO FROM usuario WHERE IDUSUARIOS='$IdUsuario'");
$res=mysqli_fetch_assoc($Sql);
$Nombre = $res['NOMBREUSUARIO'];
$Email = $res['CORREOUSUARIO'];
$Celular = $res['CELULARUSUARIO'];
?>