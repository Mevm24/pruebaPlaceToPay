<?php 
	include('public/view/layout.php');
	require('SOAP/connection.php');
	require('database/servicios.php');

	$connection = new connection(); //Creamos un objeto de tipo Connection que es el encargo de conectarse al webservice
  	$transactionInformation = $connection->auth(); //Autenticamos la conexión  	
  	$options = ['OK','NOT_AUTHORIZED','PENDING','FAILED']; //Este vector se usa en el código para saber que opción escogió el usuario al dar click en call
  	$transactionID = $_POST['transactionID']; // Obtengo el id de la transacción para poder hacer la consulta de su estado

  	$transaction = findTransaction($transactionID); //Acá obtengo la información guardada en la base que tenga el transactionID igual al pasasdo por POST
  	
  	if(isset($_GET['call'])){ // Parámetro enviado para validar el click del botón Call
  		
  		$transactionInformation['transactionID'] = $transactionID; // Creo el objeto con el cuál se hará el getTransactionInformation definido en la case 																servicios.php
  		$information = $connection->getTransactionInformation($transactionInformation);
  	}
?>

<?php if(isset($_POST['transactionID'])){ ?> <!-- Valida si la solicitud viene desde el beginTransaction.php -->
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3" style="margin-top: 20px">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h1 class="panel-title">Pagos PSE</h1>
				</div>
				<div class="panel-body">
					<h1 class="panel-title"><b>Debug Confirm Transaction Payment</b></h1>
					<hr style="width: 90%">
					<div class="row">
						<div class="col-xs-12 ">
							<form method="post" action="confirmTransactionPayment.php?call=true">								
								<div class="row">
									 <div class="col-xs-12">
										<div class="col-md-4 col-xs-12">
											<label class="label-form">TrazabilityCode:</label>											
										</div>										
										<div class="col-md-8">											
											<input class="form-control" type="text" name="trazabilityCode" placeholder="TrazabilityCode" value="<?= $transaction[0]['trazabilityCode'] ?>">
										</div>
									</div>						
								</div>		
								<input type="text" name="transactionID" hidden value="<?= $_POST['transactionID'] ?>">					
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4 col-xs-12">												
											<label class="label-form">FinantialInstituteCode:</label>
										</div>
										<div class="col-md-8 col-xs-12">												
											<input class="form-control" type="number" name="instituteCode" value="<?= $_POST['instituteCode'] ?>" placeholder="FinantialInstitueCode">
										</div>	
									</div>
								</div>										
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4">											
											<label class="label-form">EntityCode: </label>
										</div>
										<div class="col-md-8 col-xs-12">											
											<input type="number" class="form-control" name="entityCode" value="<?= $_POST['entityCode'] ?>">
										</div>
									</div>
								</div>				
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4 col-xs-12">
											<label class="label-form">TransactionValue:</label>
										</div>
										<div class="col-md-8 col-xs-12">											
											<input class="form-control" type="number" name="amount" value="<?=$_POST['amount']?>" placeholder="TransactionValue">
										</div>
									</div>
								</div>								
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4">												
											<label class="label-form">vatValue:</label>
										</div>
										<div class="col-md-8 col-xs-12">											
											<input class="form-control" type="number" name="vatValue" value="0">
										</div>
									</div>
								</div>									
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4 col-xs-12">															
											<label class="label-form">TicketID:</label>
										</div>
										<div class="col-md-8 col-xs-12">		
											<input class="form-control" type="text" name="ticketID" value="<?= $_POST['ticketID'] ?>" placeholder="TicketID">					
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4 col-xs-12">											
											<label class="label-form">SolicitDate: </label>
										</div>
										<div class="col-md-8 col-xs-12">											
											<input class="form-control" type="text" name="solicitDate"  value="<?= $_POST['solicitDate'] ?>" placeholder="SolicitDate">
										</div>
									</div>
								</div>		
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4 col-xs-12">											
											<label class="label-form">BankProcessDate: </label>
										</div>
										<div class="col-md-8 col-xs-12">
											<input class="form-control" type="text" name="BankProcessDate" value="<?= $_POST['solicitDate'] ?>" placeholder="BankProcessDate">
										</div>
									</div>
								</div>							
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4 col-xs-12">											
											<label class="label-form">TransactionState: </label>
										</div>
										<div class="col-xs-8 col-xs-12">											
											<select class="selectpicker" name="transactionState">
												<?php foreach ($options as $opt) { ?>
													<option value="<?= $opt?>"
														<?php 
														if(isset($_POST['transactionState'])){
															if($opt == $_POST['transactionState']){ ?>
														selected
														<?php }} ?> ><?= $opt ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>																						
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-4 col-xs-12">											
											<label class="label-form">authorizationID:</label>
										</div>
										<div class="col-md-8 col-xs-12">											
											<input class="form-control" type="number" name="authorizationID" placeholder="AuthorizationID" 
											<?php if(isset($_POST['authorizationID'])){ ?>
											value="<?=$_POST['authorizationID'] ?>" 
											<?php } ?>
											>
										</div>
									</div>
								</div>															
								<hr style="width: 80%;text-align: center;">		
								<div class="row text-center btns">
									<div class="col-md-3">
										<button type="submit" class="btn btn-default">Call</button>
									</div>
									<div class="col-md-3 col-md-offset-5">
										<a class="btn btn-default" href="index.php">Return PPE</a>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php if(isset($_GET['call'])){	 ?>
					<div class="row text-center" style="margin-top: 20px">
						<div class="col-xs-12">
							<div class="alert alert-info">
							  <strong>Call Return:</strong> <?= $transaction[0]['returnCode']." - <b>Transaction State</b>: ".$information->getTransactionInformationResult->transactionState ?>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="panel-footer">
					<h1 class="panel-title">Pagos PSE</h1>
				</div>
			</div>	
		</div>
	</div>	
</div>

<?php }else{
	header("Location: index.php"); // Si la petición no viene desde el beginTransaction.php lo devuelve al index.php
} ?>