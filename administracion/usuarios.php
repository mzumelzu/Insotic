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
				$a[0] = $_POST['id'];
				$a[1] = $_POST['usuario'];
				$a[2] = $_POST['clave'];
				include_once('../controller/class_usuario.php');
				$empresa = new usuario();
				if($empresa->addUsuario($a))
					echo "<script>alert('Se han registrado correctamente los datos del usuario.')</script>";
				else
					echo "<script>alert('Se ha generado un problema al registrar el usuario.')</script>";
			}

		if (isset($_POST['modificar']))
			{
				$id =  $_POST['id'];
				$a[1] = $_POST['usuario'];
				$a[2] = $_POST['clave'];
				include_once('../controller/class_usuario.php');
				$empresa = new usuario();
				if ($empresa->updateUsuario($id, $a))
					{
						echo "<script>alert('Se han modificado correctamente los datos solicitados')</script>";
						echo "<script>window.open('usuarios.php','_self')</script>";
					}
				else
					{
						echo "<script>alert('Se ha generado un problema al modificar los datos del usuario')</script>";
						echo "<script>window.open('usuarios.php','_self')</script>";
					}
			}

		if ($_GET['accion']=='modificar')
			{
				$readonly = "readonly=readonly";
				include_once('../controller/class_usuario.php');
				$empresa = new usuario();
				$id = $_GET['id'];
				$r = $empresa->getUsuarioById($id);
				$fila = mysql_fetch_object($r); 
				$usuario = $fila->usuario;
				$clave = $fila->clave;
			}

		if ($_GET['accion']=='eliminar')
			{
				include_once('../controller/class_usuario.php');
				$empresa = new Usuario();
				$id = $_GET['id'];
				$empresa->deleteUsuariosById($id);
			}
	?>

<body onLoad="document.frmUsuario.id.focus();">
	<?php
		include('menu_administracion.php');
	?>
	<br>
		<fieldset>
	        <legend class="texto_adm_negrita">Registro de Usuarios</legend>
				<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">
					<tbody>
				    	<tr>
					    	<td><form action="usuarios.php" method="post" name="frmUsuario" id="frmUsuario">
						        <table width="652" border="0" cellpadding="4" cellspacing="4">
									<tr>
							            <td width="134" class="texto_adm" ><div align="left">ID usuario</div></td>
							            <td width="14" class="texto_adm"><div align="left">:</div></td>
							            <td width="202" ><div align="left"><input name="id" value="<?php echo $id;?>" <?php echo $readonly;?>><input type="hidden" name="id" value="<?php echo $_GET[id];?>"></div></td>
						          	</tr>
						          	<tr>
						            	<td class="texto_adm" ><div align="left">Nombre usuario</div></td>
							            <td class="texto_adm"><div align="left">:</div></td>
							            <td ><div align="left"><input name="usuario" value="<?php echo $usuario;?>"></div></td>
						          	</tr>
						          	<tr>
							            <td class="texto_adm"><div align="left">Clave usuario</div></td>
							            <td class="texto_adm"><div align="left">:</div></td>
							            <td><div align="left"><input name="clave" value="<?php echo $clave;?>" maxlength = "6"></div></td>
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
    	<legend class="texto_adm_negrita">Mantención de Usuarios</legend>
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
			    	<th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ID</th>
				    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">USUARIO</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">CLAVE</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">ELIMINAR</th>
                    <th bgcolor="#CCCCCC" class="texto_adm_negrita" scope="col">MODIFICAR</th>
				</tr>
			  	<?php
			 		include_once('../controller/class_usuario.php');
					$empresa = new usuario();
					$r = $empresa->getUsuarios();
					while ($f = mysql_fetch_object($r))
						{?>
							<tr>
                                <td class="texto_adm"><?php echo $f->id;?></td>
                                <td class="texto_adm"><?php echo $f->usuario;?></td>
                                <td class="texto_adm"><input type = "password" readonly="readonly"  name="pass" value="<?php echo $f->clave;?>" ></td>
                                <td class="texto_adm"><a href="usuarios.php?accion=eliminar&id=<?php echo $f->id;?>">Eliminar</a></td>
                                <td class="texto_adm"><a href='usuarios.php?accion=modificar&id=<?php echo $f->id;?>'>Modificar</a></td>
						  	</tr>
						<?php }
			  	?>
			</table>
	</fieldset>
</body>
</html>