<?php 
require_once('DbConnect.php');

	
	$uid = $_GET['uid'];	
	

		
		$sql = "SELECT DISTINCT gname from cgroup where uid = '$uid'";

		$result = mysqli_query($conn,$sql); 
	
		$res = array(); 

		while($row = mysqli_fetch_array($result)){
			array_push($res, array(
				"gname"=>$row['gname'],
				));
		}

		echo json_encode($res);
	?>