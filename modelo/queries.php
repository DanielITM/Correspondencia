<?php
	if (session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	include("conexion.php");
	if(isset($_REQUEST['folio'])){
		echo "<script>alert('Recibe el folio: '".$_REQUEST['folio']."');</script>";
		$op=new operaciones();
		$op->correspondencia_por_folio($_REQUEST['folio']);
	}
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
			$usuario=$row['max'];
			return $usuario+1;
		}

		function obtiene_departamentos(){
			$sql = "SELECT * FROM departamento";
			$result = $this->results($sql);
			while ($row=pg_fetch_array($result)) {
				echo "<option value='".$row['id_departamento']."'>".$row['nombre']."</option>";
			}
		}

		function correspondencia_por_folio($folio){
			$sql = "SELECT * FROM correspondencia as c";
			$sql.= " INNER JOIN departamento as d ON c.id_departamento = d.id_departamento"; 
			$sql.= " WHERE c.id_correspondencia = $folio";
			$result = $this->results($sql);
			echo "<table class='highlight responsive-table' id='tabla'>";
			echo "<thead>
          			<tr>
              			<th>Folio</th>
              			<th>Documento</th>
              			<th>Dependencia</th>
              			<th style='width: 100px;'>Fecha</th>
              			<th>Asunto</th>
              			<th>Departamento</th>
              			<th>Turnado a</th>
              			<th>Seguimiento Dir. Gen.</th>
              			<th>Seguimiento Depto.</th>
              			<th>Observaciones</th>
              			<th>Estatus</th>
              			<th>Nombre remitente</th>
              			<th>Cargo remitente</th>
              			<th>Modificar</th>
          			</tr>
        		</thead>";
        	echo "<tbody>";
			while ($row = pg_fetch_array($result)) {
				echo "<tr>";
		    		echo "<td>".$row['id_correspondencia']."</td>";
		    		echo "<td>".$row['no_documento']."</td>";
		    		echo "<td>".$row['dependencia']."</td>";
		    		echo "<td>".$row['fecha']."</td>";
		    		echo "<td>".$row['asunto']."</td>";		    			    	
		    		echo "<td>".$row['nombre']."</td>";
		    		echo "<td>".$row['nombre_encargado_depto']."</td>";
		    		echo "<td>".$row['seguimiento_dg']."</td>";
		    		echo "<td>".$row['seguimiento_dp']."</td>";
		    		echo "<td>".$row['observaciones']."</td>";
		    		if ($row['estatus'] == 't') {
		    			echo "<td>Activo</td>";
		    		}else{
		    			echo "<td>Inactivo</td>";
		    		}		    	
		    		echo "<td>".$row['nombre_remitente']."</td>";
		    		echo "<td>".$row['cargo_remitente']."</td>";
		    		echo "<td><button id='btn-modificar' class='btn' value='".$row['id_correspondencia']."' onclick='obtiene_valor_boton()'>Modificar</button></td>";
		    	echo "</tr>";
		}
		echo "<tbody>";
		echo "</table>";
	}

		function obtiene_mes($mes){
			$meses= array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			for ($i=0; $i <12 ; $i++) { 
				if($mes==$i){
					$row=$meses[$i];
				}
			}
			return $row;
		}
	}
?>