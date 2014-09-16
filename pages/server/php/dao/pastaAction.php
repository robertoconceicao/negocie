<?php

require('PastaDao.php');

$metodo = $_REQUEST['metodo'];

$pastaDao = new PastaDao();
$result = array();

switch($metodo){
	case 'geraCodigoPasta':
		$cdpasta = $pastaDao->geraCodigoPasta();
		$result['cdpasta'] = $cdpasta;
		echo json_encode($result);		
		break;
	case 'listaPastas':
		$lista = $pastaDao->listaPastas();		 
		echo json_encode($lista);
		break;
}
?>