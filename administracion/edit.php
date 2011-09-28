<?php

//database connection information
include("dbconfig.php");

$invid = $_REQUEST['invid'];
$invdate = $_REQUEST['invdate'];
$client_id = $_REQUEST['client_id'];
$amount = $_REQUEST['amount'];
$tax = $_REQUEST['tax'];
$total = $_REQUEST['total'];
$note = $_REQUEST['note'];
$id = $_REQUEST['id'];
$oper = $_REQUEST['oper'];

// Connect to the MySQL database server
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error());

// Select the database
mysql_select_db($database) or die("Error connecting to db.");

// if operation is edit a row
if ($oper == "edit") {

$SQL = "UPDATE invheader";
$SQL = $SQL." SET invdate = '".$invdate;
$SQL = $SQL."', client_id = '".$client_id;
$SQL = $SQL."', amount = '".$amount;
$SQL = $SQL."', tax = '".$tax;
$SQL = $SQL."', total = '".$total;
$SQL = $SQL."', note = '".$note;
$SQL = $SQL."' WHERE invid = '".$id."'";
$result = mysql_query($SQL) or die("Could not execute query ".mysql_error());

// if operation is add a row
} elseif ($oper == "add"){

$SQL = "INSERT INTO invheader (invdate, client_id, amount, tax, ";
$SQL = $SQL."total, note) Values('";
$SQL = $SQL.$invdate."','";
$SQL = $SQL.$client_id."','";
$SQL = $SQL.$amount."','";
$SQL = $SQL.$tax."','";
$SQL = $SQL.$total."','";
$SQL = $SQL.$note."')";
$result = mysql_query($SQL) or die("Could not execute query ".mysql_error());

// if operation is delete a row
} elseif ($oper == "del"){

$SQL = "DELETE FROM invheader WHERE invid = '".$id."'";
$result = mysql_query($SQL) or die("Could not execute query ".mysql_error());

}

mysql_close($db);