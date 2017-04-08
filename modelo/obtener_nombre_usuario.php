<?php
	include ("queries.php");
	$query= new operaciones();
    //Recibe el id_departamento
    $departamento = $_POST["depto"];
    //Realiza la consulta para obtener el nombre completo del encargado actual del depto.
    $consulta = "select nombre_completo from usuario where id_departamento = '$departamento'";
	$result = $query->results($consulta);
	$rows = pg_fetch_array($result);
    //Devuelve el nombre completo
    echo $rows['nombre_completo'];
?>