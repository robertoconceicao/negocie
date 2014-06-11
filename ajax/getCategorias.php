<?php 
require_once 'db.php'; // The mysql database connection script
$query=mysql_query(" SELECT * FROM categoria where cdcategoriaparent is null ") or die(mysql_error());


# Collect the results
while($obj = mysql_fetch_object($query)) {
	$obj->nmcategoria = utf8_encode($obj->nmcategoria);
    $arr[] = $obj;
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>