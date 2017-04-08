<?php
	if (session_status() !== PHP_SESSION_ACTIVE){
    	session_start();
	}
	include ("queries.php");
	$query= new operaciones();
	$folio = $_POST['folio'];
	echo "$folio";
?>