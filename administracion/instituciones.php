<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
  <title>Administracion de Instituciones</title>
  <link href="../css/administracion.css" rel="stylesheet" type="text/css" />
  
 
<?php include_once("properties/propiedades.php")?>
<?php include_once("validaciones.php")?>


</head>
<?php

//@author Nicolás Palma Silva


if (isset($_POST['guardar'])){ 
	$a[0] = $_POST['id'];
	$a[1] = $_POST['nombre'];
	$a[2] = $_POST['direccion'];
	$a[3] = $_POST['comuna'];
	$a[4] = $_POST['telefono1'];
	$a[5] = $_POST['telefono2'];
	$a[6] = $_POST['e_mail'];
	$ver  = $_POST['verificador'];
	$a[7] = $_POST['nombre_contacto'];
	
	include_once('../controller/class_institucion.php');
	$institucion = new institucion(); 
	//Valida rut
	if(mod11($a[0], $ver)==true or $ver==""){
		echo "<script>alert('Rut inválido, ingréselo nuevamente')</script>";
		echo $PAG_ANT;
	}else
	//Valida campos obligatorios
	if(vacio($a[0])==true or vacio($a[1]==true) or vacio($a[2]==true) or vacio($a[4]==true) or vacio($a[5]==true) or vacio($a[6]==true)){
		echo "<script>alert('Todos los datos son obligatorios')</script>";
		echo $PAG_ANT;
	}else
	//Valida campos teléfonos
	if(validarTelefono($a[4])==true or validarTelefono($a[5])==true){
		echo "<script>alert('Corrija los teléfonos. Recuerde que sólo pueden escribir números')</script>";
		echo $PAG_ANT;
	} else 
	//Valida comuna
	if(validarComuna($a[3])==true){
		echo "<script>alert('Seleccione una comuna')</script>";
		echo $PAG_ANT;
	} else
	//Valida e-mail
	if(validarMail($a[6])==true){
		echo "<script>alert('Corrija el correo electrónico')</script>";
		echo $PAG_ANT;
	} else
	
	//Si pasa todos los IF, intenta guardar la información
		if ($institucion->addInstitucion($a))
			echo "<script>alert('Se han registrado correctamente los datos de la Institución')</script>";
		else
			echo "<script>alert('Se ha generado un problema al registrar la Institución')</script>";
	
}

if (isset($_POST['modificar'])){ 
	$id =  $_POST['id'];
	$a[1] = $_POST['nombre'];
	$a[2] = $_POST['direccion'];
	$a[3] = $_POST['comuna'];
	$a[4] = $_POST['telefono1'];
	$a[5] = $_POST['telefono2'];
	$a[6] = $_POST['e_mail'];
	$a[7] = $_POST['nombre_contacto'];
	
	include_once('../controller/class_institucion.php');
	$institucion = new institucion();
	//Valida campos obligatorios
	if(vacio($a[1]==true) or vacio($a[2]==true) or vacio($a[4]==true) or vacio($a[5]==true) or vacio($a[6]==true)){
		echo "<script>alert('Todos los datos son obligatorios')</script>";
		echo $PAG_ANT;
	}else
	//Valida campos teléfonos
	if(validarTelefono($a[4])==true or validarTelefono($a[5])==true){
		echo "<script>alert('Corrija los teléfonos. Recuerde que deben tener mínimo 7 dígitos')</script>";
		echo $PAG_ANT;
	} else 
	//Valida e-mail
	if(validarMail($a[6])==true){
		echo "<script>alert('Corrija el correo electrónico')</script>";
		echo $PAG_ANT;
	} else
	
	//Si pasa todos los IF, intenta guardar la información
	if ($institucion->updateInstitucion($id, $a)){
		echo "<script>alert('Se ha modificado correctamente los datos solicitados')</script>";
		echo "<script>window.open('instituciones.php','_self')</script>";
	}
	else{
		echo "<script>alert('Se ha generado un problema al modificar los datos de institución')</script>";
		echo "<script>window.open('instituciones.php','_self')</script>";
	}
}

if ($_GET['accion']=='modificar'){
	$readonly = "readonly=readonly";
	include_once('../controller/class_institucion.php');
	$institucion = new institucion();
	$id = $_GET['id'];
	$r = $institucion->getInstitucionById($id);
	$fila = mysql_fetch_object($r); 
	$id = $fila->id;
	$nombre = $fila->nombre;
	$direccion = $fila->direccion;
	$comuna = $fila->insotic_comuna_id;
	$nombre_contacto = $fila->insotic_nombre_contacto;
	$telefono1 = $fila->telefono1;
	$telefono2 = $fila->telefono2;
	$e_mail = $fila->e_mail;
	$n=$id;
	$s=1;
	for($m=0; $n!=0; $n/=10)
	$s=($s+$n%10*(9-$m++%6))%11;
	$verificador = $s-1;
}

