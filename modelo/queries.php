<?php
	if (session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	include("conexion.php");
	class operaciones{	
		/*Variables Globales*/
		var $conecta;
		
		/*Contructor*/
		public function operaciones(){
			$this->conecta=null;
			$this->conecta=new Conectar();
		}
		
		/*Función que sirve para ejecutar los result*/
		function results($sql){ 
			$this->conecta->abrir();
			@$query=pg_query($this->conecta->pgconexion,$sql)or die("<script>alert('Operación inválida'); </script>");
			$this->conecta->cerrar();
			return $query;
		}

		function siguiente_usuario(){
			$sql="SELECT MAX(id_usuario)";
	    	$sql.=" FROM usuario";
			$result= $this->results($sql);
			$row=pg_fetch_array($result);
			$periodo=$row['max'];
			return $periodo+1;
		}

		function obtiene_departamentos(){
			$sql = "SELECT * FROM departamento";
			$result = $this->results($sql);
			while ($row=pg_fetch_array($result)) {
				echo "<option value='".$row['id_departamento']."'>".$row['nombre']."</option>";
			}
		}
	}
?>