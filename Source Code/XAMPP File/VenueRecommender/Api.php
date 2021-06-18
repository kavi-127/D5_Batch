<?php 

	require_once 'DbConnect.php';
	
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			case 'signup':
				if(isTheseParametersAvailable(array('username','email','password','gender'))){
					$username = $_POST['username']; 
					$email = $_POST['email']; 
					$password = md5($_POST['password']);
					$gender = $_POST['gender']; 
					$phone = $_POST['phone'];
					$image = $_POST["proimage"];
					$decodedImage = base64_decode("$image");
					$return = file_put_contents("uploadedFiles/".$email.".JPG", $decodedImage);
					
					
					$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
					$stmt->bind_param("ss", $username, $email);
					$stmt->execute();
					$stmt->store_result();
					
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();
					}else{
						$stmt = $conn->prepare("INSERT INTO users (username, email, password, gender, phone, image) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("ssssss", $username, $email, $password, $gender, $phone, $email);

						if($stmt->execute()){
							$stmt = $conn->prepare("SELECT id, id, username, email, gender, phone FROM users WHERE username = ?"); 
							$stmt->bind_param("s",$username);
							$stmt->execute();
							$stmt->bind_result($userid, $id, $username, $email, $gender, $phone);
							$stmt->fetch();
							
							$user = array(
								'id'=>$id, 
								'username'=>$username, 
								'email'=>$email,
								'gender'=>$gender,
								'phone'=>$phone
							);
							
							$stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						}
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break; 
			
			case 'group':
				if(isTheseParametersAvailable(array('uid','gname','cname','cnumber'))){
					$uid = $_POST['uid']; 
					$gname = $_POST['gname']; 
					$cname = $_POST['cname'];
					$cnumber = $_POST['cnumber']; 
					
					
					
						$stmt = $conn->prepare("INSERT INTO cgroup (uid, gname, cname, cnumber) VALUES (?, ?, ?, ?)");
						$stmt->bind_param("ssss", $uid, $gname, $cname, $cnumber);

						if($stmt->execute()){
							
							
							$stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User Added To Group'; 
							
						}
					
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break;
			
			case 'tags':
				if(isTheseParametersAvailable(array('name','lat','lng','eventname', 'hostname', 'sdate', 'stime', 'etime', 'offer', 'category'))){
					//$json = json_decode(file_get_contents('php://input'),true);
					$image = $_POST["eventimage"];
					$decodedImage = base64_decode("$image");
                    //$return = file_put_contents("uploadedFiles/".$name.".JPG", $decodedImage);
					$name = $_POST['name']; 
					$lat = $_POST['lat']; 
					$lng = $_POST['lng'];
					$eventname = $_POST['eventname']; 
					$hostname = $_POST['hostname'];
					$sdate = $_POST['sdate'];
					$stime = $_POST['stime'];
					$etime= $_POST['etime'];
					$offer = $_POST['offer'];
					$category = $_POST['category'];
					$placetype = $_POST['placetype'];
					$fees = $_POST['fees'];
					$description = $_POST['description'];
					$environment = $_POST['environment'];
					$suitablefor = $_POST['suitablefor'];
					$session = $_POST['session'];
					
					$return = file_put_contents("uploadedFiles/".$eventname.".JPG", $decodedImage);
					
					$stmt = $conn->prepare("INSERT INTO tags (name, lat, lng, eventname, hostname, sdate, stime, etime, offer, category, placetype, fees, eventimage, description, environment, suitablefor, session) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("sssssssssssssssss", $name, $lat, $lng, $eventname, $hostname, $sdate, $stime, $etime, $offer, $category, $placetype, $fees, $eventname, $description, $environment, $suitablefor, $session);

				    if($stmt->execute()){
							
				    $stmt->close();
							$response['error'] = false; 
							$response['message'] = 'Event Added'; 
						}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break;
			
			case 'login':
				
				if(isTheseParametersAvailable(array('username', 'password'))){
					
					$username = $_POST['username'];
					$password = md5($_POST['password']); 
					
					$stmt = $conn->prepare("SELECT id, username, email, gender, phone FROM users WHERE username = ? AND password = ?");
					$stmt->bind_param("ss",$username, $password);
					
					$stmt->execute();
					
					$stmt->store_result();
					
					if($stmt->num_rows > 0){
						
						$stmt->bind_result($id, $username, $email, $gender, $phone);
						$stmt->fetch();
						
						$user = array(
							'id'=>$id, 
							'username'=>$username, 
							'email'=>$email,
							'gender'=>$gender,
							'phone'=>$phone
						);
						
						$response['error'] = false; 
						$response['message'] = 'Login successfull'; 
						$response['user'] = $user; 
					}else{
						$response['error'] = false; 
						$response['message'] = 'Invalid username or password';
					}
				}
			break; 
			
			
			
			default: 
				$response['error'] = true; 
				$response['message'] = 'Invalid Operation Called';
		}
		
	}else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	echo json_encode($response);
	
	function isTheseParametersAvailable($params){
		
		foreach($params as $param){
			if(!isset($_POST[$param])){
				return false; 
			}
		}
		return true; 
	}