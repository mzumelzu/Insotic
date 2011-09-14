/**
 * Funcion que valida el numero de recibo ingresado, si es valido procede con la busqueda de los datos asociados al recibo ingresado.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 */
function buscarAporte(){
	limpiar(false);
	var recibo = $("#nroRecibo").val();
	if( estaVacio(recibo) || isNaN(recibo) )
		alert( "Debe ingresar un valor numérico en el campo de numero de recibo." );
	
	else{
		$("#datosAporte").css("display","");
		$("#fecha").val(getFecha("/"));
		$.ajaxSetup({ async: false });
		$.getJSON("datos_aporte_empresa.php", {
			recibo : recibo,
			accion : "buscarAporte"
		}, cargarDatosAporte);
	}
	$.ajaxSetup({ async: true });
	return false;
}
/**
 * Función que recibe los datos del aporte (formato JSON) y los carga en el formulario.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 */
function cargarDatosAporte(datos){
	//Se obtienen los datos y se cargan en los campos del formulario.	
	$("#nroRecibo").val(datos.recibo);
	$("#nroRecibo").attr("disabled","true");
	$("#rutEmpresa").val(datos.rutEmpresa);
	$("#digitoVerificador").val(datos.digitoVerificador);
	mostrarNombreEmpresa(datos.nombreEmpresa);
	$("#fecha").val(datos.fecha);
	$("#totalAporte").val(datos.totalAporte);
	$("#medio").find("option").each(function(){
		if( $(this).val()==datos.medio)
			$(this).attr("selected","true");
	});
	$("#nroDocumento").val(datos.nroDocumento);
	$("#ctaCapacitacion").val(datos.ctaCapacitacion);
	$("#ctaReparto").val(datos.ctaReparto);
	$("#ctaAdministracion").val(datos.ctaAdministracion);
	$("#ctaCertificacion").val(datos.ctaCertificacion);
}

/**
 * Función que encargada de validar los datos ingresados, si las validaciones son correctas se continua con la inserción de los datos.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 */
function guardarDatosAporte(){
	//Se validan todos los campos.
	if( validarTodo() ){
		var accion = "";
		if( $("#nroRecibo").attr("disabled") )
			accion = "modificar";
		else
			accion = "guardar";
		//Se formatea la fecha.
		var fecha = $("#fecha").val().split("/");
		fecha = fecha[2]+"/"+fecha[1]+"/"+fecha[0];	
		//Se envia la consulta al servidor usando metodo POST.
		$.post("datos_aporte_empresa.php",{
			accion : accion,
			rutEmpresa : $("#rutEmpresa").val(),
			digitoVerificador : $("#digitoVerificador").val(),
			fecha : fecha,
			recibo : $("#nroRecibo").val(),
			medio : $("#medio").val(),
			nroDocumento : $("#nroDocumento").val(),
			ctaCapacitacion : $("#ctaCapacitacion").val(),
			ctaReparto : $("#ctaReparto").val(),
			ctaAdministracion : $("#ctaAdministracion").val(),
			ctaCertificacion : $("#ctaCertificacion").val(),
			totalAporte : $("#totalAporte").val()
		}, procesarGuardado);
		return false;
	}
}

/**
 * Función usada para evaluar la respuesta del servidor luego de la inserción y generar un mensaje.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 */
function procesarGuardado(respuesta){
	if( respuesta=="true" ){
		alert( "Los datos de aporte de empresa fueron guardados correctamente." );
		cancelar();
	}
		
	if( respuesta=="false" )
		alert( "Ocurrio un error al guardar los datos de aporte de empresa." );
		cancelar();
	if( respuesta=="error" )
		alert( "Hay datos invalidos. Por favor verifique los datos ingresados." );
}

/**
 * Función usada para la validacion de todos los campos del formulario. Si hay datos invalidos, se muestra un mensaje correspondiente.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 */
