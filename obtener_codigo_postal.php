<?php 

$direccion_org = "av diagonal 245 Barcelona catalunya";
$direccion_org = urlencode($direccion_org);
$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$direccion_org}&key=AIzaSyCEUxuelm-ruuX7STQP7iDdk-KpoRedKCY"; 
$resp_json = file_get_contents($url);     
$resp = json_decode($resp_json, true); 
if($resp['status'] == 'OK') { 
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
