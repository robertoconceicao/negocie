<?php

require_once '../ajax/db.php';
require_once '../ajax/defines.php';
	
	if (!file_exists(DIR_TMP)) {
		mkdir(DIR_TMP);
	}
	
	$result = array();
	
	if(isset($_FILES["foto"])){		
		// Recupera os dados dos campos	
		$foto = $_FILES["foto"];
		
		// Verif;ica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > FOTO_SIZE) {
	   	   $result["msg"] = "A imagem deve ter no máximo ".FOTO_SIZE." bytes";
		} else {			
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
			
			// Gera um nome único para a imagem
		    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
		
			// Caminho de onde ficará a imagem
		    $caminho_imagem = DIR_TMP . "/" . $nome_imagem;
	
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
	
			$result["nmfoto"] = $nome_imagem;
		}
	} else {
		$result["msg"] = "Error nao veio o campo foto";
	}

	echo json_encode($result);
	
?>