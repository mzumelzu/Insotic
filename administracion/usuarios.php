<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Infotic</title>
<link rel="stylesheet" type="text/css" href="../css/menu.css">
<link rel="stylesheet" type="text/css" href="../css/administracion.css">

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
						/*echo "<script>window.open('usuarios.php','_self')</script>";*/
					}
				else
					{
						echo "<script>alert('Se ha generado un problema al modificar los datos del usuario')</script>";
						/*echo "<script>window.open('usuarios.php','_self')</script>";*/
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
<div id="titulo">Registro de Usuarios</div>
				<table class="uno">
					<tbody>
				    	<tr>
					    	<td><form action="usuarios.php" method="post" name="frmUsuario" id="frmUsuario">
						        <table class="dos">
						          	<tr>
						            	<td><div id="etiqueta">Nombre Usuario :</div></td>
							            <td>
											<input type="text" name="usuario" value="<?php echo $usuario;?>">
											<input type="hidden" name="id" value="<?php echo $_GET[id];?>">
										</td>
						          	</tr>
						          	<tr>
							            <td><div id="etiqueta">Clave Usuario :</div></td>
							            <td>
											<input type="text" name="clave" value="<?php echo $clave;?>" maxlength="6" size="6">
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
			<div id="mantencion">Mantenci&oacute;n de Usuarios</div>
			<div id="contenedorDos">
			<table class="tres">
				<tr>
			    	<th>ID</th>
				    <th>USUARIO</th>
                    <th>CLAVE</th>
                    <th>ELIMINAR</th>
                    <th>MODIFICAR</th>
				</tr>
			  	<?php
			 		include_once('../controller/class_usuario.php');
					$empresa = new usuario();
					$r = $empresa->getUsuarios();
					while ($f = mysql_fetch_object($r))
						{?>
							<tr>
                                <td><?php echo $f->id;?></td>
                                <td><?php echo $f->usuario;?></td>
                                <td><input type="password" readonly="readonly"  name="pass" value="<?php echo $f->clave;?>" ></td>
                                <td><a class="eliminar" href="usuarios.php?accion=eliminar&id=<?php echo $f->id;?>"></a></td>
                                <td><a class="modificar" href='usuarios.php?accion=modificar&id=<?php echo $f->id;?>'></a></td>
						  	</tr>
						<?php }
			  	?>
			</table>
	</div>
</body>
</html>