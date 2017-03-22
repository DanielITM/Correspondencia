<?php
 if (session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }
	include ("queries.php");
	$query= new operaciones();
	@$dependencia= $_POST['depen'];
	$sql="SELECT * FROM departamento WHERE id_dependencia = ".$dependencia;
	$result=$query->results($sql);
		while ($row=pg_fetch_array($result)) {
			echo "<option value='".$row['id_departamento']."'>".$row['nombre']."</option>";
		}
?>