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
	$nombre = $_POST['nombre'];
	$sql="insert into usuario values (".$query->siguiente_usuario().", '$tipo', '$usuario', '$password', $departamento, '$nombre');";
	$result=$query->results($sql);
	if(!($result))
		echo "<script>alert('Usuario no registrado');</script>";
	else
		echo "<script>alert('Usuario registrado con éxito.');</script>"; 
?>