<?php 
require_once 'db.php'; // The mysql database connection script

define("OFFSET", 1);
	
	$page = isset($_GET["page"]) ? intval($_GET['page']) : 1;
	$rows = isset($_GET['rows']) ? intval($_GET['rows']) : OFFSET;
	$offset = ($page-1)*$rows;
	$result = array();
	
	$result["page"] = $page;
	
	$rs = mysql_query("select count(*) from anuncio ");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$total = intval($row[0]);
	$pages = array();
	$numberOfPages = 1;
	if($total > OFFSET){
		$numberOfPages = (int)($total / OFFSET);
		 		
		if($total % OFFSET != 0){
			$numberOfPages++;
		}
	}
	
	for ($i = 1; $i <= $numberOfPages; $i++) {
		array_push($pages, $i);
	}
	$result["pages"] = $pages;
	$result["numberOfPages"] = $numberOfPages;
	
	$rs = mysql_query("select * from anuncio limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);	
?>