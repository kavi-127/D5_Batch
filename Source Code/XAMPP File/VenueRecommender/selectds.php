<?php
require_once('DbConnect.php');
$name = $_POST['name'];	
$sql = "SELECT * FROM tags";
$r = mysqli_query($conn,$sql);
$response = array();
$result = array();
$ip = $_SERVER['SERVER_ADDR'];

while($row = mysqli_fetch_array($r)){
    array_push($result,array(
        'name'=>$row['name'],
        'lat'=>$row['lat'],
        'lng'=>$row['lng'],
        'eventname'=>$row['eventname'],
        'hostname'=>$row['hostname'],
        'sdate'=>$row['sdate'],
        'stime'=>$row['stime'],
        'etime'=>$row['etime'],
        'offer'=>$row['offer'],
        'category'=>$row['category'],
        'placetype'=>$row['placetype'],
        'fees'=>$row['fees'],
        'description'=>$row['description'],
        'eventimage'=>'http://'.$ip.'/VenueRecommender/uploadedFiles/'.$row['eventimage'].'.jpg',
        'suitablefor'=>$row['suitablefor'],
        'session'=>$row['session']
		
    ));
}
$response['error'] = false; 
$response['message'] = 'User registered successfully'; 
$response['user'] = $result; 
echo json_encode($response);

mysqli_close($conn);
?>