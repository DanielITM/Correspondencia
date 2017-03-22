<?php
	include('Modelo/sesiones.php');
    $sn=new sesion();
	$sn-> cerrarsesiones();
	echo '<script>window.location="index.php";</script>';
?>