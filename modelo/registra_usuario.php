<?php
	if (session_status() !== PHP_SESSION_ACTIVE){
    	session_start();
	}
	include ("queries.php");
	$query= new operaciones();
	$usuario= $_POST['usuario'];
	$password = $_POST['password'];
	$tipo = $_POST['tipo'];
	$departamento = $_POST['departamento'];
	//Falta poner el id_departamento////////////////////
	$sql="insert into usuario values (".$query->siguiente_usuario().", '$tipo', '$usuario', '$password', $departamento);";
	$result=$query->results($sql);
	if(!($result))
		echo "<script>alert('Usuario no registrado');</script>";
	else
		echo "<script>alert('Usuario registrado con éxito.');</script>"; 
?>