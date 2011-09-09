<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Sistema de Gestión</title>
<link href="../css/administracion.css" rel="stylesheet" type="text/css" />
</head>
<?php

	if ($_POST['ingresar']){	
		include_once("../controller/class_login.php");
		$login = new acceso();
		if ($login->valida_usuario($_POST['usuario'], $_POST['clave'])){	
			echo "<script>window.open('administracion.php','_self')</script>";
		} else {	
			echo "<script>window.open('index.php?error=login','_self')</script>";
		}
		
	}

	
	if ($_GET['error']=='login')
	{	
			$error_login = "Nombre de usuario o contraseña inválidos.";
	}

?>
<body onload="document.form1.usuario.focus()">
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <span class="texto_adm_negrita">Acceso a Sistema de Gestion Otic</span><br />
    <br />
	<?php
			include_once("properties/propiedades.php");
			echo $LOGO_APP;
	
	?>
    <table width="28%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <th class="texto_adm" scope="col"><div align="left">Usuario</div></th>
        <th class="texto_adm" scope="col"><div align="left">:</div></th>
        <th class="texto_adm" scope="col"><div align="left">
          <label>
          <input type="text" name="usuario" value="clorca"/>
          </label>
        </div></th>
      </tr>
      <tr>
        <td class="texto_adm"><div align="left">Clave</div></td>
        <td class="texto_adm"><div align="left">:</div></td>
        <td class="texto_adm"><div align="left">
          <label>
          <input type="password" name="clave" value="1234"/>
          </label>
        </div></td>
      </tr>
      <tr>
        <td><div align="left"></div></td>
        <td><div align="left">
          <label></label>
        </div></td>
        <td><div align="left">
          <input name="ingresar" type="submit" id="ingresar" value="Ingresar" />
        </div></td>
      </tr>
      </table>
    <p class="error_login"><?php echo $error_login;?></p>
  </div>
</form>
</body>
</html>
