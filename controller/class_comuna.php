<?php
include_once ('../model/config.php');

class comunas{
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

	function seleccionaComunasCmb(){
		$sql = "select * from insotic_comuna order by nombre asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de comunas no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='comuna'>";
			while ($f = mysql_fetch_object($r)){
				echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	
	function seleccionaComunasByIdCmb($id){
		$sql = "select * from insotic_comuna order by nombre asc"; 
		//echo $sql;
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de comunas no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='comuna'>";
			while ($f = mysql_fetch_object($r)){
				if ($f->id==$id)
					echo "<option value='$f->id' selected>$f->nombre</option>";
				else
					echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	function addComuna($a){
		$sql = "INSERT INTO insotic_comuna (
					nombre ,
					insotic_region_id					
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
	
	function deleteComunaById($id){
		$sql = "delete from insotic_comuna where id=$id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente la comuna seleccionada')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar la comuna seleccionada.')</script>";
		}
	}
	
	function updateComuna($id, $a){
		$sql = "update insotic_comuna set
					nombre =  '$a[1]',
					insotic_region_id = '$a[2]'
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
	
	function getComuna(){
		$sql = "select * from insotic_comuna order by nombre asc";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de comunas')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	
	function getComunaById($id){
		$sql = "select * from insotic_comuna where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de comunas')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}	
	
}


	
	
	
?>