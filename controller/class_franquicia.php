<?php
include_once ('../model/config.php');

class franquicia{
	//Metodo de conexión a base de datos
	function conectar(){
		$config = new bd();
		$config->conexion();
	}
	//Metodo de desconexión a base de datos
	function desconectar(){	
		mysql_close($this->conectar());
	}
	//Metodo para agregar una empresa, parametro recibod array -> a
	//$array[0] = id
	//$array[1] = nombre

	function seleccionaFranquiciaCmb(){
		$sql = "select * from insotic_tipo_franquicia order by nombre asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de franquicia no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='franquicia' style='width: 150px'>";
			while ($f = mysql_fetch_object($r)){
				echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	function seleccionaFranquiciaByIdCmb($id){
		$sql = "select * from insotic_tipo_franquicia order by nombre asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de franquicia no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='franquicia' style='width: 150px'>";
			while ($f = mysql_fetch_object($r)){
				if ($f->id==$id)
					echo "<option value='$f->id' selected>$f->nombre</option>";
				else
					echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	function addFranquicia($a){
		$sql = "INSERT INTO insotic_tipo_franquicia (
					nombre 				
					)
					VALUES (
					'$a[1]')	";
		$this->conectar();
		if (mysql_query ($sql)){
			return true;}
		else{
			return false;
		}				
	}
	
	function deleteFranquiciaById($id){
		$sql = "delete from insotic_tipo_franquicia where id=$id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente la franquicia')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar la franquicia')</script>";
		}
	}
	
	function updateFranquicia($id, $a){
		$sql = "update insotic_tipo_franquicia set
					nombre =  '$a[1]'
				where  
					id =  $id";
		$this->conectar();
		if(mysql_query ($sql)){
			return true;
			
		} 
		else{
			return false;
	
		}
	}
	
	function getFranquicia(){
		$sql = "select * from insotic_tipo_franquicia order by nombre asc";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de franquicia')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	
	function getFranquiciaById($id){
		$sql = "select * from insotic_tipo_franquicia where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de franquicia')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}	
}
	
	
	
?>