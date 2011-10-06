<?php
	/**
	 * Usado por Aporte de Empresa para poder realizar los cambios y consultas a la base de datos usando ajax (jquery).
	 * Fecha de Creación: 19/08/2011
	 * @author Pablo López M.
	 * 
	 */

	include_once "validacion/validaciones.php";
	include_once '../controller/class_aporte_empresa.php';
	include_once '../controller/class_empresa.php';
	include_once '../controller/class_cuenta_corriente.php';
	include_once '../controller/class_empresa_saldo.php';
	
	
	//Se busca el nombre de empresa.
	if( $_GET["accion"]=="buscarEmpresa" ){
		$nombreEmpresa = getNombreEmpresa($_GET["rut"]);		
		echo $nombreEmpresa;
	}
	
	if( $_POST["accion"]=="regAportes" ){
		if( regenerarCtasCtes() ){
			echo "<br>Restauracion Ctas Ctes Exitosa";
			
			if( regenerarSaldos() )
				echo "<br>Restauracion Saldos Exitosa";
			else
				echo "<br>Restauracion Saldos Fallida";
			
		}else{
			echo "<br>Restauracion Ctas Ctes Fallida";
		}			
	}
	
	if( $_POST["accion"]=="guardar" ){
		$rutEmpresa = $_POST["rutEmpresa"];
		$rutEmpresa = str_replace(".", "", $rutEmpresa);
		$rutEmpresa = str_replace("-", "", $rutEmpresa);
		$datos[0] = $rutEmpresa;
		$datos[1] = $_POST["digitoVerificador"];
		$datos[2] = $_POST["fecha"];
		$datos[3] = $_POST["recibo"];
		$datos[4] = $_POST["ctaCapacitacion"];
		$datos[5] = $_POST["ctaReparto"];
		$datos[6] = $_POST["ctaAdministracion"];
		$datos[7] = $_POST["ctaCertificacion"];
		$datos[8] = $_POST["totalAporte"];
		$datos[9] = $_POST["medio"];
		$datos[10] = $_POST["nroDocumento"];
		
		if( validarDatosAporteEmpresa($datos) ){	
			$aporteEmpresa = new AporteEmpresa();
			if( $aporteEmpresa->addAporteEmpresa($datos) ){
				if( addCuentaCorriente($datos) )
					echo "true";
				else
					echo "false";
			}else
				echo "false";
		}else{
			echo "error";
		}
	}
	
	if( $_POST["accion"]=="modificar" ){
		$rutEmpresa = $_POST["rutEmpresa"];
		$rutEmpresa = str_replace(".", "", $rutEmpresa);
		$rutEmpresa = str_replace("-", "", $rutEmpresa);
		$datos[0] = $rutEmpresa;
		$datos[1] = $_POST["digitoVerificador"];
		$datos[2] = $_POST["fecha"];
		$datos[3] = $_POST["recibo"];
		$datos[4] = $_POST["ctaCapacitacion"];
		$datos[5] = $_POST["ctaReparto"];
		$datos[6] = $_POST["ctaAdministracion"];
		$datos[7] = $_POST["ctaCertificacion"];
		$datos[8] = $_POST["totalAporte"];
		$datos[9] = $_POST["medio"];
		$datos[10] = $_POST["nroDocumento"];
	
		if( validarDatosAporteEmpresa($datos) ){
			$aporteEmpresa = new AporteEmpresa();
			if( $aporteEmpresa->updateAporteEmpresaByRecibo($datos) ){
				if( updateCuentaCorriente($datos) )
					echo "true";
				else
					echo "false";
			}else
				echo "false";
		}else{
			echo "error";
		}
	}
	
	//Se buscan los datos de aporte de empresa a partir del numero de recibo.
	if( $_GET["accion"]=="buscarAporte" ){
		//Se crea un objeto controlador de aporte de empresa para hacer las consultas a la base de datos.
		$aporteEmpresa = new AporteEmpresa();		
		//Se obtiene el numero de recibo y se valida que sea númerico.
		$nroRecibo = $_GET["recibo"];
		if( !is_numeric($nroRecibo) )
			return false;
		//Se valida que se hayan encontrado resultados.		
		if( $rAporteEmpresa = $aporteEmpresa->getAporteEmpresaByRecibo($nroRecibo) ){
			//Se convierte el resultado a un objeto.
			$fila = mysql_fetch_object($rAporteEmpresa);
			//Usando el objeto (resultado consulta) se obtienen los datos del aporte de empresa.
			$rut = $fila->rut_empresa;
			$rutEmpresa = substr($rut, 0, -1);
			$digitoVerificador = substr($rut, -1);
			$fAux = explode("-",$fila->fecha);
			$fecha = $fAux[2]."/".$fAux[1]."/".$fAux[0];
			$medio = $fila->tipo_medio;
			$nroDocumento = $fila->tipo_medio_numero;
			$ctaCapacitacion = $fila->monto_capacitacion;
			$ctaReparto = $fila->monto_reparto;
			$ctaAdministracion = $fila->monto_administracion;
			$ctaCertificacion = $fila->monto_certificacion;
			$totalAporte = $fila->monto_total_aporte;
			$nombreEmpresa = getNombreEmpresa($rut);
			//Se crea un arreglo con los datos obtenidos para poder retornarlos usando JSON.
			$datos = array('recibo'=>$nroRecibo,
				'rutEmpresa'=>$rutEmpresa,
				'digitoVerificador'=>$digitoVerificador,
				'fecha'=>$fecha,
				'medio'=>$medio,
				'nroDocumento'=>$nroDocumento,
				'ctaCapacitacion'=>$ctaCapacitacion,
				'ctaReparto'=>$ctaReparto,
				'ctaAdministracion'=>$ctaAdministracion,
				'ctaCertificacion'=>$ctaCertificacion,
				'totalAporte'=>$totalAporte,
				'nombreEmpresa'=>$nombreEmpresa);
			//Se codifica y retorna los datos usando JSON.
			echo json_encode($datos);
		}
	}
	
	/**
	 * 
	 * Funcion que se encarga de crear los registros de cuentas corrientes para los tipos de cuenta a los que se les ingreso un aporte.
	 * Fecha de Creación: 13/09/2011
	 * @author Pablo López M.
	 * @param Array $datos - Arreglo que contiene los datos ingresados en el aporte de empresa.
	 * @return Boolean - True si las inserciones son correctas, false si ocurre un error.
	 */
	function addCuentaCorriente($datos){
		$cuentaCorriente = new CuentaCorriente();
		
		$a[1] = $datos[0].$datos[1]; //rut empresa
		$a[2] = "D"; //tipo movimiento
		$fAux = explode("/",$datos[2]); 
		$a[4] = $fAux[0]; //año
		$a[5] = $datos[2]; //fecha
		$a[6] = $datos[3]; //recibo
		
		if( $datos[4] > 0 ){
			$a[0] = "01"; //tipo cuenta
			$a[3] = $datos[4]; //monto cta
			if( $cuentaCorriente->addCuentaCorriente($a) )
				$r = addSaldo($a);
		}
		if( $datos[5] > 0 ){
			$a[0] = "02"; //tipo cuenta
			$a[3] = $datos[5]; //monto cta
			if( $cuentaCorriente->addCuentaCorriente($a) )
				$r &= addSaldo($a);
		}
		if( $datos[7] > 0 ){
			$a[0] = "03"; //tipo cuenta
			$a[3] = $datos[7]; //monto cta
			if( $cuentaCorriente->addCuentaCorriente($a) )
				$r &= addSaldo($a);
		}
		
		return $r;
	}
	
	/**
	*
	* Funcion que se encarga de actualizar los registros de cuentas corrientes para los tipos de cuenta a los que se les modificó un aporte.
	* Fecha de Creación: 13/09/2011
	* @author Pablo López M.
	* @param Array $datos - Arreglo que contiene los datos ingresados la modificacion del aporte de empresa.
	* @return Boolean - True si las modificaciones son correctas, false si ocurre un error.
	*/
	function updateCuentaCorriente($datos){
		$cuentaCorriente = new CuentaCorriente();
	
		$a[1] = $datos[0].$datos[1]; //rut empresa
		$a[2] = "D"; //tipo movimiento
		$fAux = explode("/",$datos[2]);
		$a[4] = $fAux[0]; //año
		$a[5] = $datos[2]; //fecha
		$a[6] = $datos[3]; //recibo
		
		if( $datos[4] > 0 ){
			$a[0] = "01"; //tipo cuenta
			$a[3] = $datos[4]; //monto cta
			if( $cta = $cuentaCorriente->getCuentaCorrienteUpdate($a) ){
				$fila = mysql_fetch_object($cta);
				$monto = $fila->monto_movimiento;
				$a[7]  = $fila->id_cuenta_corriente;
				if( $cuentaCorriente->updateCuentaCorriente($a) ){
					$a[3] -= $monto;
					$r = addSaldo($a);
				}					
			}			
		}
		if( $datos[5] > 0 ){
			$a[0] = "02"; //tipo cuenta
			$a[3] = $datos[5]; //monto cta
			if( $cta = $cuentaCorriente->getCuentaCorrienteUpdate($a) ){
				$fila = mysql_fetch_object($cta);
				$monto = $fila->monto_movimiento;
				$a[7]  = $fila->id_cuenta_corriente;
				if( $cuentaCorriente->updateCuentaCorriente($a) ){
					$a[3] -= $monto;
					$r = addSaldo($a);
				}					
			}
		}
		if( $datos[7] > 0 ){
			$a[0] = "03"; //tipo cuenta
			$a[3] = $datos[7]; //monto cta
			if( $cta = $cuentaCorriente->getCuentaCorrienteUpdate($a) ){
				$fila = mysql_fetch_object($cta);
				$monto = $fila->monto_movimiento;
				$a[7]  = $fila->id_cuenta_corriente;
				if( $cuentaCorriente->updateCuentaCorriente($a) ){
					$a[3] -= $monto;
					$r = addSaldo($a);
				}					
			}
		}
	
		return $r;
	}
	
	/**
	 * 
	 * Funcion que actualiza los saldos de las empresas por año y tipo de cuenta, si no existe un registro especifico, 
	 * este se creara con saldo 0 y luego se actualizará.
	 * Fecha de Creación: 13/09/2011
	 * @author Pablo López M.
	 * @param Array $datos - Arreglo que contiene los datos ingresados en el aporte de empresa.
	 * @return Boolean - True si las inserciones son correctas, false si ocurre un error.
	 */
	function addSaldo($a){
		$datosSaldo[0] = $a[1]; //rut empresa
		$datosSaldo[1] = $a[4]; //año
		$datosSaldo[2] = $a[0]; //tipo cuenta
		
		$empresaSaldo = new EmpresaSaldo();
		$saldo = $empresaSaldo->getSaldoEmpresa($datosSaldo);
		if( !$saldo ){
			$datosSaldo[3] = 0;
			$datosSaldo[4] = 0;
			$haber = 0;
			if( !$empresaSaldo->addEmpresaSaldo($datosSaldo) )
				return false;
		}else{
			$fila = mysql_fetch_object($saldo);
			$debe = $fila->debe;
			$haber = $fila->haber;
		}		
		$datosSaldo[3] = $debe + $a[3];
		$datosSaldo[4] = $haber;
		return $empresaSaldo->updateSaldo($datosSaldo);
		
	}
	
	/**
	 * 
	 * Funcion usada para obtener el nombre de empresa a partir de un rut de empresa.
	 * Fecha de Creación: 19/08/2011
	 * @author Pablo López M.
	 * @param String $rutEmpresa - Dato que se usará para hacer la consulta.
	 * @return String - Nombre de la empresa encontrado por la consulta.
	 */
	function getNombreEmpresa($rutEmpresa){
		//Se crea un objeto controlador de empresa para hacer las consultas a la base de datos.
		$empresa = new empresa();
		$rutEmpresa = str_replace(".", "", $rutEmpresa);
		$rutEmpresa = str_replace("-", "", $rutEmpresa);
		//Se realiza la consulta y se guarda el resultado obtenido.
		$rEmpresa = $empresa->getEmpresasByRut($rutEmpresa);
		//Se transforma el resultado a un objeto.
		$fila = mysql_fetch_object($rEmpresa);
		//Se obtiene el nombre.
		$nombreEmpresa = $fila->nombre;
		
		return $nombreEmpresa;
	}
	
	
	/**
	 * 
	 * Función usada para validar los datos del formulario de aporte de empresa.
	 * Fecha de Creación: 19/08/2011
	 * @author Pablo López M.
	 * @param String $datos - Arreglo que contiene los datos a validar.
	 * @return boolean - True si los datos son validos, en caso contrario false.
	 */
	function validarDatosAporteEmpresa($datos){
		$valido = true;
		//Se valida que los campos no esten vacios.
		for($i=0; $i<count($datos); $i++){
			if( estaVacio($datos[$i]) )
				$valido &= false;
	
			//Se valida que los campos recibo, total aporte y todas las cuentas sean numericos.
			if( $i>2 ){
				if( !is_numeric($datos[$i]) )
					$valido &= false;				
			}
		}
		
		
		//Se valida que el rut sea válido.
		//$valido &= mod11($datos[0],$datos[1]); 
		$valido &= validarRut($datos[0].$datos[1]);
	
		//Se valida que la suma de las cuentas coincida con el monto del aporte total.
		if( ($datos[4]+$datos[5]+$datos[6]+$datos[7]) != $datos[8] ){
			$valido &= false;
		}
		
		return $valido;
	}
	
	/**
	 * 
	 * Función encargada de regenerar las cuentas corrientes de empresas en base a los aportes existentes.
	 * Fecha de Creación: 05/09/2011
	 * @author Pablo López M.
	 * @return boolean - True si la regeneracion es correcta, en caso contrario false.
	 */
	function regenerarCtasCtes(){
		$anio = $_POST["anio"];
		
		$ctaCte = new CuentaCorriente();
		$a[1] = $anio;
		$a[2] = 'D';
		$r = $ctaCte->eliminarTodoByAnio($a);
		
		$aporteEmpresa = new AporteEmpresa();
		$aportes = $aporteEmpresa->getAportesEmpresaByAnio($a[1]);
		$saldos[0] = 0;
		$saldos[1] = 0;
		$saldos[2] = 0;
		
		while( $fila = mysql_fetch_object($aportes) ){
			$a[1] = $fila->rut_empresa; //rut_empresa
			$a[2] = "D"; //tipo movimiento
			$a[4] = $anio; //año
			$a[5] = $fila->fecha; //fecha
			$a[6] = $fila->recibo; //recibo
			
			//Cta Capacitiacion
			$a[0] = "01"; //tipo cta
			$a[3] = $fila->monto_capacitacion; //monto
			$saldos[0] += $a[3];		
			$r &= $ctaCte->addCuentaCorriente($a);
			
			//Cta Reparto
			$a[0] = "02"; //tipo cta
			$a[3] = $fila->monto_reparto; //monto	
			$saldos[1] += $a[3];
			$r &= $ctaCte->addCuentaCorriente($a);
			
			//Cta Certificacion
			$a[0] = "03"; //tipo cta
			$a[3] = $fila->monto_certificacion; //monto
			$saldos[2] += $a[3];
			$r &= $ctaCte->addCuentaCorriente($a);
		}
				
		return $r;
	}
	
	/**
	*
	* Función encargada de regenerar los saldos de las cuentas de empresas en base a los aportes existentes.
	* Fecha de Creación: 05/09/2011
	* @author Pablo López M.
	* @return boolean - True si la regeneracion es correcta, en caso contrario false.
	*/
	function regenerarSaldos(){
		$saldoEmpresa = new EmpresaSaldo();
		$aporteEmpresa = new AporteEmpresa();
		$anio = $_POST["anio"];
		
		$r = false;
		$r = $saldoEmpresa->eliminarTodoByAnio($anio);
		
		$datosSaldo[1] = $anio; //año
		$datosSaldo[4] = 0; //haber
		if( $empresas = $aporteEmpresa->getEmpresasByAnio($anio) ){
			while( $fila = mysql_fetch_object($empresas) ){
				$datosSaldo[0] = $fila->rut_empresa; //rut empresa
				$aportes = $aporteEmpresa->getSaldoEmpresaPorAnio($datosSaldo[0], $anio);
				
				if( $saldos = mysql_fetch_object($aportes) ){
					//Cta Capacitiacion
					$datosSaldo[2] = "01"; //tipo cuenta
					$datosSaldo[3] = $saldos->capacitacion; //debe		
					$r &= $saldoEmpresa->addEmpresaSaldo($datosSaldo);
					
					//Cta Reparto
					$datosSaldo[2] = "02"; //tipo cuenta
					$datosSaldo[3] = $saldos->reparto; //debe
					$r &= $saldoEmpresa->addEmpresaSaldo($datosSaldo);
					
					//Cta Certificacion
					$datosSaldo[2] = "03"; //tipo cuenta
					$datosSaldo[3] = $saldos->certificacion; //debe
					$r &= $saldoEmpresa->addEmpresaSaldo($datosSaldo);
				}
			}
		}
		return $r;
	}
	
?>
