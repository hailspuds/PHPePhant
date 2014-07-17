PHPePhant
=========

A simple PHP class that connects to [SparkFun's Phant data storage service](https://data.sparkfun.com).

It's far from finished, but at the moment it will allow your to:

* POST data to the service.
  * Supply a return message.
* Clear data
  * Supply a return message.

What it won't yet do:

* Everything else. It's in a very, very early stage. Feel free to add to it :)


### Example - sending/input data

~~~
require 'PHPePhant.php';

//SET KEYS
$stream_public_key = "PUBLIC_KEY";
$stream_private_key = "PRIVATE_KEY";

$phant = new PHPePhant;
$phant->setPublicKey($stream_public_key);
$phant->setPrivateKey($stream_private_key);

$phant_data = array(
	'temp' => '23.2',
	'humidity' => '34.5',
);

$phant->log_input($phant_data);
	
~~~

If the data has POSTed successfully, it should return a PHP array. The API's response is in ```response```, the server's response is in ```http_status``` (this will change, for example if the key is wrong, or if data is missing), then the rate limit information comes next.

The data is returned to the script where you make the call, so if you don't need it you can just ignore it.

~~~
Array
(
    [response] => 1 success
    [http_status] => HTTP/1.1 200 OK
    [X-Rate-Limit-Limit] => 100
    [X-Rate-Limit-Remaining] => 94
    [X-Rate-Limit-Reset] => 1405510985.193
)
~~~

You can see [a test stream here](https://data.sparkfun.com/streams/aGGmOjK7aqTRoox47Yjq). 

An example of a failed response (incidentally, failed responses still count against the API limit of 100 / 15 minutes)

~~~
Array
(
    [response] => 0 forbidden: invalid key
    [http_status] => HTTP/1.1 401 Unauthorized
    [X-Rate-Limit-Limit] => 
    [X-Rate-Limit-Remaining] => 
    [X-Rate-Limit-Reset] => 
)
~~~

To send your own data, you'll have to change the settings in the ```$phant_data``` array (also in example above). 

~~~
$phant_data = array(
	'temp' => '23.2',
	'humidity' => '34.5',
);
~~~

It will need to match the fields you've *already* set up before using this class.

[You can set up a stream here.](https://data.sparkfun.com/streams/make)

So, for example, if you are trying to send GPS coordinates, and you've set up your Phant stream with the fields:  

* longitude
* latitude
* altitude
* number_of_sats 

The array would look like:

~~~
$phant_data = array(
	'longitude' => $longitude_var,
	'latitude' => $latitude_var,
	'altitude' => $altitude_var,
	'number_of_sats' => $number_of_sats_var,
);
~~~

Alternatively, if you were sending sensor temperature data with the fields:

* temperature
* location

The array may look like:

~~~
$phant_data = array(
	'temperature' => $temperature_var,
	'location' => 'kitchen',
);
~~~

And so on.

### Example - clear data

This is simple - but be warned, running it will delete all the data in your stream!

Ready? Simply set it all up (if you've set it up to add/input data you don't need to worry about this):

~~~
require 'PHPePhant.php';

//SET KEYS
$stream_public_key = "PUBLIC_KEY";
$stream_private_key = "PRIVATE_KEY";

$phant = new PHPePhant;
$phant->setPublicKey($stream_public_key);
$phant->setPrivateKey($stream_private_key);
~~~

Then this!

~~~
$phant->clear_stream()
~~~

That's all!

The result will be returned via PHP array:

~~~
Array
(
    [response] => 1 success
    [http_status] => HTTP/1.1 200 OK
)
~~~

### Example - delete stream

It's very similar to the way data is cleared.

1. Include the usual (the class, the public key)
2. Then call the deletion method, but instead of setting the deletion key (like you do with the private/public), just include it in the method call:

~~~
$phant->delete_stream('DELETE_KEY')
~~~

It will return a simple array with a HTTP code:

~~~
Array
(
    [http_status] => HTTP/1.1 202 Accepted
)
~~~


### Settings

Currently, you can change the server address from the ```https://data.sparkfun.com``` default.

Assuming the above example, just change the address in this line:

~~~
$phant->setServerHostname("https://data.sparkfun.com"); 
~~~

### Why PHPePhant?

It's called PHPePhant because the PHP replaced the "ele" in "elephant" - the name the SparkFun people used to name the the service "Phant". Yes, not very funny, but there you go!


### TODO

* ~~Response/return codes/info~~
   * ~~Success~~
   * ~~Rate limits~~
       * ~~X-Rate-Limit-Limit~~
       * ~~X-Rate-Limit-Remaining~~
       * ~~X-Rate-Limit-Reset~~
* Design a better way to add the fields to POSTing
* ~~Add "[clear](http://phant.io/docs/management/clear/)" functions~~
* Add "[delete](http://phant.io/docs/management/delete/)" entire stream function
* Add an [Output](http://phant.io/docs/output/http/) function (JSON, XML & PHP array)
* Add a [Stats](http://phant.io/docs/output/stats/) function (JSON, XML & PHP array)
   


#### Thanks

This class uses the wonderful [php-curl-class](https://github.com/php-curl-class/php-curl-class) for CURL.


#### Licence

The MIT License (MIT). See included licence file for further information.
