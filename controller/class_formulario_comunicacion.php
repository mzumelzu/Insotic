<?php
include_once ('../model/config.php');
class FormularioComunicacion
{
	
	function conectar()
	{
		$config = new bd();
		$config->conexion();
	}
	//$array[0] = nro_formulario
	//$array[1] = Fecha Formulario
	//$array[2] = Rut
	//$array[3] = codigo_Franquicia
	//$array[4] = tipoCalle
	//$array[5] = idCurso
	//$array[6] = Estado de envio
	
	function getFormulario()
	{
		$sql = "select * from insotic_formulario";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) 
		{
			echo "<script>alert('No tiene resultados la query de empresas')</script>"; 
			die();
		} 
		else 
		{
			return $r;
		}		
	}

	function addFormulario($a)
	{
		//$sql = "INSERT INTO insotic_formulario (id,fecha_formulario,insotic_empresa_rut,insotic_tipo_franquicia_id,dir_ejecucion_insotic_tipo_calle_id,insotic_curso_id,estado_envio					
				//	) VALUES (".$a[0].",".$a[1]."', '".$a[2]."',".$a[3].",".$a[4].",".$a[5].",".$a[6].")	";
		
		
		$sql = "INSERT INTO  insotic.insotic_formulario (
id ,
fecha_formulario ,
insotic_empresa_rut ,
insotic_tipo_franquicia_id ,
dir_ejecucion_insotic_tipo_calle_id ,
codigo_curso ,
fecha_inicio ,
fecha_termino ,
valor_total_curso ,
numero_horas ,
valor_hora_efectivo ,
valor_viaticos_traslados ,
justificacion_viaticos ,
dir_ejecucion_direccion ,
dir_ejecucion_numero ,
dir_ejecucion_nombre_villa ,
dir_direccion_numero_oficina ,
tipo_formulario ,
comite_bipartito ,
deteccion_necesidades ,
insotic_curso_id ,
estado_envio
)
VALUES (
'40',  '2011-08-18',  '1-4',  '1',  '3', NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , '0',  '0',  '0',  '0'
)";
		
		$this->conectar();
		if (mysql_query ($sql))
		{
			return true;
			echo "<script>alert('No tiene resultados la query de empresas')</script>";
		}
		else
		{
			return false;
		}				
	}
	function deleteformComById($id)
	{
		$sql = "delete from insotic_formulario where id=".$id."";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente el formulario seleccionado')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar el formulario seleccionado')</script>";
		}
	}
	
	function getFormularioCabezeraPestañas($id)
	{
		$sql = "select id,fecha_formulario,estado_envio,codigo_curso,comite_bipartito,deteccion_necesidades from  insotic_formulario where id=$id";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) 
		{
			echo "<script>alert('No tiene resultados la query de Formulario')</script>"; 
			die();
		} 
		else 
		{
			return $r;
		}		
	}
	function updateFormulario($id, $a)
	{
		$sql = "update insotic_formulario 
				set fecha_inicio= $a[0],
					fecha_termino=a[1],
					dir_ejecucion_direccion = a[2],
					dir_ejecucion_insotic_tipo_calle_id = a[3],
					dir_ejecucion_numero = a[4],
					dir_direccion_numero_oficina = a[5],
					dir_ejecucion_nombre_villa = a[6] " .
					" where id= $id";
		$this->conectar();
		if(mysql_query ($sql))
		{
			return true;
			
		} 
		else
		{
			return false;
	
		}
	}
		
}
	
?>