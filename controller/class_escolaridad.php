<?php
include_once ('../model/config.php');

class escolaridad{
	/**
	 * 
	 * Funci�n de conexi�n a la base de datos.
	 */ 
	function conectar(){
		$config = new bd();
		$config->conexion();
	}
	/**
	 * 
	 * Funci�n de desconexi�n a la base de datos.
	 */ 
	function desconectar(){	
		mysql_close($this->conectar());
	}
	
	/**
	*
	* Funci�n que genera un elemento select con los registros de nivel de escolaridad de la base de datos
	*/
	function seleccionaEscolaridadCmb(){
		$sql = "select * from insotic_tabla where tipo='ESC' order by valor asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de nivel de escolaridad no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='escolaridad' style='width: 150px'>";
			while ($f = mysql_fetch_object($r)){
				echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	/**
	*
	* Funci�n que genera un elemento select con los registros de nivel de escolaridad de la base de datos y selecciona una opci�n especifica.
	* @param int $id - Id del registro que ser� la opci�n seleccionada por defecto.
	*/
	function seleccionaEscolaridadByIdCmb($id){
		$sql = "select * from insotic_tabla where tipo='ESC' order by valor asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de nivel de escolaridad no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='escolaridad' style='width: 150px'>";
			while ($f = mysql_fetch_object($r)){
				if ($f->id==$id)
					echo "<option value='$f->id' selected>$f->nombre</option>";
				else
					echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	/**
	*
	* Funci�n encargada de crear un nuevo registro de nivel de escolaridad en la base de datos.
	* @param array $a - Arreglo que contiene los datos necesarios para la inserci�n.
	* @return boolean - True si la inserci�n es correcta, false si ocurre un error.
	*/
	function addEscolaridad($a){
		$sql = "INSERT INTO insotic_tabla (
					tipo,
					nombre,
					valor)
				VALUES (
					'ESC',
					'$a[0]',
					'$a[1]')";
		$this->conectar();
		if (mysql_query ($sql)){
			return true;}
		else{
			return false;
		}				
	}
	
	/**
	*
	* Funci�n encargada de eliminar un registro de nivel de escolaridad de la base de datos.
	* @param int $id - Id del registro a eliminar de la base de datos.
	*/
	/*function deleteEscolaridadById($id){
		$sql = "delete from insotic_tabla where id = $id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente el Nivel de Escolaridad')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar el Nivel de Escolaridad.')</script>";
		}
	}*/
	
	/**
	*
	* Funci�n encargada de modificar un registro de nivel de escolaridad de la base de datos.
	* @param int $id - Id del registro a modificar en la base de datos.
	* @param array $a - Arreglo que contiene los datos nuevos para realizar la modificaci�n del registro.
	* @return boolean - True si la modificaci�n es exitosa, false en caso contrario.
	*/
	function updateEscolaridad($id, $a){
		$sql = "update insotic_tabla set 
					nombre = '$a[1]',
					valor = '$a[2]'
				where id = '$id'";
		$this->conectar();
		if(mysql_query ($sql)){
			return true;
		} 
		else{
			return false;
		}
	}
	
	/**
	*
	* Funci�n que busca y retorna todos los registros de nivel de escolaridad de la base de datos.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos.
	*/
	function getEscolaridad(){
		$sql = "select * from insotic_tabla where tipo='ESC' order by valor asc";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de Nivel de Escolaridad')</script>";
			die();
		} 
		else {
			return $r;
		}
	}
	
	/**
	*
	* Funci�n encargada de buscar un registro especifico de nivel de escolaridad de la base de datos.
	* @param int $id - Id del registro que se desea buscar en la base de datos.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos.
	*/
	function getEscolaridadById($id){
		$sql = "select * from insotic_tabla where id = $id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de Nivel de Escolaridad')</script>";
			die();
		} 
		else {
			return $r;
		}
	}	
}
?>