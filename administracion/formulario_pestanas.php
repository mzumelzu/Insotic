<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Crear Formulario</title>
 <link href="../css/pestanaMostrar.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" href="recursos/calendario/css/jquery-ui-1.7.2.custom.css" />
 <style>
.estilo_input{
color:#009999;
width:170px;
border:#009999;
border-width: 1px;
border-style: solid;}
 
 </style>
<!-- No es necesario que Exporten la Libreria Jquery(la exporte x que en este ejemplo no estoy usando el menu) ya que de porsi, se esta exportando previamente con el menu-->


    <!--esto es mi modificacion acá le puse más color -->
<script type="text/javascript">

$(document).ready(function() {

$(".tab_content").hide();
$("ul.navegacion li:first").addClass("active").show();
$(".tab_content:first").show();

	$("ul.navegacion li").click(function() 
	{
	
	$("ul.navegacion li").removeClass("active");
	$(this).addClass("active"); 
	$
	$(".tab_content").hide(); 
	var activeTab = $(this).find("a").attr("href"); 
	$(activeTab).fadeIn(); 
		return false;

	});

});
</script>


</head>

<?php
	include('menu_administracion.php');
	
?>

<?php 
	
	include_once('../controller/class_empresa.php');
	$empresa = new empresa();
	$rut = $_GET['rut'];
	
	$r = $empresa->getEmpresasByRut("1-9");
	$fila = mysql_fetch_object($r); 
	
	$rut_empresa = $fila->rut;
	echo "Rut : ".$rut_empresa;
	$nomORazonSocial = $fila->nombre;
	$direccion = $fila->direccion;
	$numDir = $fila->numero_direccion;
	$villPobl = $fila->nombre_villa_poblacion;
	$numOfi = $fila->numero_oficina;
	$email = $fila->email;
	$ciuEm = $fila->insotic_ciudad_id;
	$tipoDeCalle = $fila->insotic_tipo_direccion_id;
	$comunaId = $fila->insotic_comuna_id;
	$presentanteLegal = $fila->nombre_representante_legal;
	$fonoRepresentanteEmpresa = $fila->fono_representante_legal;
	$emailRepresentanteEmpresa = $fila->email_representante_legal;
	$gerenteRRHH = $fila->nombre_rrhh;
	$fonoGerenteRRHH = $fila->fono_rrhh;
	$emailGerenteRRHH = $fila->email_rrhh;
	$contEmp = $fila->contacto_capacitacion;
	$fonoContactoEmpresa = $fila->fono_contacto;
	$emailContactoEmpresa = $fila->email_contacto;
	$pagina_web = $fila->pagina_web;
	
	
	include_once('../controller/class_ciudad.php');
	$ciudades = new ciudades();
	$r = $ciudades->getCiudadById($ciuEm);
	$fila = mysql_fetch_object($r); 
	$ciudadEmpresa=$fila->nombre;
	
	include_once('../controller/class_tipo_calle.php');
	$calle = new TipoCalle();
	$r = $calle->getTipoCalleById($tipoDeCalle);
	$fila = mysql_fetch_object($r); 
	$tipCalle=$fila->nombre;

	include_once('../controller/class_comuna.php');
	$calle = new comunas();
	$r = $calle->getComunaById($comunaId);
	$fila = mysql_fetch_object($r); 
	$comunaEmpresa=$fila->nombre;
	
    include_once('../controller/class_formulario_comunicacion.php');
	$formulario = new FormularioComunicacion();
	$r = $formulario->getFormularioCabezeraPestañas(1);
	$fila = mysql_fetch_object($r); 
	$numformulario=$fila->id;
	$EstadoFormulario=$fila->estado_envio;
	$fechCreacionForm=$fila->fecha_formulario;
	$comiteBipartido=$fila->comite_bipartito;
	$deteccionNecesidades=$fila->deteccionNecesidades;
	$codigoActividad=$fila->codigo_curso;
	
	include_once('../controller/class_curso.php');
	$curso = new Curso();
	$r=$curso->getCursoByCod($codigoActividad);
	$fila = mysql_fetch_object($r); 
	$id_institucion = $fila->insotic_institucion_id;
	$nomCurso = $fila->nombre;
	$NumeroHoras = $fila->total_horas;
	
	include_once('../controller/class_institucion.php');
	$institucion = new Institucion();
	$r= $institucion-> getInstitucionById($id_institucion);
	$fila = mysql_fetch_object($r);
	$NomRazonInstitucion=$fila->nombre;
	$NomRazonInstitucionContacto = $fila->insotic_nombre_contacto;
	$telInstitucion = $fila->telefono1;
	$idComuna = $fila->insotic_comuna_id;
	$direccionInstitucion=$fila->direccion;
		
	include_once('../controller/class_comuna.php');
	$comunas = new comunas();
	$r= $comunas-> getComunaById($idComuna);
	$fila = mysql_fetch_object($r);
	$ComunaTipoInstitucion = $fila->nombre;
	$idCiudad = $fila->insotic_ciudad_id;
	
	include_once('../controller/class_ciudad.php');
	$ciudades = new ciudades();
	$r= $ciudades-> getCiudadById($idComuna);
	$fila = mysql_fetch_object($r);
	$CiudadInstitucion=$fila->nombre; 
	
