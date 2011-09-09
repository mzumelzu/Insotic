<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
  <title>Administracion de Empresas</title>
  <link href="../css/administracion.css" rel="stylesheet" type="text/css" />
  
 
<?php include_once("properties/propiedades.php")?>

</head>
<?php

if (isset($_POST['guardar'])){ 
	$a[0] = $_POST['rut_empresa'];
	$a[1] = $_POST['numero_trabajadores'];
	$a[2] = $_POST['nombre_empresa'];
	$a[3] = $_POST['direccion'];
	$a[4] = $_POST['numero'];
	$a[5] = $_POST['villa_poblacion'];
	$a[6] = $_POST['numero_oficina'];
	$a[7] = $_POST['telefono_1'];
	$a[8] = $_POST['telefono_2'];
	$a[9] = $_POST['fax'];
	$a[10] = $_POST['email'];
	$a[11] = $_POST['ciudad'];
	$a[12] = $_POST['actividad_economica'];
	$a[13] = $_POST['tipo_calle'];
	$a[14] = $_POST['comuna'];
	include_once('../controller/class_empresa.php');
	$empresa = new empresa();
	if ($empresa->addEmpresa($a))
		echo "<script>alert('Se han registrado correctamente los datos de la empresa')</script>";
	else
		echo "<script>alert('Se ha generado un problema al registrar la empresa')</script>";
}

if (isset($_POST['modificar'])){ 
	$rut =  $_POST['rut_empresa'];
	$a[0] = $_POST['rut_empresa'];
	$a[1] = $_POST['numero_trabajadores'];
	$a[2] = $_POST['nombre_empresa'];
	$a[3] = $_POST['direccion'];
	$a[4] = $_POST['numero'];
	$a[5] = $_POST['villa_poblacion'];
	$a[6] = $_POST['numero_oficina'];
	$a[7] = $_POST['telefono_1'];
	$a[8] = $_POST['telefono_2'];
	$a[9] = $_POST['fax'];
	$a[10] = $_POST['email'];
	$a[11] = $_POST['ciudad'];
	$a[12] = $_POST['actividad_economica'];
	$a[13] = $_POST['tipo_calle'];
	$a[14] = $_POST['comuna'];
	$a[15] = $_POST['nombre_representante'];
	$a[16] = $_POST['fono_representante'];
	$a[17] = $_POST['email_representante'];
	$a[18] = $_POST['nombre_rrhh'];
	$a[19] = $_POST['fono_rrhh'];
	$a[20] = $_POST['email_rrhh'];
	$a[21] = $_POST['contacto_capacitacion'];
	$a[22] = $_POST['fono_contacto'];
	$a[23] = $_POST['email_contacto'];
	$a[24] = $_POST['pagina_web'];
	//print_r($a);
	include_once('../controller/class_empresa.php');
	$empresa = new empresa();
	if ($empresa->updateEmpresa($rut, $a)){
		echo "<script>alert('Se ha modificado correctamente los datos solicitados')</script>";
		echo "<script>window.open('empresas.php','_self')</script>";
	}
	else{
		echo "<script>alert('Se ha generado un problema al modificar los datos de empresa')</script>";
		echo "<script>window.open('empresas.php','_self')</script>";
	}
}

if ($_GET['accion']=='modificar'){ 
	$readonly = "readonly=readonly";
	include_once('../controller/class_empresa.php');
	$empresa = new empresa();
	$rut = $_GET['rut'];
	$r = $empresa->getEmpresasByRut($rut);
	$fila = mysql_fetch_object($r); 
	$rut_empresa = $fila->rut;
	$numero_trabajadores = $fila->numero_trabajadores;
	$nombre_empresa = $fila->nombre;
	$direccion = $fila->direccion;
	$numero = $fila->numero_direccion;
	$villa_poblacion = $fila->nombre_villa_poblacion;
	$numero_oficina = $fila->numero_oficina;
	$telefono_1 = $fila->telefono_1;
	$telefono_2 = $fila->telefono_2;
	$fax = $fila->fax;
	$email = $fila->email;
	$ciudad = $fila->insotic_ciudad_id;
	$actividad_economica = $fila->insotic_actividad_economica_id;
	$tipo_calle = $fila->insotic_tipo_direccion_id;
	$comuna = $fila->insotic_comuna_id;
	$nombre_representante = $fila->nombre_representante_legal;
	$fono_representante = $fila->fono_representante_legal;
	$email_representante = $fila->email_representante_legal;
	$nombre_rrhh = $fila->nombre_rrhh;
	$fono_rrhh = $fila->fono_rrhh;
	$email_rrhh = $fila->email_rrhh;
	$contacto_capacitacion = $fila->contacto_capacitacion;
	$fono_contacto = $fila->fono_contacto;
	$email_contacto = $fila->email_contacto;
	$pagina_web = $fila->pagina_web;
}

