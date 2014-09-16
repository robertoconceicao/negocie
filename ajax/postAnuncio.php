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
	
	if (isset($_GET["anuncio"]))
	{
	    // AJAX form submission
	    $anuncio = json_decode($_GET["anuncio"], true);		
	    
	    $hashcode = $anuncio['titulo']."HASHCODE_DO_BOB".time();
	    $hashcode = sha1($hashcode);
	    
		$sql = " insert into anuncio(cdcategoria,cdcidade,cdestado,cdpais,cdpasta,".
			   " titulo, descricao, valor, nomecontato, ".
			   " email, telefone, imagemUrl, hashcode)". 
			   " values('{$anuncio['categoria']['cdcategoria']}', '{$anuncio['cidade']['id']}', '{$anuncio['estado']['id']}', '{$anuncio['estado']['pais']}', 1,".
			   " '{$anuncio['titulo']}', '{$anuncio['descricao']}','{$anuncio['preco']}', '{$anuncio['nome']}',".
			   " '{$anuncio['email']}','{$anuncio['telefone']}','TODO','$hashcode')";
		
		$result = @mysql_query($sql);
		
		if ($result){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Erro ao inserir dados.'));
		} 
	}
	else
	{
	   echo "INVALID REQUEST DATA";
	}	
?>