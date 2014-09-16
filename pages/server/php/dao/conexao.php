<?php
class conexao {

	public static function conectar() {
		$con = mysql_connect("localhost","root","vertrigo");
		mysql_select_db("negocie", $con);		
		return $con;
	}
}
?>