<?php
require_once('DbConnect.php');

$placetype = $_POST['placetype']; 
$category = $_POST['category']; 
$environment = $_POST['environment'];
$session = $_POST['session'];
$suitablefor = $_POST['suitablefor'];


$query=mysqli_query($conn, "SELECT * FROM tags WHERE placetype = '$placetype' AND (category = '$category' OR environment = '$environment' OR session = '$session' OR suitablefor = '$suitablefor')");  //fetch all data from Location table
 
while($row=mysqli_fetch_array($query))
{
	$flag[]=$row;
}
echo json_encode(array('FL' => $flag));  //json output

mysqli_close($conn);
?>