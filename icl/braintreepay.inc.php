<?

function braintreepay(){
	$nonce = $_POST["payment_method_nonce"];
	$amount = $_POST["amount"];
	$result = Braintree_Transaction::sale([
		'amount'=>''.$amount,
  		'paymentMethodNonce' => 'fake-valid-nonce'
	]);	
	echo $result->success;
}