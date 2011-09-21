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
					if($a[4]=='masculino')
						$b=0;
					else
						$b=1;
					$sql = "INSERT INTO insotic_trabajador(rut, nombres, apellido_paterno, apellido_materno, sexo, insotec_escolaridad_id)
						VALUES('$a[0]', '$a[1]', '$a[2]', '$a[3]', $b, '$a[5]')";
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
								if($aux==0)
									$b='masculino';
								else
									$b='femenino';
								echo "<tr>";
									echo "<td class='texto_adm'>$f->rut</td>";
									echo "<td class='texto_adm'>$f->nombres</td>";
									echo "<td class='texto_adm'>$f->apellido_paterno</td>";
									echo "<td class='texto_adm'>$f->apellido_materno</td>";
									echo "<td class='texto_adm'>$b</td>";
									echo "<td class='texto_adm'>$f->insotec_escolaridad_id</td>";
									echo "<td class='texto_adm'><a href='trabajadores.php?accion=eliminar&rut=$f->rut'>Eliminar</a></td>";
									echo "<td class='texto_adm'><a href='trabajadores.php?accion=modificar&rut=$f->rut'>Modificar</a></td>";
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
			if($a[4]=='masculino')
				$b=0;
			else
				$b=1;
			$sql = "UPDATE insotic_trabajador SET nombres = '$a[1]', apellido_paterno = '$a[2]' , apellido_materno = '$a[3]', 
				sexo = $b, insotec_escolaridad_id = '$a[5]' WHERE rut = '$rut'";
			$this -> conectar();
			if(mysql_query($sql))
				return true;
			else
				return false;
		}

	function seleccionaTrabajadoresCmb()
		{
			echo "<select name='sexo' style='width:158px' id = 'sexo'>";
			echo "<option value='masculino' selected>masculino</option>";
			echo "<option value='femenino'>femenino</option>";
			echo "</select>";
		}

	function seleccionaTrabajadoresByRutCmb($rut)
		{
			$sql = "SELECT * FROM insotic_trabajador WHERE rut = '$rut'";
			$this->conectar();
			$r = mysql_query($sql);
			if (mysql_num_rows($r)==0)
				{
					echo "<script>alert('La consulta de trabajadores no tiene resultados')</script>";
					die();
				}
			else
				{
					echo "<select name = 'sexo' id='sexo' style='width:158px'>";
					while($f = mysql_fetch_object($r))
						{
							if($f->rut==$rut)
								{
									if($f->sexo==0)
										{
											echo "<option value='masculino' selected>masculino</option>";
											echo "<option value='femenino'>femenino</option>";
										}
									else
										{
											echo "<option value='femenino' selected>femenino</option>";
											echo "<option value='masculino'>masculino</option>";
										}
								}
            			}
					echo "</select>";
				}
		}
} ?>