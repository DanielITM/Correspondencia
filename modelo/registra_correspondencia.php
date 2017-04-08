<?php
	if (session_status() !== PHP_SESSION_ACTIVE){
    	session_start();
	}
	include ("queries.php");
	$query= new operaciones();
	$folio= $_POST['Num_folio'];
	$oficio = $_POST['Num_oficio'];
	$dependencia = $_POST['depend'];
	$nom_remitente = $_POST['nom_remitente'];
	$cargo_remitente = $_POST['cargo_remit'];
	$fecha= $_POST['date'];
	$asunto = $_POST['asunt'];
	$departamento = $_POST['depto'];
	$nom_encargado = $_POST['nom_encargado'];
	$segui_dirgen = $_POST['segui_dir'];
	$segui_depto = $_POST['segui_depto'];
	$observaciones = $_POST['observa'];
	$estatus = $_POST['status'];
	$sql="insert into correspondencia values ($folio, '$fecha', upper('$asunto'), upper('$segui_dirgen'), upper('$segui_depto'), $estatus, upper('$oficio'), upper('$observaciones'), $departamento, upper('$nom_remitente'), upper('$cargo_remitente'), '$nom_encargado', upper('$dependencia'));";
	$result=$query->results($sql);
	if($result)
		echo "<script>alert('Datos de la correspondencia registrados con éxito');</script>";
	else
		echo "<script>alert('Los datos de la correspondencia no fueron registrados.');</script>"; 
?>