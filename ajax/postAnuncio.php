<?php
	/*
	json
	{ "categoria": { "cdcategoria": "1", "nmcategoria": "Eletrônicos e Informática", "sgcategoria": null, "icone": null, "cdcategoriaparent": null }, 
	  "titulo": "teste", 
	  "descricao": "fldskfldk flkdslfksdl", 
	  "preco": "8989", 
	  "nome": "bob", 
	  "email": "bob@gmail.com", 
	  "telefone": "90989887987", 
	  "estado": { "id": "1", "nome": "Acre", "uf": "AC", "pais": "1" }, 
	  "cidade": { "id": "79", "nome": "Acrelândia", "estado": "1" } }
	*/
	
	require_once 'db.php'; // The mysql database connection script
	require_once 'defines.php';
	
	if (isset($_GET["anuncio"]) && isset($_GET["fotos"]))
	{
	    // AJAX form submission
	    $anuncio = json_decode($_GET["anuncio"], true);		
	    $fotos = json_decode($_GET["fotos"], true);
	    
	    echo "Anuncio: $anuncio  Fotos: $fotos";
	}
	else
	{
	   echo "INVALID REQUEST DATA";
	}
	
	function insertAnuncio($anuncio) {
		$hashcode = $anuncio['titulo']."HASHCODE_DO_BOB".time();
	    $hashcode = sha1($hashcode);
	    
		$sql = " insert into anuncio(cdcategoria,cdcidade,cdestado,cdpais,cdpasta,".
			   " titulo, descricao, valor, nomecontato, ".
			   " email, telefone, imagemUrl, hashcode)". 
			   " values('{$anuncio['categoria']['cdcategoria']}', '{$anuncio['cidade']['id']}', '{$anuncio['estado']['id']}', '{$anuncio['estado']['pais']}', 1,".
			   " '{$anuncio['titulo']}', '{$anuncio['descricao']}','{$anuncio['preco']}', '{$anuncio['nome']}',".
			   " '{$anuncio['email']}','{$anuncio['telefone']}','TODO','$hashcode')";
		
		$result = mysql_query($sql);
		
		$cdanuncio = mysql_insert_id();
		
		//insertFotos($cdanuncio);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Erro ao inserir dados.'));
		} 
	}
	
	function insertFotos($cdanuncio){
		// Trocar pela lista de nomes das fotos q vai vir pelo angular
		if(isset($_FILES["foto"])){		
			// Recupera os dados dos campos	
			$foto = $_FILES["foto"];
			
			// Verif;ica se o tamanho da imagem é maior que o tamanho permitido
			if($foto["size"] > FOTO_SIZE) {
		   		die("A imagem deve ter no máximo ".FOTO_SIZE." bytes");
			}
				
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
			
			// Gera um nome único para a imagem
		    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
		
			// Caminho de onde ficará a imagem
		    $caminho_imagem = DIR_TMP . "/" . $nome_imagem;
	
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
	
			$result = array();
			$result["nmfoto"] = $nome_imagem;
			
			// Insere os dados no banco
			// $sql = mysql_query("INSERT INTO foto(nmfoto, cdanuncio) VALUES ('$nome_imagem','1')");
				
			// Se os dados forem inseridos com sucesso
			//if ($sql){
			//	echo json_encode(array('success'=>true));
			//} else {
			//	echo json_encode(array('msg'=>'Erro ao inserir dados.'));
			//}
		}
	}
?>