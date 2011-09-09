<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
  <title>Administracion de Empresas</title>
  <link href="../css/administracion.css" rel="stylesheet" type="text/css" />
</head>
<?php

if (isset($_POST['guardar'])){ 
	$a[1] = null;
	$a[1] = $_POST['nombre'];
	include_once('../controller/class_franquicia.php');
	$empresa = new franquicia();
	if ($empresa->addFranquicia($a))
		echo "<script>alert('Se han registrado correctamente los datos del tipo de franquicia')</script>";
	else
		echo "<script>alert('Se ha generado un problema al registrar los datos del tipo de franquicia')</script>";
}

if (isset($_POST['modificar'])){ 
	$id   = $_POST['id'];
	$a[1] = $_POST['nombre'];
	include_once('../controller/class_franquicia.php');
	$empresa = new franquicia();
	if ($empresa->updateFranquicia($id, $a)){
		echo "<script>alert('Se ha modificado correctamente los datos solicitados')</script>";
		echo "<script>window.open('franquicia.php','_self')</script>";
	}
	else{
		echo "<script>alert('Se ha generado un problema al modificar los datos')</script>";
		echo "<script>window.open('franquicia.php','_self')</script>";
	}
}

if ($_GET['accion']=='modificar'){ 
	include_once('../controller/class_franquicia.php');
	$empresa = new franquicia();
	$id      = $_GET['id'];
	$r       = $empresa->getFranquiciaById($id);
	$fila    = mysql_fetch_object($r); 
	$nombre  = $fila->nombre;
	
}

if ($_GET['accion']=='eliminar'){ 
	include_once('../controller/class_franquicia.php');
	$empresa = new franquicia();
	$id = $_GET['id'];
	$empresa->deleteFranquiciaById($id);
}


?>


<body>
<?php
	include('menu_administracion.php');
	
?>
<br>
<fieldset>
<legend class="texto_adm_negrita">Registro
de Tipo de Franquicia </legend>
<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><form action="franquicia.php" method="post" name="frmFranquicia" id="frmFranquicia">
        <table width="390" border="0" cellpadding="4" cellspacing="4">
          <tr>
            <td width="134" class="texto_adm" ><div align="left">Nombre Franquicia</div></td>
            <td width="14" class="texto_adm"><div align="left">:</div></td>
            <td width="202" ><div align="left">
                <input name="nombre" id="nombre" value="<?php echo $nombre;?>" style="width:200px">
                <input type="hidden" name="id" value="<?php echo $_GET[id];?>">
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
<fieldset>
<legend class="texto_adm_negrita">Mantención de Tipo de Franquicia </legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ID</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">NOMBRE TIPO DE FANQUICIA</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
  </tr>
	  
  <?php
  
  include_once('../controller/class_franquicia.php');
	$empresa = new franquicia();
	$r = $empresa->getFranquicia();
	while ($f = mysql_fetch_object($r)){
		?>
	<tr>
    <td class="texto_adm"><?php echo $f->id;?></td>
    <td class="texto_adm"><?php echo $f->nombre;?></td>
    <td class="texto_adm"><a href='franquicia.php?accion=eliminar&id=<?php echo $f->id;?>'>Eliminar</a></td>
    <td class="texto_adm"><a href='franquicia.php?accion=modificar&id=<?php echo $f->id;?>'>Modificar</a></td>
  </tr>
	
		<?php
	}
  
  ?>
</table>
</fieldset>
</body>
</html>