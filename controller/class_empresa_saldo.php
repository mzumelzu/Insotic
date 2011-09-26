<?php
include_once ('../model/config.php');
/**
 * 
 * Clase de acceso a los datos de los saldos de empresas.
 * @author Pablo L�pez.
 *
 */
class EmpresaSaldo{
	
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
	 * Funci�n encargada de crear un nuevo registro de saldo de empresa en la base de datos.
	 * @param array $a - Arreglo que contiene los datos necesarios para la inserci�n.
	 * @return boolean - True si la inserci�n es correcta, false si ocurre un error.
	 */
	function addEmpresaSaldo($a){
		$sql = "INSERT INTO insotic_empresa_saldo (
					rut_empresa, 
					year, 
					tipo_cuenta, 
					debe,
					haber)
				VALUES(
					'$a[0]',
					$a[1],
					'$a[2]',
					0,
					0);";
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
	 * Funci�n encargada de actualizar el saldo de una cuenta especifica de empresa de la base de datos.
	 * @param array $a - Arreglo que contiene los datos nuevos para realizar la modificaci�n del registro.
	 * @return boolean - True si la modificaci�n es exitosa, false en caso contrario.
	 */
	function updateSaldo($a){
		$sql = "UPDATE insotic_empresa_saldo SET 
					debe = $a[3],
					haber = $a[4] 
				WHERE rut_empresa = $a[0]
				AND year = $a[1] 
				AND tipo_cuenta = '$a[2]'";
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
	* Funci�n encargada de buscar el saldo (debe y haber) de una empresa segun un a�o, tipo de cuenta y rut de empresa especificos.
	* @param array $a - Arreglo que contiene los datos para realizar consulta.
	* @return resource - Recurso que contiene los datos devueltos por la consulta a la base de datos. En caso de error retorna false.
	*/
	function getSaldoEmpresa($a){
		$sql = "SELECT debe, haber FROM insotic_empresa_saldo 
				WHERE rut_empresa = '$a[0]'
				AND year = $a[1] 
				AND tipo_cuenta = '$a[2]'";
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