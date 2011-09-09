<?php
include_once ('../model/config.php');

class ciudades{
	//Metodo de conexión a base de datos
	function conectar(){
		$config = new bd();
		$config->conexion();
	}

	//Metodo para agregar una empresa, parametro recibod array -> a
	//$array[0] = rut
	//$array[1] = numero_trabajadores
	//$array[2] = nombre
	//$array[3] = direccion
	//$array[4] = numero_direccion
	//$array[5] = nombre_villa_poblacion
	//$array[6] = numero_oficina
	//$array[7] = telefono_1
	//$array[8] = telefono_2
	//$array[9] = fax
	//$array[10] = email
	//$array[11] = insotec_ciudad_id
	//$array[12] = insotic_actividada_economica_id
	//$array[13] = insotic_tipo_direccion_id
	//$array[14] = insotic_comuna_id

	function seleccionaCiudadesCmb(){
		$sql = "select * from insotic_ciudad order by nombre asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de ciudades no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='ciudad'>";
			while ($f = mysql_fetch_object($r)){
				echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	function seleccionaCiudadesByIdCmb($id){
		$sql = "select * from insotic_ciudad order by nombre asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de ciudades no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='ciudad'>";
			while ($f = mysql_fetch_object($r)){
				if ($f->id==$id)
					echo "<option value='$f->id' selected>$f->nombre</option>";
				else
					echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	function addCiudad($a){
		$sql = "INSERT INTO insotic_ciudad (
					nombre ,
					insotic_comuna_id					
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
	
	function deleteCiudadById($id){
		$sql = "delete from insotic_ciudad where id=$id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente la ciudad seleccionada')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar la ciudad seleccionada.')</script>";
		}
	}
	
	function updateCiudad($id, $a){
		$sql = "update insotic_ciudad set
					nombre =  '$a[1]',
					insotic_comuna_id = '$a[2]'
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
	
	function getCiudad(){
		$sql = "select * from insotic_ciudad order by nombre asc";
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
	
	function getCiudadById($id){
		$sql = "select * from insotic_ciudad where id=$id";
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
}
	
	
	
?>