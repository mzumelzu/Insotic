<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Formulario_comunicacion</title>
<link href="../css/administracion.css" rel="stylesheet" type="text/css" />
<?php include_once("properties/propiedades.php")?>
</head>
<body>
<?php
	if ($_GET['accion']=='eliminar')
	{ 
		include_once('../controller/class_formulario_comunicacion.php');
		$formCom= new FormularioComunicacion();
		$ideliminacion = $_GET['idForm'];
		$formCom->deleteformComById($ideliminacion);
	}
?>
<?php
	include('menu_administracion.php');
	
?>
	<br>
     <a href="formulario_crear.php"><input name="nuevo_formulario" value="Nuevo Formulario" type="submit"></a>
<fieldset><legend class="texto_adm_negrita">Formularios de Comunicacion </legend>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">NRO. FORMULARIO</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">Rut EMPRESA</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">CODIGO SENCE</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">FECHA INICIO</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">FECHA INICIO</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">TOTAL HORAS</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ESTADO ENVIO</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th>
  </tr>
	  
	<?php
  include_once('../controller/class_formulario_comunicacion.php');
	$formulario = new FormularioComunicacion();
	$r = $formulario->getFormulario();
	while ($f = mysql_fetch_object($r))
	{
	?>
      <tr>
            <td class="texto_adm"><?php echo $f->id;?></td>
            <td class="texto_adm"><?php echo $f->insotic_empresa_rut;?></td>
            <td class="texto_adm"><?php echo $f->codigo_curso;?></td>
            <td class="texto_adm"><?php echo $f->fecha_inicio;?></td>
            <td class="texto_adm"><?php echo $f->fecha_termino;?></td>
            <td class="texto_adm"><?php echo $f->numero_horas;?></td>
            <td class="texto_adm"><?php echo $f->estado_envio;?></td>
            <td class="texto_adm"><a href="formulario_comunicacion.php?accion=eliminar&idForm=<?php echo $f->id ?>" >Eliminar</a></td>
            <td class="texto_adm"><a href="formulario_crear.php?accion=modificar&amp;idForm=<?php echo $f->id ?>">Modificar</a></td>
      </tr>
	
	<?php
	}
  	?>
</table>
</fieldset>
</body>
</html>
