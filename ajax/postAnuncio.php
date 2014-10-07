<?php
    /*
    json
    { "categoria": { "cdcategoria": "1", "nmcategoria": "Eletr�nicos e Inform�tica", "sgcategoria": null, "icone": null, "cdcategoriaparent": null }, 
      "titulo": "teste", 
      "descricao": "fldskfldk flkdslfksdl", 
      "preco": "8989", 
      "nome": "bob", 
      "email": "bob@gmail.com", 
      "telefone": "90989887987", 
      "estado": { "id": "1", "nome": "Acre", "uf": "AC", "pais": "1" }, 
      "cidade": { "id": "79", "nome": "Acrel�ndia", "estado": "1" } }
    */

    require_once 'db.php'; // The mysql database connection script
    require_once 'defines.php';

    if (isset($_GET["anuncio"])){   
        insertAnuncio();        
    } else {
       echo "INVALID REQUEST DATA";
    }

    function insertAnuncio() {
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

        $result = mysql_query($sql);

        $cdanuncio = mysql_insert_id();

        insertFotos($cdanuncio);


        if ($result){
                echo json_encode(array('success'=>true));
        } else {
                echo json_encode(array('msg'=>'Erro ao inserir dados.'));
        } 
    }

    function insertFotos($cdanuncio){
        // Trocar pela lista de nomes das fotos q vai vir pelo angular
        if(isset($_GET["fotos"])){		
            $fotos = json_decode($_GET["fotos"], true);

            foreach ($fotos as $nome_imagem) {
                $caminho_tmp = DIR_TMP . "/" . $nome_imagem;
                $caminho_foto = DIR_FOTOS . "/" . $nome_imagem;

                copy($caminho_tmp, $caminho_foto);
                unlink($caminho_tmp);
                // Insere os dados no banco
                mysql_query("INSERT INTO foto(nmfoto, cdanuncio) VALUES ('$nome_imagem','$cdanuncio')");
            }
        }
    }
?>