<?php 
require_once 'db.php'; // The mysql database connection script

$estado_id = $_GET['estado_id'];
$query=mysql_query(" SELECT * FROM cidade where estado = $estado_id") or die(mysql_error());

# Collect the results
while($obj = mysql_fetch_object($query)) {
	$obj->nome = utf8_encode($obj->nome);
    $arr[] = $obj;
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>