if ($_GET['accion']=='eliminar'){ 
	include_once('../controller/class_empresa.php');
	$empresa = new empresa();
	$rut = $_GET['rut'];
	$empresa->deleteEmpresasByRut($rut);
}


?>


<body onLoad="document.frmEmpresa.rut_empresa.focus();">
<?php
	include('menu_administracion.php');
	
?>
<br>
<fieldset><legend class="texto_adm_negrita">Registro
de Empresas</legend>
<table style="text-align: left; width: 100%;" border="0" cellpadding="0"
 cellspacing="0">
  <tbody>
    <tr>
      <td><form action="empresas.php" method="post" name="frmEmpresa" id="frmEmpresa">
        <table width="652" border="0" cellpadding="4" cellspacing="4">
          <tr>
            <td width="134" class="texto_adm" ><div align="left">Rut
              Empresa</div></td>
            <td width="14" class="texto_adm"><div align="left">:</div></td>
            <td width="202" ><div align="left">
                <input name="rut_empresa" value="<?php echo $rut_empresa;?>" <?php echo $readonly;?>>
            </div></td>
            <td width="135" class="texto_adm" ><div align="left">Numero
              de
              Trabajadores</div></td>
            <td width="8" class="texto_adm"><div align="left">:</div></td>
            <td width="459" ><div align="left">
                <input name="numero_trabajadores" value="<?php echo $numero_trabajadores;?>">
            </div></td>
            <td width="135" class="texto_adm" ><div align="left">Nombre RRHH</div></td>
            <td width="8" class="texto_adm"><div align="left">:</div></td>
            <td width="459" ><div align="left">
                <input name="nombre_rrhh" value="<?php echo $nombre_rrhh;?>">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Nombre
              Empresa</div></td>
            <td class="texto_adm"><div align="left">:</div></td>
            <td ><div align="left">
                <input name="nombre_empresa" value="<?php echo $nombre_empresa;?>">
            </div></td>
            <td class="texto_adm" ><div align="left">Telefono
              1</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="telefono_1" value="<?php echo $telefono_1;?>">
            </div></td>
            <td class="texto_adm" ><div align="left">Telefono RRHH</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="fono_rrhh" value="<?php echo $fono_rrhh;?>">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Tipo
              Calle</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td><div align="left">
                 <?php
			  			//Llamaba a combo de omunas
                		include_once('../controller/class_tipo_calle.php');
						$tipo_calles = new TipoCalle();
						
						
						if ($_GET['accion']=='modificar'){ 
							$tipo_calles->seleccionaTipoCalleByIdCmb($tipo_calle);
						}	
						else { 
							$tipo_calles->seleccionaTipoCalleCmb();
						}
						
												
				?>
            </div></td>
            <td class="texto_adm"><div align="left">Telefono
              2</div></td>
            <td class="texto_adm"><div align="left">:</div></td>
            <td><div align="left">
                <input name="telefono_2" value="<?php echo $telefono_2;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Email RRHH</div></td>
            <td class="texto_adm"><div align="left">:</div></td>
            <td><div align="left">
                <input name="email_rrhh" value="<?php echo $email_rrhh;?>">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Direccion</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="direccion" value="<?php echo $direccion;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Fax</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="fax" value="<?php echo $fax;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Contacto Capacitaci&oacute;n</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="contacto_capacitacion" value="<?php echo $contacto_capacitacion;?>">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Numero</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="numero" value="<?php echo $numero;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Email</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="email" value="<?php echo $email;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Telefono contacto</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="fono_contacto" value="<?php echo $fono_contacto;?>">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Villa
              o
              Poblaci&oacute;n</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="villa_poblacion" value="<?php echo $villa_poblacion;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Actividad
              Econ&oacute;mica</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <?php
			  			//Llamaba a combo de omunas
                		include_once('../controller/class_actividad_economica.php');
						$actividades_economicas = new actividadEconomica();
						
						if ($_GET['accion']=='modificar'){ 
							$actividades_economicas->seleccionaActividadesEconomicasByIdCmb($actividad_economica);
						}	
						else { 
							$actividades_economicas->seleccionaActividadesEconomicasCmb();
						}
						
						
				?>
            </div></td>
            <td class="texto_adm"><div align="left">Email Contacto</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="email_contacto" value="<?php echo $email_contacto;?>">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Numero
              Oficina</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
                <input name="numero_oficina" value="<?php echo $numero_oficina;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Nombre Representante Legal</div></td>
            <td class="texto_adm" ><div align="left"></div></td>
            <td ><div align="left">
            	<input name="nombre_representante" value="<?php echo $nombre_representante;?>">
            </div></td>
            <td class="texto_adm"><div align="left">Pagina Web</div></td>
            <td class="texto_adm" ><div align="left"></div></td>
            <td ><div align="left">
            	<input name="pagina_web" value="<?php echo $pagina_web;?>">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Ciudad</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
              <?php
			  			//Llamaba a combo de ciudades
                		include_once('../controller/class_ciudad.php');
						$ciudades = new ciudades();
						//echo $ciudad;
						if ($_GET['accion']=='modificar'){ 
							$ciudades->seleccionaCiudadesByIdCmb($ciudad);
						}	
						else { 
							$ciudades->seleccionaCiudadesCmb();
						}
				?>
            </div></td>
            <td class="texto_adm"><div align="left">Fono Representante Legal</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
            	<input name="fono_representante" value="<?php echo $fono_representante;?>">
			</div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Comuna</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
              <?php
			  			//Llamaba a combo de omunas
                		include_once('../controller/class_comuna.php');
						$comunas = new comunas();
						
						if ($_GET['accion']=='modificar'){ 
							$comunas->seleccionaComunasByIdCmb($comuna);
						}	
						else { 
							$comunas->seleccionaComunasCmb();
						}
				?>
            </div></td>
            <td class="texto_adm"><div align="left">Email Representante Legal</div></td>
            <td class="texto_adm" ><div align="left"></div></td>
            <td ><div align="left">
            	<input name="email_representante" value="<?php echo $email_representante;?>"/>
            </div></td>
          </tr>
        </table>
		<?php
			if ($_GET['accion']=='modificar'){ ?>
				<input name="modificar" value="Modificar" type="submit">
                <input name="cancelar" value="Cancelar" type="submit">

		<?php } 
		 	else
			{
			
		 ?>
		 		<input name="guardar" value="Guardar" type="submit">
		 <?php
		 	}
		 ?>
            </form>
     </td>
    </tr>
  </tbody>
