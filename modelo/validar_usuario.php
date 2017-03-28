<?php
	include ("queries.php");
	$query= new operaciones();
    $nombre = $_POST["nick"];
    $consulta = "select nombre from usuario where nombre = '$nombre'";
	$result = $query->results($consulta);
	$rows = pg_num_rows($result);
    if($rows > 0){
        echo "<b>Usuario no disponible</b>";
    }
    else{
    	echo "<b>Usuario disponible</b>";
    }
?>