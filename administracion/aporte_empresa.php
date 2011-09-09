<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Aporte de Empresas</title>
<link href="../css/administracion.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="validacion/validaciones.js"></script>
</head>

<body>
<?php include 'menu_administracion.php'; ?>
<script src="_jquery/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/aporte_empresa.js"></script>

	<br />
	<table>
		<tr>
			<td><label for="nroRecibo">N&deg; Recibo:</label></td>
			<td><input type="text" id="nroRecibo" name="nroRecibo" /></td>
			<td><input type="button" onclick="buscarAporte()" value="Aceptar" /></td>
		</tr>
	</table>
	<div id="datosAporte" style="display:none;">
		<table>
			<tr>
				<td><label for="rutEmpresa">Rut Empresa:</label></td>
				<td><input type="text" id="rutEmpresa" maxlength="9" name="rutEmpresa" onblur=""/>&nbsp;-</td>
				<td><input style="width: 20px;" type="text" id="digitoVerificador" onblur="buscarEmpresa()"
					maxlength="1" name="digitoVerificador"></input></td>
			</tr>
			<tr>
				<td><label></label>Nombre Empresa:</td>
				<td><label id="nombreEmpresa"></label></td>
				<td><input type="hidden" id="existeEmpresa" value="0" /></td>
			</tr>
			<tr>
				<td><label for="fecha">Fecha:</label></td>
				<td><input type="text" id="fecha" name="fecha" readonly="readonly"/></td>
			</tr>
			<tr>
				<td><label for="totalAporte">Total Aporte:</label></td>
				<td><input type="text" id="totalAporte" name="totalAporte" /></td>
				<td><label for="medio">Medio:</label></td>
				<td><select id="medio">
					<option value="0">Seleccione Medio</option>
					<option value="1">Cheque</option>
					<option value="2">Dep&oacute;sito</option>
					<option value="3">Transferencia</option>
				</select></td>
				<td style="padding-left: 20px;"><label for="nroDocumento">N&deg; Documento:</label></td>
				<td><input type="text" id="nroDocumento" name="nroDocumento" maxlength="15"/></td>
			</tr>
		</table>
		<fieldset>
			<legend class="texto_adm_negrita">Distribuci&oacute;n Aporte</legend>
			<table>
				<tr>
					<td><label for="ctaCapacitacion"></label>Cuenta	Capacitaci&oacute;n:</td>
					<td><input type="text" id="ctaCapacitacion" name="ctaCapacitacion"/></td>
				</tr>
				<tr>
					<td><label for="ctaReparto"></label>Cuenta Reparto:</td>
					<td><input type="text" id="ctaReparto" name="ctaReparto"/></td>
				</tr>
				<tr>
					<td><label for="ctaAdministracion"></label>Cuenta Administraci&oacute;n:</td>
					<td><input type="text" id="ctaAdministracion"/>	</td>
				</tr>
				<tr>
					<td><label for="ctaCertificacion"></label>Cuenta Certificaci&oacute;n:</td>
					<td><input type="text" id="ctaCertificacion" name="ctaCertificacion" /></td>
				</tr>
			</table>
		</fieldset>
		<input type="button" value="Guardar" onclick="guardarDatosAporte()"/> 
		<input type="button" onclick="cancelar()" value="Cancelar"></input>
	</div>	
</body>
</html>