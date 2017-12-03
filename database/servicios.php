<?php 

require_once('Database.php'); // En esta clase están definidos lo datos de conexión a la base de datos
if(isset($_GET['id'])){ // Se usa para verificar si una variable existe, en este caso id que es el que uso para saber qué voy a insertar.
	$id = $_GET['id']; // Obtengo la variable	
	switch ($id) { //La evalúo para que dependiendo del valor que tenga ya sea 0 o 1 haga algo
		 		   // Esta variable la defino yo en los formularios que envío.
		case '0':
			crearPersona(); 
			header('Location: ../index.php');
			break;
		case '1':
			crearEmpresa();
			header('Location: ../index.php');
			break;
	}
}

// En esta función se crean las personas mediante los atributos de la página createPerson.php y el formulario de personas.
	function crearPersona(){

		//Preparo la consulta que voy a ejecutar, en esta caso es un insert.
		$consulta = "insert into person values 
		(null,:document,:documentType,:firstName,:lastName,null,:emailAddress,:address,null,null,null,null,:mobile)";
		// Mediante :var defino cómo se llamarán los paramétros que recibirá la función encargada de ejecutar la consulta.

		// Obtengo los valores del formulario mediante $_POST
		$tipo = $_POST['tipoDocumento'];
		$nDocumento = $_POST['numIdenti'];
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$numero = $_POST['celular'];
		$direccion = $_POST['direccion'];
		$email = $_POST['email'];

	        try {
	            // Preparar sentencia
	            $cmd = Database::getInstance()->getDb()->prepare($consulta);
	            // Ejecutar sentencia preparada
	            $cmd->execute(array(':document' =>$nDocumento ,':documentType' => $tipo,
	            					':firstName' => $nombres,':lastName' => $apellidos,':emailAddress' => $email,
	        						':address' => $direccion, ':mobile' => $numero ));            
	            return $cmd->fetchAll(PDO::FETCH_ASSOC);

	        } catch (PDOException $e) {
	            return false;
	        }        
	}

	function crearEmpresa(){
		//Preparo la consulta que voy a ejecutar, en esta caso es un insert.
		$consulta = "insert into person values 
		(null,:document,'NIT',null,null,:company,:emailAddress,:address,null,null,null,null,:mobile)";
		// Mediante :var defino cómo se llamarán los paramétros que recibirá la función encargada de ejecutar la consulta.

		// Obtengo los valores del formulario mediante $_POST
		$document = $_POST['nNit'];
		$company = $_POST['nEmpresa'];
		$mobile = $_POST['numEmp'];
		$address = $_POST['dirEmp'];
		$email = $_POST['emailEmp'];

	        try {
	            // Preparar sentencia
	            $cmd = Database::getInstance()->getDb()->prepare($consulta);
	            // Ejecutar sentencia preparada
	            $cmd->execute(array(':document' =>$document ,':company' => $company,
	            					':emailAddress' => $email,
	        						':address' => $address, ':mobile' => $mobile ));            
	            return $cmd->fetchAll(PDO::FETCH_ASSOC);

	        } catch (PDOException $e) {
	            return false;
	        }  
	}

	function buscarPersona($email){
		$consulta = "select * from person where emailAddres = ?";		
		try {
	            // Preparar sentencia
	            $cmd = Database::getInstance()->getDb()->prepare($consulta);
	            // Ejecutar sentencia preparada
	            $cmd->execute(array($email));            	            
	            
	            $row = $cmd->fetchAll(PDO::FETCH_ASSOC);
            	return $row;

	        } catch (PDOException $e) {
	            return false;
	        }    
	}

	function buscarEmpresa($email,$nit){
		$consulta = "select * from person where emailAddres = :email and document = :document";		
		try {
	            // Preparar sentencia
	            $cmd = Database::getInstance()->getDb()->prepare($consulta);
	            // Ejecutar sentencia preparada
	            $cmd->execute(array(':email' => $email, ':document' => $nit));            	            
	            
	            $row = $cmd->fetchAll(PDO::FETCH_ASSOC);
            	return $row;

	        } catch (PDOException $e) {
	            return false;
	        }    
	}

	function crearTransaccion($transact){
		$consulta = "insert into transactionresult values(:transactionID,:sessionID,:returnCode,:trazabilityCode, :transactionCycle,		
		:bankCurrency,:bankFactor,:bankURL,:responseCode,:responseReasonCode,:responseReasonText)"; // Creo mi consulta para insertar la respuesta del 																								   create Transaction en la base de datos
		$transaction = $transact->createTransactionResult; // $transact->createTransactionResult es el objeto que me devuelve la consulta SOAP al método createTransaction, añadiéndoselo a una variable puedo acceder a sus atributos sin necesidad de escribir $transact->createTransactionResult para cada dato

		$transactionID = $transaction->transactionID; 

		$sessionID = $transaction->sessionID;

		$returnCode = $transaction->returnCode;

		$trazabilityCode = $transaction->trazabilityCode;

		$transactionCycle = $transaction->transactionCycle;

		$bankCurrency = $transaction->bankCurrency;

		$bankFactor = $transaction->bankFactor;

		$bankURL = $transaction->bankURL;

		$responseCode = $transaction->responseCode;

		$responseReasonCode = $transaction->responseReasonCode;

		$responseReasonText = $transaction->responseReasonText;

	 	try {
	        // Preparar sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $cmd->execute(array(':transactionID' =>$transactionID ,':sessionID' => $sessionID,
            					':returnCode' => $returnCode,':trazabilityCode' => $trazabilityCode,':transactionCycle' => $transactionCycle,
        						':bankCurrency' => $bankCurrency, ':bankFactor' => $bankFactor,':bankURL' => $bankURL,
        						':responseCode' => $responseCode,':responseReasonCode' => $responseReasonCode,':responseReasonText' => $responseReasonText ));                        
            $row = $cmd->fetchAll(PDO::FETCH_ASSOC);            
        	return $row;

        } catch (PDOException $e) {
            return false;
        }    
	}

	function instanciatePerson($personS,$email){
		$person = array(); // Defino el objeto payer que va en la solicitud de crear la transacción a partir de los datos traídos 					  de la base de datos, este mismo payer para razones de 
	  	$person['documentType'] = $personS[0]['documentType'];
	  	$person['document'] = $personS[0]['document'];
	  	$person['firstName'] = $personS[0]['firstName'];
	  	$person['lastName'] = $personS[0]['lastName'];
	  	$person['company'] = null;
	  	$person['emailAddress'] = $email;
	  	$person['address'] = $personS[0]['address'];
	  	$person['city'] = null;
	  	$person['province'] = null;
	  	$person['country'] = null;
	  	$person['phone'] = null;
	  	$person['mobile'] = $personS[0]['mobile'];

	  	return $person;
	}

	function instanciateCompany($companyS){
		$company = array(); // Defino el objeto buyer que va en la solicitud de crear la transacción a partir de los datos traídos 					  de la base de datos de simplicidad será el mismo shipping
	  	$company['documentType'] = $companyS[0]['documentType'];
	  	$company['document'] = $companyS[0]['document'];
	  	$company['firstName'] = $companyS[0]['firstName'];
	  	$company['lastName'] = $companyS[0]['lastName'];
	  	$company['company'] = $companyS[0]['company'];
	  	$company['emailAddress'] = "company@mail.com";
	  	$company['address'] = $companyS[0]['address'];
	  	$company['city'] = null;
	  	$company['province'] = null;
	  	$company['country'] = null;
	  	$company['phone'] = null;
	  	$company['mobile'] = $companyS[0]['mobile'];

	  	return $company;
	}	

	function PSETransactionRequest($person,$company,$bank,$tipoPersona){

		$PSETransactionRequest = array(); // Creo el objeto que enviaré a través de la petición SOAP para iniciar la transacción
	  	
	  	$PSETransactionRequest['bankCode'] = $bank[0];  //La función explode me devuelve un array de todas las 														palabras que se encuentran después de la cadena que le paso por parámetro, en este caso "-"
	  	$PSETransactionRequest['bankInterface'] = $tipoPersona; // Este tipo de persona viene de formulario anterior, cuando 																	se le da click en los logos	  	
	  	$PSETransactionRequest['returnURL'] = "http://localhost:8080/pruebaBandit/confirmTransactionPayment.php";    	
	  	$PSETransactionRequest['reference'] = getOriginIP().",".$person['documentType'].",".$person['document'];
	  	$PSETransactionRequest['description'] = "Se paga una cantidad de dinero";
	  	$PSETransactionRequest['lenguaje'] = 'ES';
	  	$PSETransactionRequest['currency'] = 'COP';
	  	$PSETransactionRequest['totalAmount'] = rand(1000000,35000000);
	  	$PSETransactionRequest['taxAmount'] = 20.3;
	  	$PSETransactionRequest['devolutionBase'] = rand(10000,40000);
	  	$PSETransactionRequest['tipAmount'] = rand(10000,40000);
	  	$PSETransactionRequest['payer'] = $person;
	  	$PSETransactionRequest['buyin'] = $person;
	  	$PSETransactionRequest['shipping'] = $company;
	  	$PSETransactionRequest['ipAddress'] = getOriginIP();
	  	$PSETransactionRequest['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

	  	return $PSETransactionRequest;
	}

	function getOriginIP() { // Función para obtener la IP de la persona que hace la solicitud
         if (isset($_SERVER["HTTP_CLIENT_IP"])){

            return $_SERVER["HTTP_CLIENT_IP"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

            return $_SERVER["HTTP_X_FORWARDED"];

        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

            return $_SERVER["HTTP_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_FORWARDED"])){

            return $_SERVER["HTTP_FORWARDED"];

        }else{

            return $_SERVER["REMOTE_ADDR"];

        }
    }

    function findTransaction($transactionID){ // Me devuelve los datos de la transacción que se pasa por parámetro
    	$consulta = "select * from transactionresult where transactionID = ?";		
		try {
	            // Preparar sentencia
	            $cmd = Database::getInstance()->getDb()->prepare($consulta);
	            // Ejecutar sentencia preparada
	            $cmd->execute(array($transactionID));            	            
	            
	            $row = $cmd->fetchAll(PDO::FETCH_ASSOC);
            	return $row;

	        } catch (PDOException $e) {
	            return false;
	        }    
    }

?>