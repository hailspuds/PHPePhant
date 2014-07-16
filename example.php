<?	
	require 'PHPePhant.php';

	//SET KEYS
	$stream_public_key = "aGGmOjK7aqTRoox47Yjq";
	$stream_private_key = "KEE2ory1ZdurvvZxNDk1";

	$phant = new PHPePhant;
	$phant->setPublicKey($stream_public_key);
	$phant->setPrivateKey($stream_private_key);

	$phant_data = array(
	    'temp' => '23.2',
	    'humidity' => '34.5',
	);

	print_r($phant->log_input($phant_data));
	
	//To clear the stream, all you'll need is this:
	//(It's commented at the moment, because it'll clear what you've just added - and it'll look like the system doesn't work)
	
	//$phant->clear_stream();
	
?>