function validarTodo(){
	//Se obtienen los datos del formulario.
	var recibo = $("#nroRecibo").val();
	var rutEmpresa = $("#rutEmpresa").val();
	var digitoVerificador = $("#digitoVerificador").val();
	var fecha = $("#fecha").val();
	var totalAporte = $("#totalAporte").val();
	var medio = $("#medio").val();
	var nroDocumento = $("#nroDocumento").val();
	var ctaCapacitacion = $("#ctaCapacitacion").val();
	var ctaReparto = $("#ctaReparto").val();
	var ctaAdministracion = $("#ctaAdministracion").val();
	var ctaCertificacion = $("#ctaCertificacion").val();
	//Se crea un arreglo con todos los datos para facilitar la validacion de campos vacios.
	var todos = new Array(recibo,rutEmpresa,digitoVerificador,fecha,totalAporte,nroDocumento,
			ctaCapacitacion,ctaReparto,ctaAdministracion,ctaCertificacion);

	//Se validan que los campos no esten vacios.
	for(var i=0; i<todos.length; i++){
		if( estaVacio(todos[i]) ){
			alert( "Debe ingresar un valor para todos los campos solicitados.");
			return false;
		}
	}	
	//Se valida el rut ingresado.
	if( !validarRut(rutEmpresa+digitoVerificador) ){
		alert( "El rut de empresa ingresado no es válido.");		
		return false;
	}
	//Se valida que la empresa indicada por el rut exista en la base de datos.
	if( $("#existeEmpresa").val()=="0" ){
		alert( "El rut ingresado no corresponde a ninguna empresa registrada en el sistema.");
		return false;
	}
	//Se valida la fecha ingresada.
	if( !validarFecha(fecha) ){
		alert( "La fecha ingresada no es válida. Use formato dd/mm/aaaa");
		return false;
	}
	//Se valida que se seleccione un medio de pago.
	if( medio==0 ){
		alert( "Debe seleccionar un medio de pago.");
		return false;
	}
	//Se valida que el número de recibo sea un dato numérico.
	if( isNaN(recibo) ){
		alert( "El campo de recibo debe ser numérico.");	
		return false;
	}		
	//Se valida que el total aporte sea un dato numérico.
	if( isNaN(totalAporte) ){
		alert( "El campo de total aporte debe ser numérico.");
		return false;
	}			
	//Se valida que todos los campos de cuentas sean un dato numérico.
	if( isNaN(ctaCapacitacion) || isNaN(ctaReparto) ||
			isNaN(ctaAdministracion) || isNaN(ctaAdministracion) ){
		alert( "Los campos de cuentas deben ser numéricos.");
		return false;
	}	
	//Se valida que la suma de las cuatro cuentas sea igual al total aporte.
	var sumaCtas = parseInt(ctaCapacitacion) + parseInt(ctaReparto) +
					parseInt(ctaAdministracion) + parseInt(ctaCertificacion);	
	if( sumaCtas != totalAporte ){
		alert( "La suma de las cuatro cuentas debe ser igual al aporte total." );
		return false;
	}
	return true;
}

/**
 * Función que valida el rut ingresado y si es válido continua con la busqueda del nombre de empresa asociado.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 */
function buscarEmpresa() {
	if( estaVacio($("#digitoVerificador").val()) ){
		alert("Debe ingresar el digito verificador del rut.");
		return false;
	}
	//Se obtiene el rut ingresado.
	var rut = $("#rutEmpresa").val() + $("#digitoVerificador").val();
	//Se valida el rut.
	if( !validarRut(rut) ){
		alert( "El rut de empresa ingresado no es válido.");
	}else{
		//Se envia el rut por metodo GET al servidor para que realice la consulta (se usa jquery).
		$.get("datos_aporte_empresa.php", {
		rut : rut,
		accion : "buscarEmpresa"
		}, mostrarNombreEmpresa);
	}
	return false;
}

