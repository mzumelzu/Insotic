<?php
include_once ('../model/config.php');

class TipoCalle{
	/**
	 * 
	 * Función de conexion a la base de datos.
	 */ 
	function conectar(){
		$config = new bd();
		$config->conexion();
	}
	
	/**
	 * 
	 * Función de desconexion a la base de datos.
	 */ 
	function desconectar(){	
		mysql_close($this->conectar());
	}
	
	/**
	 * 
	 * Función que genera un elemento select con los registros de tipos de calle de la base de datos
	 */
	function seleccionaTipoCalleCmb(){
		$sql = "select * from insotic_tabla where tipo = 'TCA' order by id asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de tipo de calle no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='tipo_calle'>";
			while ($f = mysql_fetch_object($r)){
				echo "<option value='$f->id'>$f->nombre</option>";
            }
			echo "</select>";	
		}		
	}
	
	/**
	 * 
	 * Función que genera un elemento select con los registros de tipos de calle de la base de datos y selecciona una opción especifica.
	 * @param int $id - Id del registro que será la opción seleccionada por defecto.
	 */
	function seleccionaTipoCalleByIdCmb($id){
		$sql = "select * from insotic_tabla where tipo = 'TCA' order by id asc";
		$this->conectar();
		$r = mysql_query($sql);
		if (mysql_num_rows($r)==0) { 
			echo "<script>alert('La consulta de tipo de calle no tiene resultados')</script>"; die();
		}
		else {
			echo "<select name='tipo_calle'>";
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
	* Función encargada de crear un nuevo registro de tipo de calle en la base de datos.
	* @param array $a - Arreglo que contiene los datos necesarios para la inserción.
	* @return boolean - True si la inserción es correcta, false si ocurre un error.
	*/
	function addTipoCalle($a){
		$sql = "INSERT INTO insotic_tabla (
					tipo,
					nombre,
					valor)	
				VALUES (
					'TCA',
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
	* Función encargada de eliminar un registro de tipo de calle de la base de datos.
	* @param int $id - Id del registro a eliminar de la base de datos.
	*/
	/*function deleteTipoCalleById($id){
		$sql = "delete from insotic_tabla where id=$id";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente el tipo de calle')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar el tipo de calle')</script>";
		}
	}*/
	
	/**
	*
	* Función encargada de modificar un registro de tipo de calle de la base de datos.
	* @param int $id - Id del registro a modificar en la base de datos.
	* @param array $a - Arreglo que contiene los datos nuevos para realizar la modificación del registro.
	* @return boolean - True si la modificación es exitosa, false en caso contrario.
	*/
	function updateTipoCalle($id, $a){
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
	* Función que busca y retorna todos los registros de tipo de calle de la base de datos.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos.
	*/
	function getTipoCalle(){
		$sql = "select * from insotic_tabla where tipo='TCA' order by valor asc ";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de tipo de calle.')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	
	/**
	*
	* Función encargada de buscar un registro especifico de tipo de calle de la base de datos.
	* @param int $id - Id del registro que se desea buscar en la base de datos.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos.
	*/
	function getTipoCalleById($id){
		$sql = "select * from insotic_tabla where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de tipo de calle')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
}
?>