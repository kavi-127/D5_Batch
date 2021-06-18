<?php

$dist = GetDrivingDistance(13.0373,13.0694,80.2123,80.1948);

echo 'Distance: <b>'.$dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';


function GetDrivingDistance($lat1, $lat2, $long1, $long2)

{
	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?&origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&key=AIzaSyCeUrl7gFCnSwD5BXd0dcyFSRGCWjtmYEM";
    //$url = "https://maps.googleapis.com/maps/api/distancematrix/json?&origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL&Key=AIzaSyCeUrl7gFCnSwD5BXd0dcyFSRGCWjtmYEM";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

    return array('distance' => $dist, 'time' => $time);
}

?>