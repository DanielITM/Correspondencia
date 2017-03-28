<?php
  if (session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
  if(!(isset($_SESSION['sesioncorresp']))){
  	echo '<script>window.location="index.php";</script>';
  }
  else if($_SESSION['sesioncorresp'][1]!='t'){
	echo '<script>window.location="index.php";</script>';
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Administrador | SiFinancia</title>
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="shortcut icon" href="img/favicon.png">
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
  <script src="js/index.js"></script> 
</head>
<body>
<!-- En el div top solamente se muestra la cabecera de la pagina-->
<div id="top">
		<?php include 'header.php';?>
	</div>	
<!-- En el div menu-principal se carga la barra de navegacion-->
	<div id="menu-principal">
		<?php include 'menu_admin.php';?>
	</div>
	<div id="principal" >
	<!-- En el div principal se carga el contenido de la pagina -->
		<?php include 'bienvenida.php';?>
	</div>
	<!-- En el div bottom se carga el pie de la pagina -->
	<div id="bottom" >
		<?php include 'footer.php';?>
	</div>
</body>
</html>