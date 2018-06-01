<?php 
// function to geocode address, it will return false if unable to geocode address
//https://maps.googleapis.com/maps/api/geocode/json?address=toma%20morales%2099%20las%20palmas&key=AIzaSyCEUxuelm-ruuX7STQP7iDdk-KpoRedKCY
//http://maps.google.com/maps?q=24.197611,120.780512

$address = "tomas morales 99 las palmas";
// url encode the address
$address = urlencode($address);
// google map geocode api url
$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCEUxuelm-ruuX7STQP7iDdk-KpoRedKCY"; 
// get the json response
$resp_json = file_get_contents($url);     
// decode the json
$resp = json_decode($resp_json, true); 
// response status will be 'OK', if able to geocode given address 
if($resp['status'] == 'OK') { 
	// get the important data
	echo "OK <br>";	
	$direccion = $resp['results'][0]['address_components'];
	$max = sizeof($direccion);
	for($i = 0; $i < $max;	$i++) {
		echo $direccion[$i]['types'][0];	
		echo "<br>";	
		if ($direccion[$i]['types'][0] == 'postal_code') {
			echo "||| ";	
			echo $direccion[$i]['long_name'];
			echo " |||";	
		}
	}
}	
		
?>
