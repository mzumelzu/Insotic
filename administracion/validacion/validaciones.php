<?php
/**
* Funcion encargada de validar si un texto está vacio o no.
* Fecha de Creacion: 06/08/2011
* @author Pablo López M.
* @param string $valor - Cadena de texto a validar.
* @return boolean - True si la cadena de texto está vacia, en caso contrario retorna false.
*/
function estaVacio($valor){
    $regex = "/^\s*$/";
    if( preg_match($regex, $valor) ){
        return true;
    }
    return false;
}

//Valida E-mail
//@author Sebastian Ansieta
//Fecha de modificación 10/08/2011
//Modificado por Nicolás Palma Silva
function validarMail($e_mail)
{
	$cad = "^[A-Za-z0-9._-]+[A-Za-z0-9._-]*[@]{1}[A-Za-z0-9._-]+[A-Za-z0-9._-]*[.]{1}[A-Za-z]^";
	if(preg_match($cad, $e_mail))
	return false;
	return true;
}

// Validadores RUT, COMUNA, TELÉFONOS
// @author Nicolás Palma Silva
// Fecha de creación: 08/08/2011
// Valida rut
//
function mod11($r, $b){
	$s=1;
	//Las siguientes líneas calculan el dígito verificador
	for($m=0;$r!=0;$r/=10)
	$s=($s+$r%10*(9-$m++%6))%11;
	// Como $s=1, entonces se suma un dígito, por lo tanto hay que restarlo para obtener el resultado.
	$j = $s-1;
	// Verifica si $j es resto -1 (que sería rut guión 10, el cuál es equivalente a guión k)
	// De ser erróneo, retorna boolean true, de lo contrario, da false.
	if($j=="-1"){
		$j="k";
		if($j!=$b){
			return true;
		}
	}else
	if($j!=$b){
		return true;
	}else
	return false;
}

/**
 * Funcion encargada de validar un rut. 
 * Nota: ***La funcion mod11 no me funcionó, por lo cual hice esta, que no es definitiva hasta comprobar bien lo de mod11.***
 * Fecha de Creacion: 20/08/2011
 * @author Pablo López M.
 * @param String $rut - Cadena de texto a validar.
 * @return Boolean - True si el rut es válido, en caso contrario false.
 */
function validarRut($rut){
	//Se limpia el rut.
	$rut = str_replace(".", "", $rut);
	$rut = str_replace("-", "", $rut);
	
	//Se separa el rut del digito verificador.
	$suma=0;
	$caracterFinal = substr($rut, -1);
	$numero = substr($rut, 0, -1);
	
	//Algorimo para determinar el digito verifidor a partir de solo el rut (sin dv).
	for($i=2, $aux; $numero > 0; $i++){
		if( $i==8 ){
			$i=2;
		}
		$aux = $numero%10;
		$suma += $aux*$i;
		$numero=floor($numero/10);
	}
	
	$digitoVerificador = 11 - ($suma%11);
	$rutValido = false;
	
	//Se compara el digito verificador calculado con el que ya venia en el rut.
	if( $digitoVerificador==10 && ($caracterFinal=="k" || $caracterFinal=="K") )
	$rutValido = true;
	
	if( $digitoVerificador==11 && $caracterFinal==0 )
	$rutValido = true;
	 
	if( $digitoVerificador==$caracterFinal )
	$rutValido = true;
	
	return $rutValido;
}

//Valida comuna
function validarComuna($com){
	if($com=="0")
	return true;
	else
	return false;
}

// Valida teléfonos
function validarTelefono($tel){
	$cad = "^[0-9]{7,12}^";
	if(preg_match($cad, $tel))
	return false;
	return true;
}

/**
* Funcion que valida solo el ingreso de valores numericos por teclado.
* @param (event) e - texto o valor numerico a verificar.
* @return (Boolean) - True si es numerico, en caso contrario False. 
*/
function validar_numeric($e){
    $tecla = (document.all) ? $e.keyCode : $e.which;
    if ($tecla==8) 
		return true;
    $patron = "/[1234567890]/";
    $te = String.fromCharCode($tecla);
    return patron.test($te);
}