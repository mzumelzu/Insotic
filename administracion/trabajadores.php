// jajajja

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
    	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type" />
		<title>Administracion de Empresas</title>
		<link href="../css/administracion.css" rel="stylesheet" type="text/css" />
		<?php include_once("properties/propiedades.php")?>
	</head>
	<?php
		if (isset($_POST['guardar']))
			{
				$a[0] = $_POST['rut'];
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
				$rut = $fila->rut;
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
	<?php
		include('menu_administracion.php');
	?>
	<br>
		<fieldset>
	        <legend class="texto_adm_negrita">Registro de Trabajadores</legend>
				<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
					<tbody>
				    	<tr>
					    	<td><form action="trabajadores.php" method="post" name="frmTrabajador" id="frmTrabajador">
						        <table width="652" border="0" cellpadding="4" cellspacing="4">
									<tr>
							            <td width="134" class="texto_adm" ><div align="left">RUT trabajador</div></td>
							            <td width="14" class="texto_adm"><div align="left">:</div></td>
							            <td width="202" ><div align="left"><input name="rut" value="<?php echo $rut;?>"<?php echo $readonly;?>></div></td>
						          	</tr>
						          	<tr>
						            	<td class="texto_adm" ><div align="left">Nombres del trabajador</div></td>
							            <td class="texto_adm"><div align="left">:</div></td>
							            <td ><div align="left"><input name="nombres" value="<?php echo $nombres;?>"></div></td>
						          	</tr>
						          	<tr>
							            <td class="texto_adm"><div align="left">Apellido paterno del trabajador</div></td>
							            <td class="texto_adm"><div align="left">:</div></td>
							            <td><div align="left"><input name="apellido_paterno" value="<?php echo $apellido_paterno;?>"></div></td>
							        </tr>
						          	<tr>
							            <td class="texto_adm"><div align="left">Apellido materno del trabajador</div></td>
							            <td class="texto_adm"><div align="left">:</div></td>
							            <td><div align="left"><input name="apellido_materno" value="<?php echo $apellido_materno;?>"></div></td>
							        </tr>
						          	<tr>
										<td class="texto_adm"><div align="left">Sexo</div></td>
							            <td class="texto_adm"><div align="left">:</div></td>
										<td><div align="left"><?php include_once('../controller/class_trabajador.php');
											$trabajadores = new trabajador();
												if ($_GET['accion']=='modificar')
													$trabajadores->seleccionaTrabajadoresByRutCmb($rut);
												else
													$trabajadores->seleccionaTrabajadoresCmb();
													?></div></td>
							        </tr>
						          	<tr>
							            <td class="texto_adm"><div align="left">ID escolaridad asociada al trabajador</div></td>
							            <td class="texto_adm"><div align="left">:</div></td>
							            <td><div align="left"><input name="insotec_escolaridad_id" value="<?php echo $insotec_escolaridad_id;?>" maxlength="1"></div></td>
							        </tr>
					        	</table>
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
								?></form>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		<br>
	<fieldset>
    	<legend class="texto_adm_negrita">Mantención de Trabajadores</legend>
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
			    	<th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">RUT</th>
				    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">NOMBRES</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">APELLIDO PATERNO</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">APELLIDO MATERNO</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">SEXO</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ID ESCOLARIDAD</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
				</tr>
			  	<?php
			 		include_once('../controller/class_trabajador.php');
					$trabajadores = new trabajador();
					$trabajadores->getTrabajador();
			  	?>
			</table>
	</fieldset>
</body>
</html>