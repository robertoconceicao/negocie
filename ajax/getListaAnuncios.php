<?php 
require_once 'db.php'; // The mysql database connection script

	$page = isset($_GET["page"]) ? intval($_GET['page']) : 1;
	$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();
	
	$rs = mysql_query("select count(*) from anuncio ");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysql_query("select * from anuncio limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);	
?>