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
	
	
	//Se busca el nombre de empresa.
	if( $_GET["accion"]=="buscarEmpresa" ){
		$nombreEmpresa = getNombreEmpresa($_GET["rut"]);		
		echo $nombreEmpresa;
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
			if( $aporteEmpresa->addAporteEmpresa($datos) )
				echo "true";
			else
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
			if( $aporteEmpresa->updateAporteEmpresaByRecibo($datos) )
				echo "true";
			else
				echo "false";
		}else{
			echo "error";
		}
	}
	
	//Se buscan los datos de aporte de empresa a partir del numero de recibo.
	if( $_GET["accion"]=="buscarAporte" ){
		//Se crea un objeto controlador de aporte de empresa para hacer las consultas a la base de datos.
		$aporteEmpresa = new AporteEmpresa();
		
		//Se obtiene el numero de recibo.
		$nroRecibo = $_GET["recibo"];
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
	
?>
