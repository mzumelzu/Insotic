<?php
include_once ('../model/config.php');
class Curso
{
//Metodo de conexión a base de datos
	function conectar()
	{
		$config = new bd();
		$config->conexion();
	}
	function getCursoById($id)
	{
		$sql = "select * from insotic_curso where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de ciudades')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	function getCursoByCod($cod)
	{
		$sql = "select id from insotic_curso where codigo='$cod'";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de curso')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}	
	
}
?>