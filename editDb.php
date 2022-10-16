<?php
    require_once "database.php";
 
    $name = $_POST['name'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
 
 
    $sql = "INSERT INTO `coordinates`( `name`, `latitude`, `longitude`) 
	VALUES ('$name','$latitude','$longitude')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
 
?>