if ($_GET['accion']=='eliminar'){ 
	include_once('../controller/class_institucion.php');
	$institucion = new institucion();
	$id = $_GET['id'];
	$institucion->deleteInstitucionById($id);
	echo "<script>window.open('instituciones.php','_self')</script>";
}

	
		

?>


<body onLoad="document.frmInstitucion.id_institucion.focus();">
<?php
	include('menu_administracion.php');
	
?>
<br>
<fieldset><legend class="texto_adm_negrita">Registro
de Institucion</legend>
<table style="text-align: left; width: 100%;" border="0" cellpadding="0"
 cellspacing="0">
  <tbody>
    <tr>
      <td><form action="instituciones.php" method="post" name="frmInstitucion" id="frmInstitucion">
        <table width="652" border="0" cellpadding="4" cellspacing="4">
          <tr>	
            <td width="143" class="texto_adm" ><div align="left">Rut (sin puntos ni gui&oacute;n)</div></td>
            <td width="6" class="texto_adm"><div align="left">:</div></td>
            <td width="463" ><div align="left">
              <input name="id" style="width:150px" value="<?php echo $id;?>" maxlength="9" <?php echo $readonly;?>>
-              
<input name="verificador" style=" width:31px" value="<?php echo $verificador; ?>" maxlength="1" <?php echo $readonly;?>/>
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Nombre instituci&oacute;n</div></td>
            <td class="texto_adm"><div align="left">:</div></td>
            <td ><div align="left">
              <input name="nombre" value="<?php echo $nombre;?>" style="width:200px">
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Direcci&oacute;n</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td><input name="direccion" value="<?php echo $direccion; ?>" style="width:200px"/></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Comuna</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
              <?php
			  			//Llamaba a combo de Comunas
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
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Nombre contacto</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
              <input name="nombre_contacto" style="width:200px" value="<?php echo $nombre_contacto;?>"/>
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Teléfono
              fijo</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
              <input name="telefono1" style="width:200px" value="<?php echo $telefono1;?>" maxlength="12"/>
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Tel&eacute;fono celular</div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
              <input name="telefono2" style="width:200px" value="<?php echo $telefono2;?>" maxlength="12"/>
            </div></td>
          </tr>
          <tr>
            <td class="texto_adm" >Correo</td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td ><div align="left">
              <input name="e_mail" value="<?php echo $e_mail;?>" style="width:200px"/>
            </div>
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
<fieldset><legend class="texto_adm_negrita">Mantención de Institución</legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th width="9%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">RUT</th>
    <th width="10%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">NOMBRE</th>
    <th width="10%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">DIRECCION</th>
    <th width="11%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">COMUNA</th>
    <th width="12%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">NOMBRE CONTACTO</th>
    <th width="11%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">TELEFONO FIJO</th>
    <th width="11%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">TELEFONO CELULAR</th>
    <th width="9%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">EMAIL</th>
    <th width="9%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th>
    <th width="8%" bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
  </tr>
	  
  <?php
  
  include_once('../controller/class_institucion.php');
	$institucion = new institucion();
	$r = $institucion->getInstitucion();
	while ($f = mysql_fetch_object($r)){
		?>
	<tr>
    <td class="texto_adm"><?php echo $f->id;?></td>
    <td class="texto_adm"><?php echo $f->nombre;?></td>
    <td class="texto_adm"><?php echo $f->direccion;?></td>
    <td class="texto_adm"><?php echo $f->insotic_comuna_id;?></td>
    <td class="texto_adm"><?php echo $f->insotic_nombre_contacto;?></td>
    <td class="texto_adm"><?php echo $f->telefono1;?></td>
    <td class="texto_adm"><?php echo $f->telefono2;?></td>
    <td class="texto_adm"><?php echo $f->e_mail;?></td>
    <td class="texto_adm"><a href="instituciones.php?accion=eliminar&id=<?php echo $f->id;?>" onClick="return confirm('<?php echo $MENSAJE_ELIMINACION_INSTITUCION;?>')";>Eliminar</a></td>
    <td class="texto_adm"><a href="instituciones.php?accion=modificar&id=<?php echo $f->id;?>">Modificar</a></td>
  </tr>
	
		<?php
	}
  
  ?>

</table>
</fieldset>
</body>
</html>
