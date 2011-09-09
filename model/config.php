<?php

class bd{
	function conexion(){
		$cservidor = "insotic.insotec.cl";
		$cbd = "insotic";
		$cusuario = "insotic";
		$cpassword = "insotec2011";
		if (!mysql_connect ($cservidor,$cusuario,$cpassword)){
			echo "ERROR DE CONEXION A SERVIDOR $cservidor"; die();
		}
		if (!mysql_select_db($cbd)){
			echo "ERROR DE SELECCION DE BASE DE DATOS"; die();
		}
     }
}
?>