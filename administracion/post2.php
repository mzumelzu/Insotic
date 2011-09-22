<? 
error_reporting(0);
function runSQL($rsql) {
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname   = "insotic";
	$connect = mysql_connect($hostname,$username,$password) or die ("Error: could not connect to database");
	$db = mysql_select_db($dbname);
	$result = mysql_query($rsql) or die ('test'); 
	return $result;
	mysql_close($connect);
}

function countRec($fname,$tname,$where) {
$sql = "SELECT count($fname) FROM $tname $where";
$result = runSQL($sql);
while ($row = mysql_fetch_array($result)) {
return $row[0];
}
}
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = 'name';
if (!$sortorder) $sortorder = 'desc';
		if($_POST['query']!=''){
			$where = "WHERE `".$_POST['qtype']."` LIKE '%".$_POST['query']."%' ";
		} else {
			$where ='';
		}
		if($_POST['letter_pressed']!=''){
			$where = "WHERE `".$_POST['qtype']."` LIKE '".$_POST['letter_pressed']."%' ";	
		}
		if($_POST['letter_pressed']=='#'){
			$where = "WHERE `".$_POST['qtype']."` REGEXP '[[:digit:]]' ";
		}
$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);

$limit = "LIMIT $start, $rp";

$sql = "SELECT id,rut_trabajador,rut_empresa,id_grupo_operacional,id_region,estado FROM insotic_empresa_nomina $where $sort $limit";
$result = runSQL($sql);

$total = countRec('rut_trabajador','insotic_empresa_nomina',$where);

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-type: text/x-json");
$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";
$rc = false;
while ($row = mysql_fetch_array($result)) {
if ($rc) $json .= ",";
$json .= "\n{";
$json .= "id:'".$row['id']."',";
$json .= "cell:['".$row['id']."','".$row['rut_trabajador']."'";
$json .= ",'".addslashes($row['rut_empresa'])."'";
$json .= ",'".addslashes($row['id_grupo_operacional'])."'";
$json .= ",'".addslashes($row['id_region'])."']";
$json .= "}";
$rc = true;
}
$json .= "]\n";
$json .= "}";
echo $json;
?>