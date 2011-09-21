<?php
//Configuracion de la conexion a base de datos
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "nube"; 

/*$bd_host = "localhost"; 
$bd_usuario = "ozioncom"; 
$bd_password = "dnMFR8HqYN"; 
$bd_base = "ozioncom_nube"; */

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); ?>