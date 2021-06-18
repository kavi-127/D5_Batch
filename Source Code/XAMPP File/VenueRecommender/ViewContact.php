<?php 
require_once('DbConnect.php');

	
	$uid = $_GET['uid'];	
	$gname =$_GET['name'];	
	
	

		
		$sql = "SELECT * from cgroup where uid = $uid AND gname = '$gname'";

		$result = mysqli_query($conn,$sql); 
		//printf("Error: %s\n", mysqli_error($conn));
	
		$res = array(); 

		while($row = mysqli_fetch_array($result)){
			array_push($res, array(
				"cname"=>$row['cname'],
				"cnumber"=>$row['cnumber']
				));
		}

		echo json_encode($res);
	?>