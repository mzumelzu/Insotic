<?php
include_once ('../model/config.php');

class acceso{
	
	function conectar(){
		$config = new bd();
		$config->conexion();
	}

	//$array[0] = id
	//$array[1] = nombre
	//$array[2] = sigla
	

	function valida_usuario($u, $p){
		$sql = "select * from insotic_usuario where usuario='$u' and clave='$p'";
		$this->conectar();
		if ($r= mysql_query ($sql)){
			if (mysql_num_rows($r)==1){
				return true;
			}
			else {
				return false;
			}
			}
		else{
			return false;
		}	
	}
	
}
	
?>