</table>
</fieldset>
<br>
<fieldset><legend class="texto_adm_negrita">Mantención de Empresas</legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">RUT</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">NOMBRE</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">DIRECCION</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">CIUDAD</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">TELEFONO</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">EMAIL</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
  </tr>
	  
  <?php
  
  include_once('../controller/class_empresa.php');
	$empresa = new empresa();
	$r = $empresa->getEmpresas();
	while ($f = mysql_fetch_object($r)){
		?>
	<tr>
    <td class="texto_adm"><?php echo $f->rut;?></td>
    <td class="texto_adm"><?php echo $f->nombre;?></td>
    <td class="texto_adm"><?php echo $f->direccion;?></td>
    <td class="texto_adm"><?php echo $f->insotic_ciudad_id;?></td>
    <td class="texto_adm"><?php echo $f->telefono_1;?></td>
    <td class="texto_adm"><?php echo $f->email;?></td>
    <td class="texto_adm"><a href="empresas.php?accion=eliminar&rut=<?php echo $f->rut;?>" onClick="return confirm('<?php echo $MENSAJE_ELIMINACION_EMPRESA;?>')";>Eliminar</a></td>
    <td class="texto_adm"><a href='empresas.php?accion=modificar&rut=<?php echo $f->rut;?>'>Modificar</a></td>
  </tr>
	
		<?php
	}
  
  ?>

</table>
</fieldset>
</body>
</html>
