<?php
include_once ('../model/config.php');
/**
 * 
 * Clase de acceso a los datos de los aportes de empresa.
 * @author Pablo López.
 *
 */
class AporteEmpresa{
	
	/**
	*
	* Función de conexión a la base de datos.
	*/
	function conectar(){
		$config = new bd();
		$config->conexion();
	}
	/**
	 *
	 * Función de desconexión a la base de datos.
	 */
	function desconectar(){
		mysql_close($this->conectar());
	}
	
	/**
	 *
	 * Función encargada de crear un nuevo registro de aporte de empresa en la base de datos.
	 * @param array $a - Arreglo que contiene los datos necesarios para la inserción.
	 * @return boolean - True si la inserción es correcta, false si ocurre un error.
	 */
	function addAporteEmpresa($a){
		$sql = "INSERT INTO insotic_aporte (
					rut_empresa, 
					fecha, 
					recibo, 
					monto_capacitacion, 
					monto_reparto,
					monto_administracion,
					monto_certificacion,					
					monto_total_aporte,
					tipo_medio,
					tipo_medio_numero)
				VALUES(
					'".$a[0].$a[1]."',
					'$a[2]',
					$a[3],
					$a[4],
					$a[5],
					$a[6],
					$a[7],
					$a[8],
					$a[9],
					'$a[10]');";
		$this->conectar();
		if (mysql_query ($sql)){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 *
	 * Función encargada de modificar un registro de aporte de empresa de la base de datos.
	 * @param int $id - Id del registro a modificar en la base de datos.
	 * @param array $a - Arreglo que contiene los datos nuevos para realizar la modificación del registro.
	 * @return boolean - True si la modificación es exitosa, false en caso contrario.
	 */
	function updateAporteEmpresaByRecibo($a){
		$sql = "UPDATE insotic_aporte SET
					rut_empresa='".$a[0].$a[1]."',
					fecha='$a[2]',
					monto_capacitacion=$a[4],
					monto_reparto=$a[5],
					monto_administracion=$a[6],
					monto_certificacion=$a[7],
					monto_total_aporte='$a[8]',
					tipo_medio=$a[9],
					tipo_medio_numero='$a[10]' 
				WHERE recibo=$a[3]";
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
	* Función encargada de buscar un registro especifico de aporte de empresa de la base de datos por su numero de recibo.
	* @param int $nroRecibo - Numero de recibo del registro que se desea buscar en la base de datos.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos. En caso de error retorna false.
	*/
	function getAporteEmpresaByRecibo($nroRecibo){
		$sql = "SELECT * FROM insotic_aporte WHERE recibo=$nroRecibo";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			return false;
		}
		else {
			return $r;
		}
	}
	
}