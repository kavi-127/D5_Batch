<?php
$latitude = '10.05456 10.0979 20.9679';
	$longitude = '8.567 80.9867 81.7584';
	
	$lat = array();
	$lng = array();
	$data = array();
	
	$lat = explode(" ",$latitude);
	$lng= explode(" ",$longitude);
	
	
	for ($x = 0; $x<= sizeof($lat)-1; $x++) {
		array_push($data,array((double)$lat[$x],(double)$lng[$x]));

} 

echo  json_encode($data);
	
?>