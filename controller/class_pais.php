<?php
include_once ('../model/config.php');

class pais{
	
	function conectar(){
		$config = new bd();
		$config->conexion();
	}

	//$array[0] = id
	//$array[1] = nombre
	//$array[2] = sigla
	

	function addPais($a){
		$sql = "INSERT INTO insotic_pais (
					nombre ,
					sigla 
					
					)
					VALUES (
					'$a[1]', '$a[2]' )	";
		$this->conectar();
		if (mysql_query ($sql)){
			return true;}
		else{
			return false;
		}				
	}
	
	function getPaises(){
		$sql = "select * from insotic_pais order by nombre asc";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de paises')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	
	function getPaisById($id){
		$sql = "select * from insotic_pais where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de paises')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}	
	
	function deletePaisById($id){
		$sql = "delete from insotic_pais where id=$id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente el pais seleccionado')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar el pais seleccionado.')</script>";
		}
	}
	
	function updatePais($id, $a){
		$sql = "update insotic_pais set
					nombre =  '$a[1]',
					sigla =  '$a[2]'
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
	
	function seleccionaPaisCmb(){
		$sql = "select * from insotic_pais order by id asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de Paises no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='pais' style='width:206px'>";
			while ($f = mysql_fetch_object($r)){
				echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	function seleccionaPaisByIdCmb($id){
		$sql = "select * from insotic_pais order by id asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de Paises no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='pais' style='width:206px'>";
			while ($f = mysql_fetch_object($r)){
				if ($f->id==$id)
					echo "<option value='$f->id' selected>$f->nombre</option>";
				else
					echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
}
	
?>