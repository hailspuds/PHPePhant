PHPePhant
=========

A simple PHP class that connects to [SparkFun's Phant data storage service](https://data.sparkfun.com).

It's far from finished, but at the moment it will allow your to:

* POST data to the service.

What it won't yet do:

* Everything else - including proper response codes, etc. It's in a very, very early stage. Feel free to add to it :)


### Example

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

If the data has POSTed successfully, it should return:

~~~
1 success
~~~

To send your own data, you'll have to change the settings in the ```$phant_data``` array. It will need to match the fields you've *already* set up before using this class.

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


### Settings

Currently, you can change the server address from the ```https://data.sparkfun.com``` default.

Assuming the above example, just change the address in this line:

~~~
$phant->setServerHostname("https://data.sparkfun.com"); 
~~~

### Why PHPePhant?

It's called PHPePhant because the PHP replaced the "ele" in "elephant" - the name the SparkFun people used to name the the service "Phant". Yes, not very funny, but there you go!


### TODO

* Response/return codes/info
   * Success 
   * Rate limits
       * X-Rate-Limit-Limit
       * X-Rate-Limit-Remaining
       * X-Rate-Limit-Reset
* Design a better way to add the fields to POSTing
* Add "[clear](http://phant.io/docs/management/clear/)" functions
* Add "[delete](http://phant.io/docs/management/delete/)" functions
* Add an [Output](http://phant.io/docs/output/http/) function (JSON, XML & PHP array)
* Add a [Stats](http://phant.io/docs/output/stats/) function (JSON, XML & PHP array)
   


#### Thanks

This class uses the wonderful [php-curl-class](https://github.com/php-curl-class/php-curl-class) for CURL.


#### Licence

The MIT License (MIT). See included licence file for further information.
