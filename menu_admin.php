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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<script type="text/javascript">
	$(document).ready(function() {
		//Disparadores de activación para componentes de navbar
		$(".button-collapse").sideNav();
		$(".dropdown-button").dropdown();
		//Muestra formulario de registro desde menú navbar
		$("#new_user").click(function(event) {
			$("#principal").load('vista/administrador/registro_usuarios.php');
		});
		//Muestra formulario de registro desde menú navbar responsivo
		$("#new_user_resp").click(function(event) {
			$("#principal").load('vista/administrador/registro_usuarios.php');
		});
    });
</script>
</head>
<body>
<!-- Estructura para dropdown -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="#!" id="new_corresp">Agregar correspondencia</a></li>
  <li class="divider"></li>
  <li><a href="#!">Consulta</a></li>
  <li class="divider"></li>
</ul>
<!-- Estructura para dropdown responsivo -->
<ul id="dropdown2" class="dropdown-content">
  <li><a href="#!" id="new_corresp">Agregar correspondencia</a></li>
  <li class="divider"></li>
  <li><a href="#!">Consulta</a></li>
  <li class="divider"></li>
</ul>
<!-- Estructura Navbar -->
    <nav style="background-color: #29BDBE">
      <div class="nav-wrapper">
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="#" id="new_user">Registrar usuario</a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Correspondencia<i class="material-icons right">arrow_drop_down</i></a></li>
          <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
        <!-- Estructura para navbar responsiva -->
        <ul class="side-nav" id="mobile-demo">
          <li><a href="#" id="new_user_resp">Registrar usuario</a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Correspondencia<i class="material-icons right">arrow_drop_down</i></a></li>
          <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </nav>
</body>