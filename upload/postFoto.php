<?php

require_once '../ajax/db.php';

define("DIR_FOTOS", "fotos");
define("TAMANHO", "1000000");

/*
if(isset($_FILES["file"])){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro not file.'));
}


$data = file_get_contents("php://input");
$postData = json_decode($data);
	if(isset($postData)){		
		// Recupera os dados dos campos	
		$foto = $postData->foto;
		
		// Pega as dimensões da imagem
		//$dimensoes = getimagesize($foto["tmp_name"]);	
					
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > TAMANHO) {
	   		die("A imagem deve ter no máximo ".TAMANHO." bytes");
		}
			
		// Pega extensão da imagem
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	
		// Gera um nome único para a imagem
	    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	
		// Caminho de onde ficará a imagem
	    $caminho_imagem = DIR_FOTOS . "/" . $nome_imagem;
	
		// Faz o upload da imagem para seu respectivo caminho
		move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			
		// Insere os dados no banco
		$sql = mysql_query("INSERT INTO foto(nmfoto, cdanuncio) VALUES ('$nome_imagem','1')");
			
		// Se os dados forem inseridos com sucesso
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Erro ao inserir dados.'));
		}
	}
	
*/

/*
 * {"webkitRelativePath":"","lastModifiedDate":"2014-07-22T00:18:17.000Z","name":"bg_sms.jpg","type":"image/jpeg","size":20754}
 */

	if(isset($_FILES["foto"])){		
		// Recupera os dados dos campos	
		$foto = $_FILES["foto"];
		
		// Pega as dimensões da imagem
		//$dimensoes = getimagesize($foto["tmp_name"]);	
					
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > TAMANHO) {
	   		die("A imagem deve ter no máximo ".TAMANHO." bytes");
		}
			
		// Pega extensão da imagem
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	
		// Gera um nome único para a imagem
	    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	
		// Caminho de onde ficará a imagem
	    $caminho_imagem = DIR_FOTOS . "/" . $nome_imagem;
	
		// Faz o upload da imagem para seu respectivo caminho
		move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			
		// Insere os dados no banco
		$sql = mysql_query("INSERT INTO foto(nmfoto, cdanuncio) VALUES ('$nome_imagem','1')");
			
		// Se os dados forem inseridos com sucesso
		if ($sql){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Erro ao inserir dados.'));
		}
	}		
?>