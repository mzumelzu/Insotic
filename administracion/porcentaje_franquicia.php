<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
<title>Administracion de Porcentaje de Franquicia</title>
<link href="../css/administracion.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="validacion/validaciones.js"></script>
<script type="text/JavaScript">	
	function validar(){
		var campo1=document.getElementById("nombre");
		var campo2=document.getElementById("valor");
		if( estaVacio(campo1.value) ){
			alert( "Debe ingresar un dato para el porcentaje de beneficio de franquicia." );
			valido = false;
		}
		if( estaVacio(campo2.value) ){
			alert( "Debe ingresar un dato para el valor porcentaje de beneficio de franquicia." );
			valido = false;
		}
	}
</script>

</head>

<?php

if (isset($_POST['guardar'])){ 
	$a[0] = $_POST['nombre'];
	$a[1] = $_POST['valor'];
	include_once('../controller/class_porcentaje_franquicia.php');
	include_once('validacion/validaciones.php');
	if( estaVacio($a[0])){
		echo "<script>alert('Debe ingresar un dato para el porcentaje de beneficio de franquicia.')</script>";
		echo "<script>window.open('porcentaje_franquicia.php','_self')</script>";
		return;
	}
		if( estaVacio($a[1])){
		echo "<script>alert('Debe ingresar un dato para el valor porcentaje de beneficio de franquicia.')</script>";
		echo "<script>window.open('porcentaje_franquicia.php','_self')</script>";
		return;
	}
	$porcentaje_franquicia = new PorcentajeFranquicia();
	if ($porcentaje_franquicia->addPorcentajeFranquicia($a) )
		echo "<script>alert('Se han registrado correctamente los datos del porcentaje de beneficio de franquicia.')</script>";
	else
		echo "<script>alert('Se ha generado un problema al registrar el porcentaje de beneficio de franquicia.')</script>";
}

if (isset($_POST['modificar'])){ 
	$id = $_POST['id'];
	$a[1] = $_POST['nombre'];
	$a[2] = $_POST['valor'];
	include_once('../controller/class_porcentaje_franquicia.php');
	include_once('validacion/validaciones.php');
	if( estaVacio($a[1])){
		echo "<script>alert('Debe ingresar un dato para el porcentaje de beneficio de franquicia.')</script>";
		echo "<script>window.open('porcentaje_franquicia.php','_self')</script>";
		return;
	}
		if( estaVacio($a[2])){
		echo "<script>alert('Debe ingresar un dato para el valor porcentaje de beneficio de franquicia.')</script>";
		echo "<script>window.open('porcentaje_franquicia.php','_self')</script>";
		return;
	}
	$porcentaje_franquicia = new PorcentajeFranquicia();
	if ($porcentaje_franquicia->updatePorcentajeFranquicia($id, $a)){
		echo "<script>alert('Se ha modificado correctamente el porcentaje de beneficio de franquicia.')</script>";
		echo "<script>window.open('porcentaje_franquicia.php','_self')</script>";
	}
	else{
		echo "<script>alert('Se ha generado un problema al modificar el porcentaje de beneficio de franquicia.
		id=".$id."')</script>";
		echo "<script>window.open('porcentaje_franquicia.php','_self')</script>";
	}
}

if ($_GET['accion']=='modificar'){ 
	include_once('../controller/class_porcentaje_franquicia.php');
	$porcentaje_franquicia = new PorcentajeFranquicia();
	$id      = $_GET['id'];
	$r       = $porcentaje_franquicia->getPorcentajeFranquiciaById($id);
	$fila    = mysql_fetch_object($r); 
	$nombre = $fila->nombre;
	$valor  = $fila->valor;
	
}

/*if ($_GET['accion']=='eliminar'){ 
	include_once('../controller/class_porcentaje_franquicia.php');
	$porcentaje_franquicia = new PorcentajeFranquicia();
	$id = $_GET['id'];
	$porcentaje_franquicia->deletePorcentajeFranquiciaById($id);
}*/

?>


<body onLoad="document.frmPorcentajeFranquicia.valor.focus();">
<?php
	include('menu_administracion.php');

?>
<br>
<fieldset><legend class="texto_adm_negrita">Registro de Porcentaje de Franquicia</legend>
<table style="text-align: left; width: 100%;" border="0" cellpadding="0"
 cellspacing="0">
  <tbody>
    <tr>
      <td><form action="porcentaje_franquicia.php" method="post" name="frmPorcentajeFranquicia" id="frmPorcentajeFranquicia" onsubmit="return validar();">
        <table width="390" border="0" cellpadding="4" cellspacing="4">
          <tr>
            <td width="134" class="texto_adm" ><div align="left">Porcentaje de Franquicia</div></td>
            <td width="14" class="texto_adm"><div align="left">:</div></td>
            <td width="202" ><div align="left">
                <input name="nombre" id="nombre" value="<?php echo $nombre;?>" style="width:200px"		 onkeypress="return validar_numeric(event)">
                <input type="hidden" name="id" value="<?php echo $_GET[id];?>">
            </div></td>
          </tr>
          <tr>
          	<td width="134" class="texto_adm"><div align="left">Valor Porcentaje de Franquicia</div></td>
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
                <input name="cancelar" value="Cancelar" type="button" onclick="window.open('porcentaje_franquicia.php','_self');">

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
<legend class="texto_adm_negrita">Mantención de Porcentajes de Franquicia</legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ID</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">PORCENTAJE DE FRANQUICIA</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">VALOR PORCENTAJE DE FRANQUICIA</th>
    <!-- <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th> -->
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
  </tr>
	  
  <?php
  
	include_once('../controller/class_porcentaje_franquicia.php');
	$porcentaje_franquicia = new PorcentajeFranquicia();
	$r = $porcentaje_franquicia->getPorcentajeFranquicia();
	while ($f = mysql_fetch_object($r)){
		?>
	<tr>
    <td class="texto_adm"><?php echo $f->id;?></td>
    <td class="texto_adm"><?php echo $f->nombre;?></td>
    <td class="texto_adm"><?php echo $f->valor;?></td>
    <!-- <td class="texto_adm"><a href='porcentaje_franquicia.php?accion=eliminar&id=<?php //echo $f->id;?>'>Eliminar</a></td> -->
    <td class="texto_adm"><a href='porcentaje_franquicia.php?accion=modificar&id=<?php echo $f->id;?>'>Modificar</a></td>
  </tr>
	
		<?php
	}
  
  ?>
</table>
</fieldset>
</body>
</html>
