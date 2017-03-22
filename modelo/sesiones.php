<?php
	if (session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	class sesion{
		/*Contructor*/
		public function sesion(){
			if(!isset($_SESSION['sesioncorresp'])){
				$_SESSION['sesioncorresp']=null;
			}
		}
		
		/*Sesión SCA*/
		function sesioncorresp($usuario,$tipo,$depto){
			if(isset($usuario)&&isset($tipo)&&isset($depto)){
				$variables[0]=$usuario;
				$variables[1]=$tipo;
				$variables[2]=$depto;
				$_SESSION['sesioncorresp']=$variables;
			}
		}
		
		/*Recursos
		function recursojfsca($area){
			if(isset($area)){
				$_SESSION['recursojfsca'][0]=$area;
			}
		}*/

		/*Cerrar sesión*/
		function cerrarsesiones(){
			session_destroy();
		}
	}	
?>