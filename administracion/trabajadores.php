<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Infotic</title>
<link rel="stylesheet" type="text/css" href="../css/menu.css">
<link rel="stylesheet" type="text/css" href="../css/administracion.css">
		<?php include_once("properties/propiedades.php")?>
<script type="text/javascript" src="validacion/validaciones.js"></script>
	</head>
	<?php
		if (isset($_POST['guardar']))
			{
				include_once('validacion/validaciones.php');
				if(dv($_POST['rutAux']) == $_POST['dv'])
					{
						$a[0] = $_POST['rutAux'].$_POST['dv'];
						$a[1] = $_POST['nombres'];
						$a[2] = $_POST['apellido_paterno'];
						$a[3] = $_POST['apellido_materno'];
						$a[4] = $_POST['sexo'];
						$a[5] = $_POST['insotec_escolaridad_id'];
						include_once('../controller/class_trabajador.php');
						$trabajadores = new trabajador();
						if($trabajadores->addTrabajador($a))
							echo "<script>alert('Se han registrado correctamente los datos del trabajador.')</script>";
						else
							echo "<script>alert('Se ha generado un problema al registrar el trabajador.')</script>";
					}
				else
					echo "<script>alert('Rut no valido.')</script>";
			}

		if (isset($_POST['modificar']))
			{
				$rut =  $_POST['rut'];
				$a[1] = $_POST['nombres'];
				$a[2] = $_POST['apellido_paterno'];
				$a[3] = $_POST['apellido_materno'];
				$a[4] = $_POST['sexo'];
				$a[5] = $_POST['insotec_escolaridad_id'];
				include_once('../controller/class_trabajador.php');
				$trabajadores = new trabajador();
				if ($trabajadores->updateTrabajador($rut, $a))
					{
						echo "<script>alert('Se han modificado correctamente los datos solicitados')</script>";
					}
				else
					{
						echo "<script>alert('Se ha generado un problema al modificar los datos del trabajador')</script>";
					}
			}

		if ($_GET['accion']=='modificar')
			{
				$readonly = "readonly=readonly";
				include_once('../controller/class_trabajador.php');
				$trabajadores = new trabajador();
				$rutGet = $_GET['rut'];
				$r = $trabajadores->getTrabajadorByRut($rutGet);
				$fila = mysql_fetch_object($r);
				$rut = $fila -> rut;
				$nombres = $fila->nombres;
				$apellido_paterno = $fila->apellido_paterno;
				$apellido_materno = $fila->apellido_materno;
				$sexo = $fila->sexo;
				$insotec_escolaridad_id = $fila->insotec_escolaridad_id;
			}

		if ($_GET['accion']=='eliminar')
			{
				include_once('../controller/class_trabajador.php');
				$trabajadores = new trabajador();
				$rut = $_GET['rut'];
				$trabajadores->deleteTrabajadoresByRut($rut);
			}
	?>

<body>

<div id="header">
<div id="contenido">
<div id="logo"></div>
<div id="menu_header">
<?php include('menu_administracion.php'); ?>
</div><!-- fin menu_header -->
</div><!-- fin div contenido-->
</div><!-- fin div header-->
<div id="wrapper">
<div id="contenedor">
<div id="titulo">Registro de Trabajadores</div>
<?php
$rutAux = substr($rut, 0, 8);
$dv = substr($rut, -1, 1);
?>
				<table class="uno">
					<tbody>
				    	<tr>
					    	<td><form action="trabajadores.php" method="post" name="frmTrabajador" id="frmTrabajador">
						        <table class="dos">
			<tr>
			<td><div id="etiqueta">RUT trabajador :</div></td>
			<td>
<input type="text" name="rutAux" style="width:112px" value="<?php echo $rutAux;?>"<?php echo $readonly;?> onkeypress="return validar_numeric(event)" maxlength="8" size="8"> - 
<input type="text" name="dv" style="width:20px" value="<?php echo $dv;?>" maxlength="1" size="1" onkeypress="return validar_numeric_k(event)">
<input type="hidden" name="rut" style="width:112px" value="<?php echo $rut;?>"<?php echo $readonly;?>" maxlength="8" size="8">
</div></td>
			</tr>
			<tr>
				<td><div id="etiqueta">Nombres del Trabajador :</div></td>
				<td>
					<input type="text" name="nombres" value="<?php echo $nombres;?>">
				</td>
			</tr>
			<tr>
				<td><div id="etiqueta">Apellido Paterno :</div></td>
				<td>
					<input type="text" name="apellido_paterno" value="<?php echo $apellido_paterno;?>">
				</td>
			</tr>
			<tr>
				<td><div id="etiqueta">Apellido Materno :</div></td>
				<td>
					<input type="text" name="apellido_materno" value="<?php echo $apellido_materno;?>">
				</td>
			</tr>
			<tr>
				<td><div id="etiqueta">Sexo :</div></td>
				<td><div class="styled-select">
					<?php include_once('../controller/class_trabajador.php');
					$trabajadores = new trabajador();
						if ($_GET['accion']=='modificar')
							$trabajadores->seleccionaTrabajadoresByRutCmb($rut);
						else
							$trabajadores->seleccionaTrabajadoresCmb();
							?>
				</div></td>
			</tr>
			<tr>
				<td><div id="etiqueta">ID Escolaridad Trabajador :</div></td>
				<td>
					<?php
                		include_once('../controller/class_escolaridad.php');
						$escolaridad = new Escolaridad();
						if ($_GET['accion']=='modificar')
							$escolaridad->seleccionaEscolaridadTrabByIdCmb($insotec_escolaridad_id);
						else
							$escolaridad->seleccionaEscolaridadTrabCmb();
					?>
				</td>
			</tr>
		<tr>
		<td colspan="2">
		<?php
			if ($_GET['accion']=='modificar')
				{?>
					<input name="modificar" value="Modificar" type="submit">
					<input name="cancelar" value="Cancelar" type="submit">
			<?php } 
			else
				{?>
					<input name="guardar" value="Guardar" type="submit">
			<?php }
		?>
		</td>
		</tr>
		</table>
		</form>
							</td>
						</tr>
					</tbody>
				</table>
    	<div id="mantencion">Mantenci&oacute;n de Trabajadores</div>
		<div id="contenedorDos">
			<table class="tres">
				<tr>
			    	<th>RUT</th>
				    <th>NOMBRES</th>
                    <th>APELLIDO PATERNO</th>
                    <th>APELLIDO MATERNO</th>
                    <th>SEXO</th>
                    <th>ID ESCOLARIDAD</th>
                    <th>ELIMINAR</th>
                    <th>MODIFICAR</th>
				</tr>
			  	<?php
			 		include_once('../controller/class_trabajador.php');
					$trabajadores = new trabajador();
					$trabajadores->getTrabajador();
			  	?>
			</table>
	</div>

</div><!-- fin div conetendor-->
<div id="footer">
</div><!--fin div footer-->
</div><!-- fin div wrapper-->	
	
</body>
</html>