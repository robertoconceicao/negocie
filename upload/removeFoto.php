<?php

require_once '../ajax/db.php';
require_once '../ajax/defines.php';

$result = array();

if(isset($_GET["status"])){
	$status = $_GET["status"];
	
	if(strcmp($status, STATUS_INSERT) == 0){
		removeDirTmp();	
	} else {
		removeDirFotos();
	}	
} else {
	$result["msg"] = 'Erro status não definido.';
}

echo json_encode($result);


function removeDirTmp() {
	if (isset($_GET["nmfoto"])){
		$nmfoto = $_GET["nmfoto"];
		
	    $caminho_imagem = DIR_TMP . "/$nmfoto";
	
		// Faz o upload da imagem para seu respectivo caminho
		unlink($caminho_imagem);
			
		if ($sql){
			$result["success"] = true;
			$result["nmfoto"] = $nmfoto;
		} else {
			$result["msg"] = 'Erro ao remover a foto: $nmfoto';		
		}
	}
}

function removeDirFotos() {
	if (isset($_GET["cdanuncio"]) && isset($_GET["nmfoto"])){		
		$cdanuncio = $_GET["cdanuncio"];
		$nmfoto = $_GET["nmfoto"];
		
	    $caminho_imagem = DIR_FOTOS . "/$nmfoto";
	
		// Faz o upload da imagem para seu respectivo caminho
		unlink($caminho_imagem);
			
		// Insere os dados no banco
		$sql = mysql_query("DELETE FROM foto WHERE nmfoto = '$nmfoto' and cdanuncio = '$cdanuncio'");
	
		$result["cdanuncio"] = $cdanuncio;
		
		if ($sql){
			$result["success"] = true;			
		} else {
			$result["msg"] = 'Erro ao remover registro da base.';		
		}
	} else {
		$result["msg"] = 'Erro cdanuncio ou nmfoto vazio.';
	}
}
?>