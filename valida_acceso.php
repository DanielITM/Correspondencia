<?php
  if (session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	include 'modelo/conexion.php';
	include 'modelo/sesiones.php';
	$sesion= new sesion();
    $conecta = new Conectar();
		/*Función que devuelve el departamento del usuario*/
		function departamento_usuario($nombre){
			$sql="SELECT Id_Departamento FROM Usuario WHERE Nombre = '$nombre'";
			$res=results($sql);
			$row=pg_fetch_row($res);
			$_SESSION['sesioncorresp']=$row[2];
		}
		/*Función que sirve para ejecutar los result*/
		function results($sql){ 
		    $conecta = new Conectar();
			$conecta->abrir();
			@$query=pg_query($conecta->pgconexion,$sql)or die("<script>alert('Operación inválida'); window.history.go(-1); </script>");
			$conecta->cerrar();
			return $query;
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Validando...</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
        $conecta-> abrir();
		if(isset($_POST['btn_login'])){
			$usuario = $_POST['email'];
			$pass = $_POST['password'];
			//Login de Administrador
				$log = pg_query("SELECT * FROM usuario WHERE nombre='$usuario' AND password='$pass'");
				if(pg_num_rows($log)>0){
					$row = pg_fetch_array($log);
					if ($row['tipo']=='t') {
						$sesion-> sesioncorresp($usuario, $row['tipo'],0);
						$conecta->cerrar();
						echo '<script>window.location="principal_administrador.php"</script>';
					}elseif ($row['tipo']=='f') {
						$sesion-> sesioncorresp($usuario, $row['tipo']);
						$conecta->cerrar();
						departamento_usuario($usuario);
						echo '<script>window.location="principal_usuario.php"</script>';
					}
					else{
						echo '<script> alert("Usuario o contraseña incorrectos");</script>';
						$conecta->cerrar();
						echo '<script>window.location="index.php";</script>';
					}
				}
			//No coincide Login con ningun tipo de usuario
			else{
				echo '<script> alert("No se encontró el usuario ingresado");</script>';
				$conecta->cerrar();
				echo '<script>window.location="index.php";</script>';
			}
		}
		$conecta->cerrar();
	?>
</body>
</html>