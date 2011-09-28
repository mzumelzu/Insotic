<?php
include_once ('../model/config.php');

class empresa{
	
	function conectar(){
		$config = new bd();
		$config->conexion();
	}
	
	function desconectar(){	
		mysql_close($this->conectar());
	}

	function getEmpresa(){
		$sql = "select * from insotic_empresa";
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
	
	function getEmpresaByRut($rut){
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
	
}


//$array[0] = id
	//$array[1] = nombre
	//$array[2] = direccion
	//$array[3] = comuna
	//$array[4] = telefono1
	//$array[5] = telefono2
	//$array[6] = e_mail
	//$array[7] = nombre_contacto

	/*function addInstitucion($a){
		$sql = "INSERT INTO insotic_institucion(
					id ,
					nombre ,
					direccion ,
					insotic_comuna_id ,
					insotic_nombre_contacto ,
					telefono1 ,
					telefono2 ,
					e_mail
					)
					VALUES (
					'$a[0]', '$a[1]' , '$a[2]' , '$a[3]' , '$a[7]' , '$a[4]' , '$a[5]' , '$a[6]' )	";
		$this->conectar();
		if (mysql_query ($sql)){
			return true;}
		else{
			return false;
		}				
	}*/
		
	/*function deleteInstitucionById($id){
		$sql = "delete from insotic_institucion where id='$id'";
		$this->conectar(mysql_query ($sql));
		if(mysql_query ($sql)){
			echo "<script>alert('Se ha eliminado correctamente la institucion seleccionada')	</script>";
		} 
		else{
			echo "<script>alert('Se ha generado un error al eliminar la institucion seleccionada.')</script>";
		}
	}*//*
	
	function updateInstitucion($id, $a){
		$sql = "update insotic_institucion set
					nombre =  '$a[1]',
					direccion =  '$a[2]',
					insotic_comuna_id =  '$a[3]',
					insotic_nombre_contacto = '$a[7]',
					telefono1 =  '$a[4]',
					telefono2 =  '$a[5]',
					e_mail =  '$a[6]'
				where  
					id = '$id'";
		$this->conectar();
		if(mysql_query ($sql)){
			return true;
		} 
		else{
			return false;
	
		}*/
	
	
?>