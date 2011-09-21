<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Crear Formulario</title>

<link rel="stylesheet" type="text/css" href="recursos/calendario/css/jquery-ui-1.7.2.custom.css" />
<link rel="stylesheet" type="text/css" href="recursos/autocompleta/jquery.autocomplete.css" />

<style>
#formulario{
margin-top:50px;
float:left;}
</style>

</head>
<?php

if (isset($_POST['guardar'])){ 
	
	include_once('../controller/class_formulario_comunicacion.php');
	$formulario = new FormularioComunicacion(); 
	
	$a[0] = 2;
	$a[1] = $_POST['fecha_formulario'];
	$a[2] = $_POST['rut'].'-'.$_POST['dv'];
	$a[3] = $_POST['nomFranc'];
	$a[4] = 2;
	$a[5] = $_POST['codCur'];
	$a[6] = 0;

	
	if ($formulario->addFormulario($a))
	{
			echo "<script>alert('Se han registrado correctamente los datos del formulario')</script>";
			echo "<script>document.location(\"formulario_pestanas.php?rut=1-9\");</script>";
	}
	else
	{
		echo "<script>alert('Se ha generado un problema al registrar el formulario')</script>";
	}
}

$fecha_actual= "".date("d")."/".date("m")."/".date("Y");

?>

<body>
<?php
	include('menu_administracion.php');	
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

    
<script type="text/javascript">


jQuery(function($){
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
});    

         $(document).ready(function() {
           $("#datepicker").datepicker({ appendText: ' Haga click para introducir una fecha' });
        });
    </script>


<script type='text/javascript' src='recursos/autocompleta/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	$("#course").autocomplete("recursos/autocompleta/get_course_list.php", {
		width: 260,
		matchContains: true,

		selectFirst: false
	});
});
</script>
<br>
<div id="formulario">
	<fieldset>
    <legend class="texto_adm_negrita">Crear Formulario </legend>
    <form action="formulario_crear.php" method="post" name="frmCrearFormulario" id="frmCrearFormulario"> 
	  <table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
  		<tbody>
	      <tr>
	        <td>
	          <table width="428" border="0" cellpadding="4" cellspacing="4">
	            <tr>
	              <td width="144" class="texto_adm" ><div align="left">Rut</div></td>
	              <td width="6" class="texto_adm"><div align="left">:</div></td>
	              <td width="203" ><div align="left">
	                <input name="rut" id="rut" value="<?php echo $rut;?>" style="width:150px" /> - <input name="dv" id="dv" value="<?php echo $dv;?>" style="width:30px"/>
	             
	                </div></td>
                </tr>
	            <tr>
	              <td class="texto_adm"><div align="left">Nombre o Razon Social</div></td>
	              <td class="texto_adm"><div align="left">:</div></td>
	              <td><div align="left">
                  <input name="nombre_razon_social" id="nombre_razon_social" value="<?php echo $nombre_razon_social;?>" style="width:200px" />
	                </div></td>
                </tr>
                <tr>
	              <td class="texto_adm"><div align="left">Fecha del Formulario</div></td>
	              <td class="texto_adm"><div align="left">:</div></td>
	              <td><div align="left">
                  <!--input name="fecha_formulario" id="fecha_formulario" value="<?php //echo $fecha_formulario; ?>" style="width:200px" /-->
                  <input  type="text" name="datepicker" id="datepicker" readonly="readonly" size="12" value="<?php echo $fecha_actual; ?>" />
	                </div>
                    </td>
                </tr>
                
                
                           <tr>
                	<td class="texti_adm"><div align="left">Tipo de Franquicia</div></td>
                    <td class="texto_adm"><div align="left">:</div></td>
                    <td class="texto_adm"><div align="left">
                    
                    <!--input name="nomFranc" id="nomFranc" value="<?php echo $nomFranc;?>" style="width:200px" /></div-->
                    
                    <?php 
					include_once('../controller/class_franquicia.php');
					
					$fran = new franquicia();
                    $r = $fran->seleccionaFranquiciaCmb();
	               //$fila = mysql_fetch_object($r); 
										?>
                      </div>                  
                    </td>
                    </tr>
                
                
                <tr>
                	<td class="texto_adm"><div align="left">Codigo del curso</div></td>
                    <td class="texto_adm"><div align="left">:</div></td>
                    <td class="texto_adm"><div align="left"><input type="text" name="course" id="course" /></div></td>
                </tr>
     
              </table>
	          <?php
			if ($_GET['accion']=='modificar')
			{ ?>
	          <input name="modificar" value="Modificar" type="submit" />
	          <input name="cancelar" value="Cancelar" type="submit" />
	          <?php 
			} 
		 	else
			{
		 		?>
                <br />
                <br />
                <br />
	          			<input name="guardar" value="Guardar" type="submit" />
                        
	          	<?php
		 	}
		 		?>
	         
              </td>
          </tr>
        </tbody>
      </table>
       </form>
</fieldset>
</div><!-- fin div formulario-->
</body>
</html>
