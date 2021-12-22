<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	//$dbName = 'LeagueDB';
	//$tableName = 'AttackComparison';

	$dbName = $_POST['dbName'];
	//$tableName = $_POST['tableName'];
	
	// Create Connection
	$conn = new mysqli($servername,$username,$password);

	// Check Connection
	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE $dbName";
	if ($conn->query($sql) === TRUE) {
	  echo "Database created successfully";
	} else {
	  echo "Error creating database: " . $conn->error;
	}	
	$conn->close();
	
?>