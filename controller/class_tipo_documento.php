<?php
include_once ('../model/config.php');

class TipoDocumento{
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
	 * Funci�n encargada de crear un nuevo registro de tipo de documento en la base de datos.
	 * @param array $a - Arreglo que contiene los datos necesarios para la inserci�n.
	 * @return boolean - True si la inserci�n es correcta, false si ocurre un error.
	 */
	function addTipoDocumento($a){
		$sql = "INSERT INTO insotic_tabla (
					tipo,	
					nombre,
					valor) 
				VALUES (
					'TDR',
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
	* Funci�n encargada de eliminar un registro de tipo de documento de la base de datos.
	* @param int $id - Id del registro a eliminar de la base de datos.
	*/
	/*function deleteTipoDocumentoById($id){
		$sql = "delete from insotic_tabla where id=$id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente el tipo de documento de respaldo.')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar el tipo documento de respaldo.')</script>";
		}
	}*/
	
	/**
	*
	* Funci�n encargada de modificar un registro de tipo de documento de la base de datos.
	* @param int $id - Id del registro a modificar en la base de datos.
	* @param array $a - Arreglo que contiene los datos nuevos para realizar la modificaci�n del registro.
	* @return boolean - True si la modificaci�n es exitosa, false en caso contrario.
	*/
	function updateTipoDocumento($id, $a){
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
	* Funci�n que busca y retorna todos los registros de tipo de documento de la base de datos.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos.
	*/
	function getTipoDocumento(){
		$sql = "select * from insotic_tabla where tipo='TDR' order by valor asc ";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de tipo de documento.')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	
	/**
	*
	* Funci�n encargada de buscar un registro especifico de tipo de documento de la base de datos.
	* @param int $id - Id del registro que se desea buscar en la base de datos.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos.
	*/
	function getTipoDocumentoById($id){
		$sql = "select * from insotic_tabla where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de tipo de documento.')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
}
	
	
	
?>