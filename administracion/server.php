<?php

// database connection information is stored here
include("dbconfig.php");

// The first four variables retrieve parameters for
// table creation. (Some for searching also.)
$page = $_REQUEST['page'];    // requested page
$limit = $_REQUEST['rows'];   // rows per page
$sidx = $_REQUEST['sidx'];    // index row
$sord = $_REQUEST['sord'];    // sorting order

// if index isn't passed then use the first column
if(!$sidx) $sidx=1;

// these three variables are used to search for records
$where = $_REQUEST['searchField'];        // field to be searched
$whereValue = $_REQUEST['searchString'];  // value to be looked for
$whereOper = $_REQUEST['searchOper'];     // operator used

// If $whereOper was passed then cofigure the SQL operator
// and what we are searching for. There are a couple of
// these remarked out because honestly I do not know the mySQL
// syntax and I really don't need it for this project.
if ($whereOper <> NULL) {

switch($whereOper){
case("eq"):
$sqlOperator = " = ";
$whereValue = "'".$whereValue."'";
break;
case("ne"):
$sqlOperator = " <> ";
$whereValue = "'".$whereValue."'";
break;
case("lt"):
$sqlOperator = " < ";
$whereValue = "'".$whereValue."'";
break;
case("le"):
$sqlOperator = " <= ";
$whereValue = "'".$whereValue."'";
break;
case("gt"):
$sqlOperator = " > ";
$whereValue = "'".$whereValue."'";
break;
case("ge"):
$sqlOperator = " >= ";
$whereValue = "'".$whereValue."'";
break;
case("bw"):
$sqlOperator = " REGEXP '^";
$whereValue = $whereValue."'" ;
break;
//    case("bn"):
//      $sqlOperator = "=";
//      $whereValue = "'".$whereValue."'";
//      break;
//    case("in"):
//      $sqlOperator = "=";
//      $whereValue = "'".$whereValue."'";
//      break;
//    case("ni"):
//      $sqlOperator = "=";
//      $whereValue = $whereValue."'";
//      break;
case("ew"):
$sqlOperator = " LIKE '%";
$whereValue = $whereValue."'";
break;
//    case("en"):
//      $sqlOperator = "=";
//      $whereValue = "'".$whereValue."'";
//      break;
case("cn"):
$sqlOperator = " LIKE '%";
$whereValue = $whereValue."%'";
break;
case("nc"):
$sqlOperator = " NOT LIKE '%";
$whereValue = $whereValue."%'";
break;
}
}

// Connect to the MySQL database server
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error());

// Select the database
mysql_select_db($database) or die("Error connecting to db.");

// if $where is not NULL then get the count on the search criteria,
// else get the count on everything.
if ($where <> NULL){
$result = mysql_query("SELECT COUNT(*) AS count FROM invheader WHERE ".$where.$sqlOperator.$whereValue);
} else {
$result = mysql_query("SELECT COUNT(*) AS count FROM invheader");
}

// Calculate the number of rows for the query.
// This is used for paging the result.
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$count = $row['count'];

// calculate the total pages for the query
if($count > 0) {
$total_pages = ceil($count/$limit);
} else {
$total_pages = 0;
}

// if for some reasons the requested page is greater than the total
// set the requested page to total page
if ($page > $total_pages) $page=$total_pages;

// calculate the starting position of the rows
$start = $limit*$page-$limit;

// if for some reasons start position is negative set it to 0
// typical case is that the user type 0 for the requested page
if($start < 0) $start = 0;

// if where is not null then retrieve requested rows based on search
// else retrieve everything
if ($where <> NULL) {

$SQL = "SELECT invid, invdate, client_id, amount, tax, total, note FROM invheader WHERE ".$where.$sqlOperator.$whereValue." ORDER BY ".$sidx." ".$sord." LIMIT ".$start." , ".$limit;
$result = mysql_query($SQL) or die("Could not execute query ".$SQL." ".mysql_error());

} else {

$SQL = "SELECT invid, invdate, client_id, amount, tax, total, note FROM invheader ORDER BY ".$sidx." ".$sord." LIMIT ".$start." , ".$limit;
$result = mysql_query($SQL) or die("Could not execute query. ".mysql_error());
}

// response back to web page
$response->page = $page;
$response->total = $total_pages;
$response->records = $count;

$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
$response->rows[$i]['id']=$row[invid];
$response->rows[$i]['cell']=array($row[invid], $row[invdate], $row[client_id], $row[amount], $row[tax],
$row[total], $row[note]);
$i++;
}
echo json_encode($response);
mysql_close($db);
?>
