<?php

include("conexion.php");
session_start();
include("Variables.php");

if ($IdUsuario != ""){
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $IdUsuario ?> - Sistema de Reservas para Canchas</title>
  <meta charset="utf-8">
  <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile support -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Material Design fonts -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Material Design -->
  <link href="css/bootstrap-material-design.css" rel="stylesheet">
  <link href="css/ripples.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/index.css">  
  <link rel="stylesheet" type="text/css" href="css/index2.css">  
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.min.css">

    <!-- Slider
    ================================================== -->
    <link href="css/owl.carousel.css" rel="stylesheet" media="screen">
    <link href="css/owl.theme.css" rel="stylesheet" media="screen">
    <!-- Stylesheet
    ================================================== -->

    <link rel="stylesheet" type="text/css"  href="css/style.css">
    <!-- Dropdown.js -->
    <link href="css/jquery.dropdown.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/parallax.min.js"></script>
  </head>
  <body>
    <?php
  } else{
    echo "
  <script type='text/javascript'>
    document.location = '../index.php';
  </script>
";
  }
  ?>