<?php
	require_once '../ajax/db.php';

	//$cdanuncio = isset($_GET["cdanuncio"]) ? intval($_GET['cdanuncio']) : 1;

	//$sql = mysql_query("SELECT * FROM foto WHERE cdanuncio = $cdanuncio");
	
	$rs = mysql_query("SELECT * FROM foto");
	$result = array();
	$result["cdanuncio"] = 1;//$cdanuncio;
	
	$fotos = array();
	while($row = mysql_fetch_object($rs)){
		array_push($fotos, $row);
	}
	$result["fotos"] = $fotos;

	echo json_encode($result);
?>