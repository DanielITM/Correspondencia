<?php
	include ("queries.php");
	$query= new operaciones();
    $consulta = "SELECT MAX(id_correspondencia) FROM correspondencia";
	$result = $query->results($consulta);
	$rows = pg_fetch_array($result);
	$siguiente_id = $rows['max'];
    echo $siguiente_id+1;
?>