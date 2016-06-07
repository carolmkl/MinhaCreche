<?php 
require_once 'conexaodb.php'; // The mysql database connection script
$sql="select * from creche";
$result = $conn->query($sql) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	$arr[] = $result->fetch_assoc();
}

# JSON-encode the response
mysqli_close($conn);
echo $json_response = json_encode($arr);
?>