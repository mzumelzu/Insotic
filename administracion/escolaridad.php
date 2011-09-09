<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
<title>Administracion de Empresas</title>
<link href="../css/administracion.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="validacion/validaciones.js"></script>
<script type="text/JavaScript">
	function validar(){
		var campo1=document.getElementById("nombre");
		var campo2=document.getElementById("valor");
		if(estaVacio(campo1.value)){
			alert( "Debe ingresar un nombre para el nivel de escolaridad." );
			return false;
		}
		if(estaVacio(campo2.value)){
			alert( "Debe ingresar un valor para el nivel de escolaridad." );
			return false;
		}
	}
</script>

<?php include_once("properties/propiedades.php")?>
  
</head>

<?php

if (isset($_POST['guardar'])){ 
	$a[0] = $_POST['nombre'];
	$a[1] = $_POST['valor'];
	include_once('../controller/class_escolaridad.php');
	$escolaridad = new Escolaridad();
	include_once('validacion/validaciones.php');
	if( estaVacio($a[0])){
		echo "<script>alert('Debe ingresar un nombre para el nivel de escolaridad.')</script>";
		echo "<script>window.open('escolaridad.php','_self')</script>";
		return;
	}
	if( estaVacio($a[1])){
		echo "<script>alert('Debe ingresar un valor para el nivel de escolaridad.')</script>";
		echo "<script>window.open('escolaridad.php','_self')</script>";
		return;
	}	
	if ($escolaridad->addEscolaridad($a))
		echo "<script>alert('Se han registrado correctamente los datos de la escolaridad.')</script>";
	else
		echo "<script>alert('Se ha generado un problema al registrar los datos de la escolaridad.')</script>";
}

if (isset($_POST['modificar'])){
	$id = $_POST['id'];
	$a[1] = $_POST['nombre'];
	$a[2] = $_POST['valor'];
	include_once('../controller/class_escolaridad.php');
	include_once('validacion/validaciones.php');
 
	if( estaVacio($a[1]) ){

		echo "<script>alert('Debe ingresar un nombre para el nivel de escolaridad.')</script>";
		echo "<script>window.open('escolaridad.php','_self')</script>";
		return;
	}
	if( estaVacio($a[2])){
		echo "<script>alert('Debe ingresar un valor para el nivel de escolaridad.')</script>";
		echo "<script>window.open('escolaridad.php','_self')</script>";
		return;
	}
	$escolaridad = new Escolaridad();
	if ($escolaridad->updateEscolaridad($id, $a)){	
		echo "<script>alert('Se ha modificado correctamente el nivel de escolaridad')</script>";
		echo "<script>window.open('escolaridad.php','_self')</script>";
	}
	else{
		echo "<script>alert('Se ha generado un problema al modificar el nivel de escolaridad.
		id=".$id."')</script>";
		echo "<script>window.open('escolaridad.php','_self')</script>";
	}
}

if ($_GET['accion']=='modificar'){ 
	include_once('../controller/class_escolaridad.php');
	$escolaridad = new Escolaridad();
	$id      = $_GET['id'];
	$r       = $escolaridad->getEscolaridadById($id);
	$fila    = mysql_fetch_object($r); 
	$nombre = $fila->nombre;
	$valor  = $fila->valor;
}

/*if ($_GET['accion']=='eliminar'){ 
	include_once('../controller/class_escolaridad.php');
	$empresa = new escolaridad();
	$id = $_GET['id'];
	$empresa->deleteEscolaridadById($id);
}*/

?>

<body onLoad="document.frmEscolaridad.valor.focus();">
<?php
	include('menu_administracion.php');

?>
<br>
<fieldset><legend class="texto_adm_negrita">Registro de Nivel de Escolaridad </legend>
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><form action="escolaridad.php" method="post" name="frmEscolaridad" 
      id="frmEscolaridad" onsubmit="return validar();">
        <table width="390" border="0" cellpadding="4" cellspacing="4">
          <tr>
            <td width="134" class="texto_adm" ><div align="left">Nombre Nivel de Escolaridad</div></td>
            <td width="14" class="texto_adm"><div align="left">:</div></td>
            <td width="202" ><div align="left">
                <input name="nombre" id="nombre" value="<?php echo $nombre;?>" style="width:200px">
                <input type="hidden" name="id" value="<?php echo $_GET[id];?>">
            </div></td>
            </tr>
		  <tr>
          	<td width="134" class="texto_adm"><div align="left">Valor Nivel de Escolaridad</div></td>
            <td width="14" class="texto_adm"><div align="left">:</div></td>
            <td width="202" ><div align="left">
            	<input name="valor" id="valor" value="<?php echo $valor;?>" style="width:200px"
                onkeypress="return validar_numeric(event)">
            </div></td>    
          </tr> 
        </table>
		<?php
			if ($_GET['accion']=='modificar'){ ?>
				<input name="modificar" value="Modificar" type="submit">
                <input name="cancelar" value="Cancelar" type="button" onclick="window.open('escolaridad.php','_self');">

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
<fieldset>
<legend class="texto_adm_negrita">Mantención de Nivel de Escolaridad </legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ID</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">NOMBRE NIVEL ESCOLARIDAD</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">VALOR NIVEL ESCOLARIDAD</th>
    <!--th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th-->
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
  </tr>
	  
  <?php
  
  include_once('../controller/class_escolaridad.php');
	$escolaridad = new Escolaridad();
	$r = $escolaridad->getEscolaridad();
	while ($f = mysql_fetch_object($r)){
		?>
	<tr>
    <td class="texto_adm"><?php echo $f->id;?></td>
    <td class="texto_adm"><?php echo $f->nombre;?></td>
    <td class="texto_adm"><?php echo $f->valor;?></td>
    <!--td class="texto_adm"><a href='escolaridad.php?accion=eliminar&id=<?php echo $f->id;?>'>Eliminar</a></td-->
    <td class="texto_adm"><a href='escolaridad.php?accion=modificar&id=<?php echo $f->id;?>'>Modificar</a></td>
  </tr>
	
		<?php
	}
  
  ?>
</table>
</fieldset>
</body>
</html>
