<?php

    $latitude = $_POST['latitude'];	
	$longitude =$_POST['longitude'];
	
	//$latitude = '8.4462224 8.44622240 8.44622 8.4462';
	//$longitude = '77.694089 77.69408 77.69408 77.6940';
	$firebase = new Firebase();
    $data = array();
	
	$lat = array();
	$lng = array();
	$data = array();
	
	$lat = explode(" ",$latitude);
	$lng= explode(" ",$longitude);
	
	
	for ($x = 0; $x<= sizeof($lat)-1; $x++) {
		array_push($data,array((double)$lat[$x],(double)$lng[$x]));

} 

	


//array_push($data,array(8.4462224,77.694089));
//array_push($data,array(8.44622240,77.69408));

//array_push($data,array(8.44622,77.69408));
//array_push($data,array(8.4462,77.6940));
$test = $firebase->GetCenterFromDegrees($data);
$response = array();
$response['error'] = false; 
$response['message'] = 'User registered successfully';
$response['user'] = array('latlng'=>$test);
echo json_encode($response);


class Firebase {
function GetCenterFromDegrees($data)
{
    if (!is_array($data)) return FALSE;

    $num_coords = count($data);

    $X = 0.0;
    $Y = 0.0;
    $Z = 0.0;

    foreach ($data as $coord)
    {
        $lat = $coord[0] * pi() / 180;
        $lon = $coord[1] * pi() / 180;

        $a = cos($lat) * cos($lon);
        $b = cos($lat) * sin($lon);
        $c = sin($lat);

        $X += $a;
        $Y += $b;
        $Z += $c;
    }

    $X /= $num_coords;
    $Y /= $num_coords;
    $Z /= $num_coords;

    $lon = atan2($Y, $X);
    $hyp = sqrt($X * $X + $Y * $Y);
    $lat = atan2($Z, $hyp);
	$la = $lat * 180 / pi();
	$lo =$lon * 180 / pi();

    return $la.",".$lo;
}
 }

// 8.446222401908377,77.69408998705714
 //8.446222401908377,77.69408998705714
// 8.446222401908377,77.69408998705714
// 8.446222401908377,77.69408998705714



?>