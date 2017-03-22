<?php
	if (session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	class Conectar{
		var $pgconexion;
		public function Conectar(){
			$this->pgconexion=null;
		}
		function abrir(){
			$this->pgconexion=pg_connect("host=localhost port=5432 dbname=correspondencia user=postgres password=root");
		}
		function cerrar(){
			if(pg_connection_status($this->pgconexion)==PGSQL_CONNECTION_OK)
				pg_close($this->pgconexion);
		}
	}
?>