<?php
$con=mysql_connect("localhost","root","");

if($con){
	mysql_select_db("pruebas",$con);
}
else{
	die("Could not connect to database");
}
?>