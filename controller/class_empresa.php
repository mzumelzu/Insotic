<?php
include_once ('../model/config.php');

class empresa{
	
	function conectar(){
		$config = new bd();
		$config->conexion();
	}

	//$array[0] = rut
	//$array[1] = numero_trabajadores
	//$array[2] = nombre
	//$array[3] = direccion
	//$array[4] = numero_direccion
	//$array[5] = nombre_villa_poblacion
	//$array[6] = numero_oficina
	//$array[7] = telefono_1
	//$array[8] = telefono_2
	//$array[9] = fax
	//$array[10] = email
	//$array[11] = insotec_ciudad_id
	//$array[12] = insotic_actividada_economica_id
	//$array[13] = insotic_tipo_direccion_id
	//$array[14] = insotic_comuna_id	
	//$array[15] = nombre_representante_legal
	//$array[16] = fono_representante_legal
	//$array[17] = email_representante_legal
	//$array[18] = nombre_rrhh
	//$array[19] = fono_rrhh
	//$array[20] = email_rrhh
	//$array[21] = contacto_capacitacion
	//$array[22] = fono_contacto
	//$array[23] = email_contacto
	//$array[24] = pagina_web

	function addEmpresa($a){
		$sql = "INSERT INTO insotic_empresa (
					rut ,
					numero_trabajadores ,
					nombre ,
					direccion ,
					numero_direccion ,
					nombre_villa_poblacion ,
					numero_oficina ,
					telefono_1 ,
					telefono_2 ,
					fax ,
					email ,
					insotic_ciudad_id ,
					insotic_actividad_economica_id ,
					insotic_tipo_direccion_id ,
					insotic_comuna_id,
					nombre_representante_legal,
					fono_representante_legal,
					email_representante_legal,
					nombre_rrhh,
					fono_rrhh,
					email_rrhh,
					contacto_capacitacion,
					fono_contacto,
					email_contacto,
					pagina_web
					)
					VALUES (
					'$a[0]', '$a[1]' , '$a[2]' , '$a[3]' , '$a[4]' , '$a[5]' , '$a[6]' , 
					'$a[7]' , '$a[8]' , '$a[9]' , '$a[10]' , '$a[11]', '$a[12]', '$a[13]', '$a[14]',
					'$a[15]' , '$a[16]' , '$a[17]' , '$a[18]' , '$a[19]', '$a[20]', '$a[21]', '$a[22]',
					'$a[23]','$a[24]')	";
		$this->conectar();
		if (mysql_query ($sql)){
			return true;}
		else{
			return false;
		}				
	}
	
	function getEmpresas(){
		$sql = "select * from insotic_empresa order by nombre asc";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de empresas')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}
	
	function getEmpresasByRut($rut){
		$sql = "select * from insotic_empresa where rut='$rut'";
		$this->conectar();
		$r = mysql_query ($sql);
		if (mysql_num_rows($r)==0) {
			echo "<script>alert('No tiene resultados la query de empresas')</script>"; 
			die();
		} 
		else {
			return $r;
		}
	}	
	
	function deleteEmpresasByRut($rut){
		$sql = "delete from insotic_empresa where rut='$rut'";
		$this->conectar();
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente la empresa seleccionada')</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar la empresa seleccionada.')</script>";
		}
	}
	
	function updateEmpresa($rut, $a){
		$sql = "update insotic_empresa set
					numero_trabajadores =  '$a[1]',
					nombre =  '$a[2]',
					direccion =  '$a[3]',
					numero_direccion =  '$a[4]',
					nombre_villa_poblacion =  '$a[5]',
					numero_oficina =  '$a[6]',
					telefono_1 =  '$a[7]',
					telefono_2 =  '$a[8]',
					fax =  '$a[9]',
					email =  '$a[10]',
					insotic_ciudad_id='$a[11]',
					insotic_actividad_economica_id='$a[12]',
					insotic_tipo_direccion_id='$a[13]',
					insotic_comuna_id= '$a[14]',
					nombre_representante_legal= '$a[15]',
					fono_representante_legal= '$a[16]',
					email_representante_legal= '$a[17]',
					nombre_rrhh= '$a[18]',
					fono_rrhh= '$a[19]',
					email_rrhh= '$a[20]',
					contacto_capacitacion= '$a[21]',
					fono_contacto= '$a[22]',
					email_contacto= '$a[23]',
					pagina_web= '$a[24]'					
				where  
					rut =  '$rut'";
		$this->conectar();
		if(mysql_query ($sql)){
			return true;
			
		} 
		else{
			return false;
	
		}
	}	
	
}
	
?>