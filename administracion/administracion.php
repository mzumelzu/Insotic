<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Administracion de Empresas</title>
  <link href="../css/administracion.css" rel="stylesheet" type="text/css">
  
 
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

</body>
</html>
