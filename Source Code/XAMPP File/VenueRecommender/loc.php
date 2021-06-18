<?php
require_once 'DbConnect.php';


$phone = $_POST['phone'];	
$firebase = new Firebase();
$data = array();

$sql = "SELECT lat, lon FROM latlon WHERE phone = '$phone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
        array_push($data,array((double)$row['lat'],(double)$row['lon']));
    }
} else {
    echo "0 results";
}

$latlon = array();

$test = $firebase->GetCenterFromDegrees($data);
$latlon = explode(",",$test);

//$stmt = $conn->prepare("DELETE FROM latlon WHERE phone = '$phone'");
//$stmt->execute();
//$conn->close();

$stmt = $conn->prepare("INSERT INTO centerpoint (phone, lat, lon) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $phone, $latlon['0'], $latlon['1']);
$stmt->execute();
$conn->close();

$response = array();
$user = array();

$user = array(
'lat'=>$latlon['0'],
'lng'=>$latlon['1']);

$response['error'] = false; 
$response['message'] = 'Lat Lng centerpoint';
$response['user'] = $user;


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




?>