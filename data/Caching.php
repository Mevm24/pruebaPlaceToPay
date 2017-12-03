<?php 

/**
* 
*/
require_once('./SOAP/connection.php');
require_once('SaveData.php');

/* 
En esta clase es donde se hace la caché de los bancos que se traen mediante el soap, guardándose como un archivo y renovándose cada 24h
*/
class Caching{
	
	
	public function get_content($file,$hours) {
		// Se obtiene la hora actual y se obtiene la cantidad de tiempo que debe guardar el archivo
		$current_time = time(); 
		$expire_time = $hours * 60 * 60; 
		$file_time = filemtime($file); // Esta función obtiene la hora de modificación o de creación del archivo.
		
		
		if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
			//Si el archivo existe y no han pasado más de 24 horas se obtiene el archivo guardado y se decodifica 
			$json = json_decode(file_get_contents($file)); 
			return $json;
		}
		else {
			$content = $this->get_url(); // Esta función es la que se encarga de obtener los datos del SOAP y guardarlos en el archivo
			return json_decode($content);
		}
	}

	/* gets content from a URL via curl */
	public function get_url() {
		$connection = new connection(); //Creamos un objeto de tipo Connection que es el encargo de conectarse al webservice
	  	$auth = $connection->auth(); //Autenticamos la conexión

		$banks = $connection->getBankList($auth); // La obtenemos llamando al método de getBanksList pasándole a la conexión inicializada los datos de la autenticación que se requieren para obtener los objetos.
		$json = null;
		if(!empty($banks)){		//Si está vacio significa que no devolvió nada la consulta SOAP
			$json = json_encode($banks); // Convierto a JSON los datos
			$saveData = new SaveData();
			$saveData->save($json);	 //Guardo los datos convertidos en un archivo JSON;
		}

		return $json;
	}

}


?>