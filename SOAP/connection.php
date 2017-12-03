<?php 

class Connection {	
	public $webService;
	function __construct(){
		$service="https://test.placetopay.com/soap/pse/?wsdl"; //url del servicio
		$param=array('trace' => true); //parametros de la llamada
		$this->webService = new SoapClient($service, $param);
		$this->webService->__setLocation('https://test.placetopay.com/soap/pse/');

	}

	function auth(){
		$login = "6dd490faf9cb87a9862245da41170ff2"; // Identificador dado por PlaceToPay
		$seed = date('c'); // Instancio la semilla mediante date('c') el cual genera un timestamp en formato ISO 8601
		$tranKey = '024h1IlD';
		$tranKey = sha1($seed.$tranKey); // Obtengo el tranKey el cual es una encriptación de la semilla.
		$additional = array();

		$additional['name'] ='tipoPago';
		$additional['value'] = 'débito';

		$authentication = array();
		$authentication['login'] = $login;
		$authentication['tranKey'] = $tranKey;
		$authentication['seed'] = $seed;
		$authentication['additional'] = $additional;

		$auth = array();
		$auth['auth'] = $authentication;

		return $auth;		
	}

	function getBankList($auth){		
		return $this->webService->getBankList($auth);
	}

	function createTransaction($createTransaction){		
		return $this->webService->createTransaction($createTransaction);
	}

	function getTransactionInformation($transaction){
		return $this->webService->getTransactionInformation($transaction);
	}
}

?>