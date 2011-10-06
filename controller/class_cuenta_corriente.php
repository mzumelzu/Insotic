<?php
include_once ('../model/config.php');
/**
 * 
 * Clase de acceso a los datos de las cuentas de empresas.
 * @author Pablo López.
 *
 */
class CuentaCorriente{
	
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
	 * Función encargada de crear un nuevo registro de Cuenta Corriente en la base de datos.
	 * @param array $a - Arreglo que contiene los datos necesarios para la inserción.
	 * @return boolean - True si la inserción es correcta, false si ocurre un error.
	 */
	function addCuentaCorriente($a){
		$sql = "INSERT INTO insotic_cuenta_corriente (
					tipo_cuenta_corriente, 
					rut_empresa, 
					tipo_movimiento, 
					monto_movimiento,
					ano_movimiento,
					fecha_movimiento,					
					numero_aporte_empresa)
				VALUES(
					'$a[0]',
					'$a[1]',
					'$a[2]',
					$a[3],
					$a[4],
					'$a[5]',
					$a[6]);";
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
	 * Función encargada de modificar un registro de cuenta corriente de la base de datos.
	 * @param int $a - Arreglo que contiene los datos que se usarán para realizar la modificacion.
	 * @return boolean - True si la modificación es exitosa, false en caso contrario.
	 */
	function updateCuentaCorriente($a){
		$sql = "UPDATE insotic_cuenta_corriente SET
					tipo_cuenta_corriente = '$a[0]',
					rut_empresa = '$a[1]', 
					tipo_movimiento = '$a[2]', 
					monto_movimiento = $a[3],
					ano_movimiento = $a[4],
					fecha_movimiento = '$a[5]',					
					numero_aporte_empresa = $a[6] 
				WHERE id_cuenta_corriente = $a[7]";
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
	* Función encargada de buscar un registro especifico de cuenta corriente segun una combinacion de año, tipo de cuenta y empresa.
	* @param int $a - Arreglo que contiene los datos que se usarán para realizar la consulta.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos. En caso de error retorna false.
	*/
	function getCuentasCorrientes($a){
		$sql = "SELECT * FROM insotic_cuenta_corriente WHERE 
				tipo_cuenta_corriente = '$a[0]' AND
				rut_empresa = '$a[1]' AND 
				tipo_movimiento = '$a[2]' AND 
				ano_movimiento = $a[4]";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			return false;
		}
		else {
			return $r;
		}
	}
	
	/**
	*
	* Función encargada de buscar un registro especifico de cuenta corriente segun una combinacion de año, tipo de cuenta,
	* tipo de movimiento, empresa y numero de aporte de empresa.
	* @param Array $a - Arreglo que contiene los datos que se usarán para realizar la consulta.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos. En caso de error retorna false.
	*/
	function getCuentaCorrienteUpdate($a){
		$sql = "SELECT monto_movimiento, id_cuenta_corriente FROM insotic_cuenta_corriente WHERE
					tipo_cuenta_corriente = '$a[0]' AND
					rut_empresa = '$a[1]' AND 
					tipo_movimiento = '$a[2]' AND 
					ano_movimiento = $a[4] AND 
					numero_aporte_empresa = $a[6]";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			return false;
		}
		else {
			return $r;
		}
	}
	
	/**
	 * 
	 * Función encargada de eliminar las cuentas de en un año y de un tipo de movimiento especifico.
	 * @param Array $a - Arreglo que contiene los datos necesarios para la eliminacion.
	 * @return boolean - True si la eliminacion es correcta, false si no se elimina ningun registro u ocurre un error.
	 */
	function eliminarTodoByAnio($a){
		$sql = "DELETE FROM insotic_cuenta_corriente 
				WHERE ano_movimiento='$a[1]' AND 
				tipo_movimiento='$a[2]'";
		$this->conectar();
		mysql_query ($sql);
		if (mysql_affected_rows()==-1) {
			return false;
		}
		else {
			return true;
		}		
	}
	
}