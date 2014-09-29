<?php

require_once '../ajax/db.php';

define("DIR_FOTOS", "fotos");

if (isset($_GET["cdanuncio"]) && isset($_GET["nmfoto"])){		
	$cdanuncio = $_GET["cdanuncio"];
	$nmfoto = $_GET["nmfoto"];
	
    $caminho_imagem = DIR_FOTOS . "/$nmfoto";

	// Faz o upload da imagem para seu respectivo caminho
	unlink($caminho_imagem);
		
	// Insere os dados no banco
	$sql = mysql_query("DELETE FROM foto WHERE nmfoto = '$nmfoto' and cdanuncio = '$cdanuncio'");

	$result = array();
	$result["cdanuncio"] = $cdanuncio;
	
	if ($sql){
		$result["success"] = true;
		
	} else {
		$result["msg"] = 'Erro ao inserir dados.';		
	}
	echo json_encode($result);
}
?>