?>
<body>
	  <table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
  		<tbody>
	      <tr>
	        <td>
            	<table width="1228" height="156" border="0" cellpadding="4" cellspacing="4">
                	<tr>
                    	<td width="348" class="texto_adm" ><div align="left">Nº de Formulario</div></td>
                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                        <td width="277" class="texto_adm"><div align="left"><?php echo $numformulario;?></div></td>
                        <td width="348" class="texto_adm" ><div align="left">Estado</div></td>
                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                        <td width="277"class="texto_adm" ><div align="left"><?php echo $EstadoFormulario;?></div></td>
                        <td width="348" class="texto_adm" ><div align="left">Fecha Envia</div></td>
                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                        <td width="277" class="texto_adm"><div align="left"><?php echo $fechEnvio;?></div></td>
                    </tr>
                    <tr>
                    	<td width="348" class="texto_adm" ><div align="left">Fecha</div></td>
                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                        <td width="277"class="texto_adm" ><div align="left"><?php echo $fechCreacionForm;?></div></td>
                        <td width="348" class="texto_adm" ><div align="left">Nº registro (SENCE)</div></td>
                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                        <td width="277" class="texto_adm"><div align="left"><?php echo $numRegSence;?></div></td>
                        <td width="348" class="texto_adm" ><div align="left">Fecha rectificacion</div></td>
                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                        <td width="277" class="texto_adm"><div align="left"><?php echo $fechRectificacion;?></div></td>
                    </tr>
                    <tr>
                    	<td width="348" class="texto_adm" ><div align="left"></div></td>
                        <td width="38" class="texto_adm"><div align="left"></div></td>
                        <td width="277" class="texto_adm"><div align="left"></div></td>
                        <td width="348" class="texto_adm" ><div align="left"></div></td>
                        <td width="38" class="texto_adm"><div align="left"></div></td>
                        <td width="277" class="texto_adm"><div align="left"></div></td>
                        <td width="348" class="texto_adm"><div align="left">Fecha Liquidacion</div></td>
                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                        <td width="277" class="texto_adm"><div align="left"><?php echo $fechLiquidacion;?></div></td>
                    </tr>
                </table>
            </td>
          </tr>
          </tbody>
       </table>         
