<?php
require_once 'DbConnect.php';

$response =array();

$latitude = $_POST['latitude']; 
$longitude = $_POST['longitude'];
$rphone = $_POST['rphone'];
$uphone = $_POST['uphone'];
$area = $_POST['area'];

$stmt = $conn->prepare("SELECT id FROM latlon WHERE phone = ?");
					$stmt->bind_param("s", $rphone);
					$stmt->execute();
					$stmt->store_result();
					
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'lat lon registered';
						$stmt->close();
						echo json_encode($response);
					}
					else{
						$stmt = $conn->prepare("INSERT INTO latlon (lat, lon, phone, uphone, area) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssss", $latitude, $longitude, $rphone, $uphone, $area);
if($stmt->execute()){
	$stmt->close();
	$response['error'] = false; 
	$response['message'] = 'latlon sent'; 
	echo json_encode($response);
	
}
else{
	$response['error'] = true; 
	$response['message'] = 'failed to send'; 
	echo json_encode($response);
}
					}


    //$latitude = '10.05456 10.0979 20.9679';
	//$longitude = '8.567 80.9867 81.7584';
	
	
	
?>