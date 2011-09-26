<?php include_once ('../model/config.php');

class trabajador
{
	function conectar()
		{
			$config = new bd();
			$config -> conexion();
		}

	function addTrabajador($a)
		{
			$sqlRut = "SELECT * FROM insotic_trabajador WHERE rut = '$a[0]'";
			$this -> conectar();
			$r = mysql_query ($sqlRut);
			if(mysql_num_rows($r) != 0)
				echo "<script>alert('El trabajador ya existe.')</script>";
			else
				{
					$sql = "INSERT INTO insotic_trabajador(rut, nombres, apellido_paterno, apellido_materno, sexo, insotec_escolaridad_id)
						VALUES('$a[0]', '$a[1]', '$a[2]', '$a[3]', '$a[4]', '$a[5]')";
					$this -> conectar();
					if(mysql_query($sql))
						return true;
					else
						return false;
				}
		}

	function getTrabajador()
		{		
			$sql = "SELECT * FROM insotic_trabajador";
			$this -> conectar();
			$r = mysql_query($sql);
			if(mysql_num_rows($r) == 0)
				{
					echo "<script>alert('No tiene resultados la query de trabajadores.')</script>";
					die();
				}
			else
				{
					while ($f = mysql_fetch_object($r))
						{
							$aux = $f->sexo;
								if($aux=="m")
									$b='masculino';
								else
									$b='femenino';
								echo "<tr>";
									echo "<td>" .substr($f->rut, 0, 8) ." - " .substr($f->rut, -1, 1) ."</td>";
									echo "<td>$f->nombres</td>";
									echo "<td>$f->apellido_paterno</td>";
									echo "<td>$f->apellido_materno</td>";
									echo "<td>$b</td>";
									echo "<td>$f->insotec_escolaridad_id</td>";
									echo "<td><a class='eliminar' href='trabajadores.php?accion=eliminar&rut=$f->rut'></a></td>";
									echo "<td><a class='modificar' href='trabajadores.php?accion=modificar&rut=$f->rut'></a></td>";
								echo "</tr>";
						}
				}
		}

	function getTrabajadorByRut($rut)
		{
			$sql = "SELECT * FROM insotic_trabajador WHERE rut = '$rut'";
			$this -> conectar();
			$r = mysql_query($sql);
			if(mysql_num_rows($r) == 0)
				{
					echo "<script>alert('No tiene resultados la query de trabajadores.')</script>"; 
					die();
				}
			else
				return $r;
		}

	function deleteTrabajadoresByRut($rut)
		{
			$sql = "DELETE FROM insotic_trabajador WHERE rut = '$rut'";
			$this -> conectar();
			if(mysql_query($sql))
				echo "<script>alert('Se ha eliminado correctamente el trabajador seleccionado.')</script>";
			else
				echo "<script>alert('Se ha generado un error al eliminar el trabajador seleccionado.')</script>";
		}

	function updateTrabajador($rut, $a)
		{
			$sql = "UPDATE insotic_trabajador SET nombres = '$a[1]', apellido_paterno = '$a[2]' , apellido_materno = '$a[3]', 
				sexo = '$a[4]', insotec_escolaridad_id = '$a[5]' WHERE rut = '$rut'";
			$this -> conectar();
			if(mysql_query($sql))
				return true;
			else
				return false;
		}

	function seleccionaTrabajadoresCmb()
		{
			echo "<select name='sexo' id = 'sexo'>";
			echo "<option value='M' selected>masculino</option>";
			echo "<option value='F'>femenino</option>";
			echo "</select>";
		}

	function seleccionaTrabajadoresByRutCmb($rut)
		{
			$sql = "SELECT * FROM insotic_trabajador WHERE rut = '$rut'";
			$this->conectar();
			$r = mysql_query($sql);
			if (mysql_num_rows($r)==0)
				{
					echo "<select name='sexo' id='sexo'>";
					echo "</select>";
				}
			else
				{
					echo "<select name = 'sexo' id='sexo'>";
					while($f = mysql_fetch_object($r))
						{
							if($f->rut==$rut)
								{
									echo "<option value='M' selected>masculino</option>";
									echo "<option value='F'>femenino</option>";
								}
							else
								{
									echo "<option value='F' selected>femenino</option>";
									echo "<option value='M'>masculino</option>";
								}
            			}
					echo "</select>";
				}
		}
} ?>