<div id="margenPestañas" style="width:100%">
    	<ul class="navegacion">
        	<li id="EmpAfi" class="navegacion1" > <a href="#EmpresaAfiliada" class="active"> Empresa Afiliada </a></li>
            <li id ="ActCom" class="navegacion1"> <a href="#ActividadCapacitacion" class="active">Actividad de Capacitacion </a></li>
            <li id="VayFran" class="navegacion1"> <a href="#ValoresYFranquicias" class="active">Valores y Franquicias </a></li>
            <li id="par" class="navegacion1"> <a href="#Participantes" class="active">Participantes </a></li>
            <li id="liq" class="navegacion1"> <a href="#Liquidacion" class="active">Liquidacion</a></li>
        </ul></div>
        <div id="contenedorPestañas">
        	<ul id="EmpresaAfiliada" class="tab_content">
				<li>
               
               
               <?php 
			   // pestaña empresa
			   include('formulario_pestanas_empresa.php');
			   ?>
               
               
           
       		</li>
            </ul>
          <ul id="ActividadCapacitacion" class="tab_content">
            	<li>
                 <?php 
				 include('formulario_pestanas_actividad.php');
				 ?>
               	
            </li>
            </ul>
          <ul id="ValoresYFranquicias" class="tab_content">
            	<li>
                	  <div id="pestañas" style="width:100%"> <br /><br />
                        <table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                 <td>
                                 <table width="855" border="0" cellpadding="4" cellspacing="4" id="tablaDatos" style="width:100%">
                                     <tr>
                                        <td width="348" class="texto_adm" ><div align="left">Codigo Via</div></td>
                                        <td width="38" class="texto_adm"><div align="left">:</div></td>
                                        <td width="277" ><div align="left"></div></td>
                                        <td width="357" class="texto_adm" ><div align="left">Comite Bipartito</div></td>
                                        <td width="11" class="texto_adm"><div align="left">:</div></td>
                                        <td width="304" ><div align="left"><?php echo $comiteBipartido?></div></td>
                                        <td width="357" class="texto_adm" ><div align="left">Deteccion de Necesidades</div></td>
                                        <td width="11" class="texto_adm"><div align="left">:</div></td>
                                        <td width="304" ><div align="left"><?php echo $deteccionNecesidades?></div></td>
                                    </tr>
                                 </table>
                                </td>
                             </tr>
                            </tbody>
                          </table>	
                          <fieldset><legend class="texto_adm_negrita">Valores y Franquicias</legend>
                   		<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                             <td>
                             <table width="855" border="0" cellpadding="4" cellspacing="4" id="tablaDatos" style="width:100%">
                                 <tr>
                                 	<td width="348" class="texto_adm" ><div align="left">Valor Total del curso (pesos)</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="val_tot_cur" id="val_tot_cur" value="<?php echo $valorTotalCurso;?>" style="width:200px"></div></td>
                                 </tr>
                                 <tr>
                                    <td width="348" class="texto_adm" ><div align="left">Numero de horas</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><?php echo $numHrsCur;?></div></td>
                                 </tr>
                                 <tr>
                                    <td width="348" class="texto_adm" ><div align="left">Valor hora efectiva por Participante (pesos)</div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="val_hr_parti" id="val_hr_parti" value="<?php echo $valorHrParticipante;?>" style="width:200px"></div></td>
                                 </tr>
                                 <tr>
                                    <td width="348" class="texto_adm" ><div align="left">Valor total Viático y traslado (pesos) </div></td>
                                    <td width="38" class="texto_adm"><div align="left">:</div></td>
                                    <td width="277" ><div align="left"><input name="val_viatico_tras" id="val_viatico_tras" value="<?php echo $valViaticoTraslado;?>" style="width:200px"></div></td>
                                 </tr>
                                 <tr>
                                    <td width="348" class="texto_adm" ><div align="left">Justificacion del Valor total Viático, traslado y otro (pesos) </div></td>
              					 </tr>
                                 </table>
                                 <table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
                                    <td width="100%" height="66" ><div align="left"><textarea name="just_viat_tras_obs" id="just_viat_tras_obs" style="width:100%;" value="<?php echo $jusViatTrasObs;?>"  ></textarea></div></td>
                              </table>
                             </td>
                            </tr>
                           </tbody>
                          </table>
                          </fieldset>
                          </div>
            	</li>
            </ul>
             <ul id="Participantes" class="tab_content">
            	<li><br/><br/><br/>
                	<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                             <td>
                             <table  border="0"  id="tablaDatos" >
                                 <tr>
                                    <td ><div align="center">Rut</div></td>
                                    <td ><div align="center">Nombres</div></td>
                                    <td ><div align="center">Apellido Paterno</div></td>
                                    <td ><div align="center">Apellido Materno</div></td>
                                    <td ><div align="center">Beneficio</div></td>
                                    <td ><div align="center">Viatico</div></td>
                                    <td ><div align="center">Traslado</div></td>
                           	   </tr>
                               
                                <tr>
                                    <td ><input name="rut_empleado"  class="estilo_input" id="rut_empleado" value="<?php echo $rut_empleado;?>" ></td>
                                    <td ><input name="nombres_empleado" class="estilo_input" id="nombres_empleado" value="<?php echo $nombresEmpleado;?>" ></td>
                                    <td ><input name="apellido_Paterno_emp" class="estilo_input" id="apellido_Paterno_emp" value="<?php echo $apellidoPaternoEmp;?>" ></td>
                                    <td ><input name="apellido_Materno_emp" class="estilo_input" id="apellido_Materno_emp" value="<?php echo $apellidoMaternoEmp;?>" ></td>
                                    <td ><input name="beneficio_emp" class="estilo_input" id="beneficio_emp" value="<?php echo $beneficioEmp;?>" ></td>
                                    <td ><input name="viatico_emp"	class="estilo_input" id="viatico_emp" value="<?php echo $viaticoEmp;?>"></td>
                                    <td ><input name="traslado_emp" class="estilo_input" id="traslado_emp" value="<?php echo $trasladoEmp;?>"></td>
                                <div id="cont-archivos">
                               
                               </div><!-- fin div id="cont-archivos" -->
                                <a href="javascript:agregar_archivo('cont-imagenes');" class="link">Agregar Participante (+)</a><br />         	
                                    
                           	   </tr>
                               
                             </table>
                             </td>
                            </tr>
                       </tbody>
                      </table> 
                      
                      
                 </li>
            </ul>
             <ul id="Liquidacion" class="tab_content">
            	<li><br /><br />
                	
               </li>
            </ul>
  </div>
  </body>