<?php
require_once('DbConnect.php');

$response = array();

$phone = $_POST['phone'];

$stmt = $conn->prepare("SELECT * FROM latlon WHERE phone = ?");
$stmt->bind_param("s",$phone);
$stmt->execute();
$stmt->store_result();
$user = array(
'count'=>$stmt->num_rows);

$response['error'] = false;
$response['message'] = 'Count';
$response['user'] = $user;
$stmt->close();
echo json_encode($response);

	
?>