<?php
include_once ('../model/config.php');

class region{
	
	function conectar(){
		$config = new bd();
		$config->conexion();
	}

	//$array[0] = id
	//$array[1] = nombre
	//$array[2] = sigla
	

	function addRegion($a){
		$sql = "INSERT INTO insotic_region (
					nombre ,
					sigla,
					insotic_pais_id
					
					)
					VALUES (
					'$a[1]', '$a[2]', '$a[3]' )	";
		$this->conectar();
		if (mysql_query ($sql)){
			return true;}
		else{
			return false;
		}				
	}
	
	function getRegion(){
		$sql = "select REG.id as id, REG.nombre as nombre, REG.sigla as sigla, PAS.nombre as pais from insotic_region REG inner join insotic_pais PAS on REG.insotic_pais_id = PAS.id where REG.insotic_pais_id = PAS.id order by REG.nombre asc";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de regiones')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	
	function getRegionById($id){
		$sql = "select * from insotic_region where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de regiones')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}	
	
	function deleteRegionById($id){
		$sql = "delete from insotic_region where id=$id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente la region seleccionado')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar la region seleccionado.')</script>";
		}
	}
	
	function updateRegion($id, $a){
		$sql = "update insotic_region set
					nombre =  '$a[1]',
					sigla =  '$a[2]',
					insotic_pais_id = '$a[3]'
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
	
	function seleccionaRegionesCmb(){
		$sql = "select * from insotic_region order by nombre asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de regiones no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='region'>";
			while ($f = mysql_fetch_object($r)){
				echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	
	function seleccionaRegionesByIdCmb($id){
		$sql = "select * from insotic_region order by nombre asc"; 
		//echo $sql;
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de regiones no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='region'>";
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