/**
 * Función usada para mostrar el nombre de la empresa. Si el nombre existe se muestra el mismo de color azul, en caso contrario se usa un mensaje en color rojo.
 * Fecha de Creacion: 19/08/2011
 * @author Pablo López M.
 * @param {String} nombre - Texto que se evaluará para mostrar.
 */
function mostrarNombreEmpresa(nombre){
	//Se obtiene el elemento que mostrará el nombre de la empresa.
	var nombreEmpresa = $("#nombreEmpresa");
	//Se evalua que el parametro recibido tengo un nombre de empresa.
	if( nombre.indexOf("<script>") != -1 ){
		//Si no es un nombre, se modifica el nombre por un mensaje en color rojo.
		nombre = "Rut no existente";
		$("#existeEmpresa").val("0");
		nombreEmpresa.css("color","red");
	}else{
		//Si es un nombre se modifica el nombre a un color azul.
		$("#existeEmpresa").val("1");
		nombreEmpresa.css("color","blue");
	}
	//Se muestra el nombre de empresa.
	nombreEmpresa.html(nombre);
}

/**
 * Funcion que oculta los datos del formulario, dejando solo el numero de recibo, limpia todos los campos y deja el foco en el campo de recibo.
 * Fecha de Creacion: 18/08/2011
 * @author Pablo López M.
 */
function cancelar() {
	//Se limpian los campos.
	limpiar(true);
	//Se ocultan los campos.
	$("#datosAporte").css("display", "none");
	$("#nroRecibo").attr("disabled","");
	//Se otorga el foco al campo de número de recibo.
	$("#nroRecibo").focus();
}

function limpiar(conRecibo){
	if(conRecibo)
		$("#nroRecibo").val("");	
	$("#rutEmpresa").val("");
	$("#digitoVerificador").val("");
	$("#nombreEmpresa").html("");
	$("#fecha").val("");
	$("#totalAporte").val("");
	$("#medio").find("option").each(function(){
		if( $(this).val()==0)
			$(this).attr("selected","true");
	});
	$("#nroDocumento").val("");
	$("#ctaCapacitacion").val("");
	$("#ctaReparto").val("");
	$("#ctaAdministracion").val("");
	$("#ctaCertificacion").val("");
}

/**
 * Función encargada de obtener la fecha del sistema del cliente.
 * Fecha de Creacion: 18/08/2011
 * @author Pablo López M.
 * @param delimitador {String} - Caracter que se usará para separar las partes de la fecha (dia, mes y año).
 * @returns {String} Retorna la fecha actual del sistema cliente en formato 'dd/mm/aaaa'
 */
function getFecha(delimitador) {
	//Se verifica que se haya recibido un delimitador, sino se usara por defecto '/'
	delimitador = (delimitador == null) ? "/" : delimitador;
	//Se obtiene la fecha actual.
	var fecha = new Date();
	//Se da formato al dia.
	var dia = (fecha.getDate() >= 10) ? fecha.getDate() : "0" + fecha.getDate();
	//Se da formato al mes.
	var mes = ((fecha.getMonth() + 1) >= 10) ? (fecha.getMonth() + 1) : "0"
			+ (fecha.getMonth() + 1);
	//Se retorna la fecha formateada.
	return dia + delimitador + mes + delimitador + fecha.getFullYear();
}

/**
 * Bloque de codigo que se carga al completarse la pagina aporte_empresas.php. Su función es agregar el calendario de jquery-ui y cambiar su idioma.
 */
$(document).ready(function (){
	  $.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '&#x3c;Ant',
				nextText: 'Sig&#x3e;',
				currentText: 'Hoy',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
				'Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
				dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
				weekHeader: 'Sm',
				dateFormat: 'dd/mm/yy',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$.datepicker.setDefaults($.datepicker.regional['es']);
			
		$("#fecha").datepicker({
			showOn: "button",
			buttonImage: "imagenes/calendar.gif",
			buttonImageOnly: true
		});
});