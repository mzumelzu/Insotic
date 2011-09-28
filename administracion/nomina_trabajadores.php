<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
  <title>Administracion de Instituciones</title>
  <link href="../css/administracion.css" rel="stylesheet" type="text/css" />
  
 
<?php include_once("properties/propiedades.php")?>
<?php include_once("validacion/validaciones.php")?>

<?php
	include('menu_administracion.php');	
?>

<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="js/jquery.jqGrid.src.js" type="text/javascript"></script>
<script type = "text/javascript">



jQuery(document).ready(function(){
jQuery("#list").jqGrid({
url:'server.php',
datatype: "json",
mtype: 'GET',
colNames:['Inv ID','Inv Date','Client ID','Amount','Tax','Total', 'Note'],
colModel:[
       {name:'invid', index:'invid', width:55, align:'center',
              searchoptions:{sopt:['eq','ne','lt','le','gt','ge','bw','ew','cn','nc']},
              editable:false},
       {name:'invdate', index:'invdate', width: 90, align:'center',
              searchoptions:{sopt:['eq','ne','lt','le','gt','ge','bw','ew','cn','nc']},
              editable:true},
       {name:'client_id', index:'client_id', width: 90, align:'center',
              searchoptions:{sopt:['eq','ne','lt','le','gt','ge','bw','ew','cn','nc']},
              editable:true},
       {name:'amount', index:'amount', width:80, align:'center',
              searchoptions:{sopt:['eq','ne','lt','le','gt','ge','bw','ew','cn','nc']},
              editable:true},
       {name:'tax', index:'tax', width:80, align:'center',
              searchoptions:{sopt:['eq','ne','lt','le','gt','ge','bw','ew','cn','nc']},
              editable:true},
       {name:'total', index:'total', width:80, align:'center',
              searchoptions:{sopt:['eq','ne','lt','le','gt','ge','bw','ew','cn','nc']},
              editable:true},
       {name:'note', index:'note', width:150, align:'left',
              searchoptions:{sopt:['eq','ne','lt','le','gt','ge','bw','ew','cn','nc']},
              editable:true},
       ],
rowNum: 10,
rowList:[10,20,30],
autowidth: true,
height: "100%",
pager: '#pager',
sortname: 'invid',
viewrecords: true,
sortorder: "asc",
caption:"Insotic empleados",
editurl:"edit.php"
});
jQuery("#list").jqGrid('navGrid','#pager',{edit:true,add:true,del:true});
});
</script>


<link rel="stylesheet" type="text/css" media="screen" href="css/excite-bike/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />

</head>

<?php

if ($_GET['accion']=='buscar'){
	$readonly = "readonly=readonly";
	include_once('../controller/class_nomina.php');
	$empresa = new empresa();
	$rut = $_POST['rutt'];
	$r = $empresa->getEmpresaByRut($rut);
	$fila = mysql_fetch_object($r); 
	$rut = $fila->rut;
	$contacto_capacitacion = $fila->contacto_capacitacion;
	$nombre_rrhh = $fila->nombre_rrhh;
	$nombre = $fila->nombre;
	$telefono_1 = $fila->telefono_1;
	$fono_rrhh = $fila->fono_rrhh;
}		

?>


<body onLoad="document.frmInstitucion.id_institucion.focus();">

<br>
<fieldset><legend class="texto_adm_negrita">Institución</legend>
<table style="text-align: left; width: 100%;" border="0" cellpadding="0"
 cellspacing="0">
  <tbody>
    <tr>
      <td><form action="nomina_trabajadores.php?accion=buscar" method="post" name="frmInstitucion" id="frmInstitucion">
        <table width="1094" border="0" cellpadding="4" cellspacing="4">
          <tr>	
            <td width="95" class="texto_adm" ><div align="left">Rut empresa </div></td>
            <td width="6" class="texto_adm"><div align="left">:</div></td>
            <td width="301" ><div align="left">
              <input name="rutt" style="width:150px" value="<?php echo $rut;?>" maxlength="9">
-              
<input name="verificador" style=" width:31px" value="<?php echo $verificador; ?>" maxlength="1"/>
            </div></td>
            <td width="144" class="texto_adm" ><div align="left">Nombre o raz&oacute;n social </div></td>
            <td width="6" class="texto_adm"><div align="left">:</div></td>
            <td width="466" class="texto_adm"><?php echo $nombre;?></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Contacto</div></td>
            <td class="texto_adm"><div align="left">:</div></td>
            <td class="texto_adm"><div align="left"><?php echo $contacto_capacitacion;?>
            </div></td>
            <td class="texto_adm" ><div align="left">Tel&eacute;fono</div></td>
            <td width="6" class="texto_adm"><div align="left">:</div></td>
            <td class="texto_adm"><?php echo $telefono_1;?></td>
          </tr>
          <tr>
            <td class="texto_adm" ><div align="left">Gerente RRHH </div></td>
            <td class="texto_adm" ><div align="left">:</div></td>
            <td class="texto_adm"><?php echo $nombre_rrhh; ?></td>
            <td class="texto_adm" ><div align="left">Tel&eacute;fono Gerente RRHH </div></td>
            <td width="6" class="texto_adm"><div align="left">:</div></td>
            <td class="texto_adm"><?php echo $fono_rrhh;?></td>
          </tr>
		<td class="texto_adm"><input type="submit" name="rut" style="width:150px" value="Buscar" maxlength="9"></td>
        </table>
            </form>
     </td>
    </tr>
  </tbody>
</table>
</fieldset>
<br>
<fieldset><legend class="texto_adm_negrita">Nómina empleados</legend>

<table id="list"></table>
<div id = "pager"></div>

</fieldset>
</body>
</html>
