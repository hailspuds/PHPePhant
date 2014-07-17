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
	    return array(
				'response' => trim($curl->response), 
				'http_status' => $curl->response_headers['Status-Line'],
				'X-Rate-Limit-Limit' => $curl->response_headers['X-Rate-Limit-Limit'], 
				'X-Rate-Limit-Remaining' => $curl->response_headers['X-Rate-Limit-Remaining'],
				'X-Rate-Limit-Reset' => $curl->response_headers['X-Rate-Limit-Reset'],
			);
		}
		else 
		{
	    return array(
				'response' => trim($curl->response), 
				'http_status' => $curl->response_headers['Status-Line'],
				'X-Rate-Limit-Limit' => $curl->response_headers['X-Rate-Limit-Limit'], 
				'X-Rate-Limit-Remaining' => $curl->response_headers['X-Rate-Limit-Remaining'],
				'X-Rate-Limit-Reset' => $curl->response_headers['X-Rate-Limit-Reset'],
			);
		}	
	}
	
	public function clear_stream()
	{
		$curl = new Curl();
		$curl->setHeader('Phant-Private-Key', $this->private_key);
		$curl->delete($this->server_hostname . '/input/' . $this->public_key);
		if ($curl->error) 
		{
	    return array(
				'response' => trim($curl->response), 
				'http_status' => $curl->response_headers['Status-Line']
			);
		}
		else
		{
	    return array(
				'response' => trim($curl->response), 
				'http_status' => $curl->response_headers['Status-Line']
			);
		}
	}
	
	public function log_input($data)
	{
		$result = $this->http_request($data);
		return $result;
	}
	
	public function delete_stream($delete_key)
	{
		$curl = new Curl();
		$curl->setHeader('Phant-Delete-Key', $delete_key);
		$curl->delete($this->server_hostname . '/streams/' . $this->public_key);
		
		if ($curl->error) 
		{
	    return array(
				'http_status' => $curl->response_headers['Status-Line']
			);
		}
		else
		{
	    return array(
				'http_status' => $curl->response_headers['Status-Line']
			);
		}
		
	}
	
}
	
	
	
	
	
?>