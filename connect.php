<?php
	$champName = $_POST['champName'];
	$healthpoints = $_POST['healthpoints'];
	$adamage = $_POST['adamage'];
	$aspeed = $_POST['aspeed'];
	$armor = $_POST['armor'];

	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbName = 'LeagueDB';
	$tableName = 'AttackComparison';
	
	// Create Connection
	$conn = new mysqli($servername,$username,$password,$dbName);
	// Check Connection
	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}

	// Put Data into Database
    $sql = "INSERT INTO $tableName (champName, healthpoints, adamage, aspeed, armor)
    		VALUES ('$champName', '$healthpoints', '$adamage', '$aspeed', '$armor')";

	
	if($conn->query($sql) === TRUE)
	{
		$last_id = $conn->insert_id;
		echo "New record created successfully. Last inserted ID is: " . $last_id."<br>";
	}else
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>