<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Infotic</title>
<link rel="stylesheet" type="text/css" href="../css/menu.css">
<link rel="stylesheet" type="text/css" href="../css/administracion.css">
<link href="../css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="validacion/validaciones.js"></script>
<script src="_jquery/jquery.js"></script>

</head>

<body>

<div id="header">
<div id="contenido">
<div id="logo"></div>
<div id="menu_header">
<?php include('menu_administracion.php'); ?>
</div><!-- fin menu_header -->
</div><!-- fin div contenido-->
</div><!-- fin div header-->
<div id="wrapper">
<div id="contenedor">
<div id="titulo">Aporte Empresa</div>

<script src="_jquery/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/aporte_empresa.js"></script>
<table class="uno">
  <tbody>
    <tr>
	<td>
	<table class="dos">
		<tr>
			<td><label for="nroRecibo"><div id="etiquetaEmpresaDos">N&deg; Recibo :</div></label></td>
			<td><input type="text" id="nroRecibo" name="nroRecibo" /></td>
			<td><input type="button" onclick="buscarAporte()" value="Aceptar" /></td>
		</tr>
	</table>
	<div id="datosAporte" style="display:none;">
		<table class="dos">
			<tr>
				<td><label for="rutEmpresa"><div id="etiquetaEmpresaDos">Rut Empresa :</div></label></td>
				<td>
					<input style="width:112px" type="text" id="rutEmpresa" maxlength="9" name="rutEmpresa" onblur=""/>
					-
					<input style="width:20px" type="text" id="digitoVerificador" onblur="buscarEmpresa()" maxlength="1" name="digitoVerificador"></input>
				</td>
			</tr>
			<tr>
				<td><label for="nombreEmpresa"><div id="etiquetaEmpresaDos">Nombre Empresa :</div></label></td>
				<td align="left"><label id="nombreEmpresa"></label></td>
				<td><input type="hidden" id="existeEmpresa" value="0" /></td>
			</tr>
			<tr>
				<td><label for="fecha">Fecha:</label></td>
				<td><input style="width:134px" type="text" id="fecha" name="fecha" readonly="readonly"/></td>
			</tr>
			<tr>
				<td>
					<label for="totalAporte"><div id="etiquetaEmpresaDos">Total Aporte :</div></label>
				</td>	
				<td>
					<input type="text" id="totalAporte" name="totalAporte" />
				</td>
				
				<td>
					<label for="medio"><div id="etiquetaEmpresaDos">Medio :</div></label>
				</td>	
				<td>
					<div class="styled-select">
						<select id="medio">
							<option value="0">Seleccione Medio</option>
							<option value="1">Cheque</option>
							<option value="2">Dep&oacute;sito</option>
							<option value="3">Transferencia</option>
						</select>
					</div>	
				</td>
				<td>
					<label for="nroDocumento"><div id="etiquetaEmpresaDos">N&deg; Documento :</div></label>
				</td>	
				<td>
					<input type="text" id="nroDocumento" name="nroDocumento" maxlength="15"/>
				</td>
			</tr>
		</table>
			<br>
		<div id="mantencion">Distribuci&oacute;n Aporte</div>	
		<div id="contenedorDos">
			<table class="uno">
				<tbody>
				<tr>
				<td>
				<table class="dos">
				<tr>
					<td><label for="ctaCapacitacion"></label><div id="etiquetaEmpresaDos">Cuenta Capacitaci&oacute;n :</div></td>
					<td><input type="text" id="ctaCapacitacion" name="ctaCapacitacion"/></td>
				</tr>
				<tr>
					<td><label for="ctaReparto"></label><div id="etiquetaEmpresaDos">Cuenta Reparto :</div></td>
					<td><input type="text" id="ctaReparto" name="ctaReparto"/></td>
				</tr>
				<tr>
					<td><label for="ctaAdministracion"></label><div id="etiquetaEmpresaDos">Cuenta Administraci&oacute;n :</div></td>
					<td><input type="text" id="ctaAdministracion"/>	</td>
				</tr>
				<tr>
					<td><label for="ctaCertificacion"></label><div id="etiquetaEmpresaDos">Cuenta Certificaci&oacute;n :</div></td>
					<td><input type="text" id="ctaCertificacion" name="ctaCertificacion" /></td>
				</tr>
				</table>
				</td>
				</tr>
				</tbody>
			</table>
		</div>
		<table>
		<tr>
			<td>
			<input type="button" value="Guardar" onclick="guardarDatosAporte()"/> 
			<input type="button" onclick="cancelar()" value="Cancelar" />
			</td>
		</tr>
		</table>
	</td>
    </tr>
  </tbody>
</table>

</div><!-- fin div conetendor-->
<div id="footer">
</div><!--fin div footer-->
</div><!-- fin div wrapper-->	
	
</body>
</html>