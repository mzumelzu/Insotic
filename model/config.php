<?php

class bd{
	function conexion(){
		$cservidor = "localhost";
		$cbd = "insotic";
		$cusuario = "root";
		$cpassword = "";
		if (!mysql_connect ($cservidor,$cusuario,$cpassword)){
			echo "ERROR DE CONEXION A SERVIDOR $cservidor"; die();
		}
		if (!mysql_select_db($cbd)){
			echo "ERROR DE SELECCION DE BASE DE DATOS"; die();
		}
     }
}
?>