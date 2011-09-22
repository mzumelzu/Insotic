<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
  <title>Administracion de Instituciones</title>
  <link href="../css/administracion.css" rel="stylesheet" type="text/css" />
  
 
<?php include_once("properties/propiedades.php")?>
<?php include_once("validaciones.php")?>




<link rel="stylesheet" type="text/css" href="css/flexigrid.css" />
<script type="text/javascript" src="jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="flexigrid.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#flex1").flexigrid
			(
			{
			url: 'post2.php',
			dataType: 'json',
			colModel : [
				{display: 'RUT', name : 'id', width : 40, sortable : true, align: 'center'},
				{display: 'Apellido paterno', name : 'rut_trabajador', width : 90, sortable : true, align: 'center'},
				{display: 'Apellido materno', name : 'rut_empresa', width : 90, sortable : true, align: 'left'},
				{display: 'Nombres', name : 'id_grupo_operacional', width : 80, sortable : true, align: 'left'},
				{display: 'Sexo', name : 'id_region', width : 30, sortable : true, align: 'left'},
				{display: 'Fec. nacimiento', name : 'estado', width : 80, sortable : true, align: 'right'},
				{display: 'Región de desempeño', name : 'id_region', width : 120, sortable : true, align: 'left'},
				{display: 'Escolaridad', name : 'estado', width : 80, sortable : true, align: 'left'},
				{display: 'Grp. oper', name : 'id_grupo_operacional', width : 100, sortable : true, align: 'left'},
				],
			buttons : [
				{name: 'Agregar', bclass: 'add', onpress : test},
				{name: 'Eliminar', bclass: 'delete', onpress : test},
				{separator: true},
				{name: 'A', onpress: sortAlpha},
                {name: 'B', onpress: sortAlpha},
				{name: 'C', onpress: sortAlpha},
				{name: 'D', onpress: sortAlpha},
				{name: 'E', onpress: sortAlpha},
				{name: 'F', onpress: sortAlpha},
				{name: 'G', onpress: sortAlpha},
				{name: 'H', onpress: sortAlpha},
				{name: 'I', onpress: sortAlpha},
				{name: 'J', onpress: sortAlpha},
				{name: 'K', onpress: sortAlpha},
				{name: 'L', onpress: sortAlpha},
				{name: 'M', onpress: sortAlpha},
				{name: 'N', onpress: sortAlpha},
				{name: 'O', onpress: sortAlpha},
				{name: 'P', onpress: sortAlpha},
				{name: 'Q', onpress: sortAlpha},
				{name: 'R', onpress: sortAlpha},
				{name: 'S', onpress: sortAlpha},
				{name: 'T', onpress: sortAlpha},
				{name: 'U', onpress: sortAlpha},
				{name: 'V', onpress: sortAlpha},
				{name: 'W', onpress: sortAlpha},
				{name: 'X', onpress: sortAlpha},
				{name: 'Y', onpress: sortAlpha},
				{name: 'Z', onpress: sortAlpha},
				{name: '#', onpress: sortAlpha}

				],
			searchitems : [
				{display: 'id', name : 'id'},
				{display: 'Apellido paterno', name : 'rut_trabajador', isdefault: true}
				],
			sortname: "id",
			sortorder: "asc",
			usepager: true,
			title: 'Nómina empleados',
			useRp: true,
			rp: 10,
			showTableToggleBtn: true,
			width: 820,
			height: 255
			}
			);   
	
});
function sortAlpha(com)
			{ 
			jQuery('#flex1').flexOptions({newp:1, params:[{name:'letter_pressed', value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});
			jQuery("#flex1").flexReload(); 
			}

function test(com,grid)
{
    if (com=='Eliminar')
        {
           if($('.trSelected',grid).length>0){
		   if(confirm('Eliminar ' + $('.trSelected',grid).length + ' items?')){
            var items = $('.trSelected',grid);
            var itemlist ='';
        	for(i=0;i<items.length;i++){
				itemlist+= items[i].id.substr(3)+",";
			}
			$.ajax({
			   type: "POST",
			   dataType: "json",
			   url: "delete.php",
			   data: "items="+itemlist,
			   success: function(data){
			   	alert("Query: "+data.query+" - Filas Afectas: "+data.total);
			   $("#flex1").flexReload();
			   }
			 });
			}
			} else {
				return false;
			} 
        }
    else if (com=='Agregar')
        {
            alert('Accion de Agregar Nuevo Item');
           
        }            
} 
</script>

</head>
<?php

//@author Nicolás Palma Silva
/*

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
	
	include_once('../controller/class_nomina.php');
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
*/
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
<?php
	include('menu_administracion.php');
	
?>
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

<table id="flex1" style="display:none"></table>


</fieldset>
</body>
</html>
