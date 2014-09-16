<?php

include_once('conexao.php');

class PastaDao {

	public function PastaDao(){
		
	}
	
	/**
	 * Primeiro pega o valor atual do cdpasta e depois incrementa 1 e atualiza o banco
	 * @return O ultimo cdpasta gerado
	 */
	function geraCodigoPasta(){
		$con = conexao::conectar();
		
		$sql = "SELECT cdpasta FROM pasta where id = 1";
		$result = mysql_query($sql, $con);
		$cdpasta = 0;
		while($row = mysql_fetch_array($result)){
		  	$cdpasta = $row['cdpasta'];
  		}
  		$cdpasta++;
  		
		$sql = "UPDATE pasta SET cdpasta=$cdpasta WHERE id = 1";

		mysql_query($sql, $con);
				
		mysql_close($con);
		
		return $cdpasta;
	}
	
	function listaPastas(){
		$con = conexao::conectar();
		$sql = "SELECT * FROM pasta";
			
		$result = mysql_query($sql, $con);	
		
		$lista = array();		
		while($row = mysql_fetch_array($result)){
		  	//$lista[] = $row['cdpasta'];
		  	array_push($lista, $row);
  		}
				
		mysql_close($con);
		return $lista;
	}
	
}
?>