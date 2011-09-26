<?php include_once ('../model/config.php');

class usuario
{
	function conectar()
		{
			$config = new bd();
			$config->conexion();
		}

	function addUsuario($a)
		{
			$sqlUsuario = "SELECT * FROM insotic_usuario WHERE usuario='$a[1]'";
			$this->conectar();
			$r = mysql_query ($sqlUsuario);
			if(mysql_num_rows($r)!=0)
				echo "<script>alert('El usuario ya existe.')</script>";
			else
				{
					if(!preg_match('/^.*(?=.{6})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/', $a[2]))
						echo "<script>alert('La contrasena debe ser de 6 caracteres y alfanumerico')</script>";
					else
						{
							$sql = "INSERT INTO insotic_usuario (id, usuario, clave) VALUES('$a[0]', '$a[1]', '$a[2]')";
							$this->conectar();
							if(mysql_query ($sql))
								return true;
							else
								return false;
						}
				}
		}

	function getUsuarios()
		{
			$sql = "SELECT * FROM insotic_usuario";
			$this->conectar();
			$r = mysql_query ($sql);
			if(mysql_num_rows($r)==0)
				{
					echo "<script>alert('No tiene resultados la query de usuarios.')</script>";
					die();
				}
			else
				return $r;
		}

	function getUsuarioById($id)
		{
			$sql = "SELECT * FROM insotic_usuario WHERE id='$id'";
			$this->conectar();
			$r = mysql_query ($sql);
			if(mysql_num_rows ($r)==0)
				{
					echo "<script>alert('No tiene resultados la query de usuarios.')</script>"; 
					die();
				}
			else
				return $r;
		}

	function deleteUsuariosById($id)
		{
			$sql = "DELETE FROM insotic_usuario WHERE id='$id'";
			$this->conectar();
			if(mysql_query ($sql))
				echo "<script>alert('Se ha eliminado correctamente el usuario seleccionado.')</script>";
			else
				echo "<script>alert('Se ha generado un error al eliminar el usuario seleccionado.')</script>";
		}

	function updateUsuario($id, $a)
		{
			$sqlUsuario = "SELECT * FROM insotic_usuario WHERE usuario='$a[1]' and id='$id'";
			$this->conectar();
			$r = mysql_query ($sqlUsuario);
			if(!mysql_num_rows($r)!=0)
				echo "<script>alert('El nombre de usuario ya existe.')</script>";
			else
				{
					if(!preg_match('/^.*(?=.{6})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/', $a[2]))
						echo "<script>alert('La contrasena debe ser de 6 caracteres y alfanumerico')</script>";
					else
						{
							$sql = "UPDATE insotic_usuario SET usuario = '$a[1]', clave = '$a[2]' WHERE id = '$id'";
							$this->conectar();
							if(mysql_query ($sql))
								return true;
							else
								return false;
						}
				}
		}
} ?>