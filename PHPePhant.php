<?

require 'Curl.php';
use \Curl\Curl;

class PHPePhant
{
	private $public_key = '';
	private $private_key = '';
	private $server_hostname = 'https://data.sparkfun.com';
	
	function setPublicKey($value)
	{
		$this->public_key = $value;
	}
	
	function setPrivateKey($value)
	{
		$this->private_key = $value;
	}
	
	function setServerHostname($value)
	{
		$this->server_hostname = $value;
	}
	
	public function http_request($data_fields)
	{
		$curl = new Curl();
		$curl->setHeader('Phant-Private-Key', $this->private_key);
		$curl->post($this->server_hostname . '/input/' . $this->public_key, $data_fields);

		if ($curl->error) 
		{
		    print 'Error: ' . $curl->error_code . ': ' . $curl->error_message;
		}
		else 
		{
		    print $curl->response;
				//var_dump($curl->request_headers);
				//var_dump($curl->response_headers);
		}	
	}
	
	public function log_input($data)
	{
		$this->http_request($data);
	}
	
}
	
	
	
	
	
?>