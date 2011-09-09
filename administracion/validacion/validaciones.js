/**
* Función encargada de validar si un texto está vacio o no.
* Fecha de Creacion: 06/08/2011
* @author Pablo López M.
* @param {String} valor - Texto a validar.
* @return {Boolean} - True si la cadena de texto está vacia, en caso contrario retorna false.
*/
function estaVacio(valor){
	var regex = /^\s*$/;
	if( regex.test(valor) ){
		return true;
	}
	return false;
}

/**
 * Función encargada de validar un Rut.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 * @param {String} rut - Cadena de caracteres que corresponden al rut a validar.
 * @returns {Boolean} - True si el rut es válido, en caso contrario retorna false.
 */
function validarRut(rut){
	while( rut.indexOf(".") != -1 || rut.indexOf("-") != -1 ){
		rut = rut.toString().replace("-", "");
		rut = rut.toString().replace(".", "");
	}
    var suma=0;
    var caracterFinal = rut.toString().substr(rut.toString().length - 1);
    var numero = rut.toString().substr(0, rut.toString().length - 1);

    for(var i=2, aux; numero > 0; i++){
        if( i==8 ){
            i=2;
        }
        aux = numero%10;
        suma += aux*i;
        numero=Math.floor(numero/10);
    }

    var digitoVerificador = 11 - (suma%11);
    var rutValido = false;

    if( digitoVerificador==10 && (caracterFinal=="k" || caracterFinal=="K") )
            rutValido = true;
    
    if( digitoVerificador==11 && caracterFinal==0 )
    		rutValido = true;
    	
    if( digitoVerificador==caracterFinal )
        rutValido = true;
    
    return rutValido;
}

/**
* Funcion que valida solo el ingreso de valores numericos por teclado.
* @param (event) e - texto o valor numerico a verificar.
* @return (Boolean) - True si es numerico, en caso contrario False. 
*/
//Se pasa el objeto event
function validar_numeric(e){
	//Para distinguir si el explorador es IE 'document.all' u otro. Si es IE a la 
	//variable tecla se le asigna el valor e.keyCode, en caso contrario e.which
    tecla = (document.all) ? e.keyCode : e.which;
	//Se comprueba si la tecla pulsada es la de retroceso, si es verdad 
	//retorna True, asi podemos borrar
    if (tecla==8)
		return true;
	//Expresion validadora, solo numeros	
    patron = /[1234567890]/;
	//Se rescata valor ASCII de la variable tecla se pasa a su caracter
    te = String.fromCharCode(tecla);
	//Si el caracter coincide con el patron retorna True, si no concide retoirna False
    return patron.test(te);	
}

/**
 * Función encargada de validar una fecha con formato dd/mm/aaaa
 * Fecha de Creación: 19/08/2011
 * @author Pablo López M.
 * @param {String} valor - Texto a validar.
 * @returns {Boolean} - True si la fecha es válida, en caso contrario false.
 */
function validarFecha(valor){
	var regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/[1-9][0-9]{3}$/;
	if( regex.test(valor) ){
		return true;
	}
	return false;
}