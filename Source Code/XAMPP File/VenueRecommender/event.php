<?php 
require_once('DbConnect.php');

	
	$name = $_POST['name'];	
	$ip = $_SERVER['SERVER_ADDR'];
	$response = array();
		
		
		$sql = "SELECT * from tags where name = '$name'";

		$result = mysqli_query($conn,$sql); 
		$res = array(); 

		while($row = mysqli_fetch_array($result)){
			array_push($res, array(
				"name"=>$row['name'],
				"eventname"=>$row['eventname'],
				"hostname"=>$row['hostname'],
				"sdate"=>$row['sdate'],
				"stime"=>$row['stime'],
				"etime"=>$row['etime'],
				"category"=>$row['category'],
				"environment"=>$row['environment'],
				"suitablefor"=>$row['suitablefor'],
				"eventimage"=>'http://'.$ip.'/VenueRecommender/uploadedFiles/'.$row['eventimage'].'.jpg',
				"session"=>$row['session']
				));
		}
			            $response['error'] = false; 
						$response['message'] = 'Login successfull'; 
						$response['user'] = $res; 

		echo json_encode($response);
	?>