<?php
	$champName1 = $_POST['champName1'];
	$champName2 = $_POST['champName2'];
	$fightlength = $_POST['fightlength'];
/*
	$champName1 = 'Vayne';
	$champName2 = 'Caitlyn';
	$fightlength = 3;
*/
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

	$sql = "SELECT id, champName, healthpoints, adamage, aspeed, armor  FROM $tableName 
			WHERE champName='$champName1' OR champName='$champName2'";
	$result = $conn->query($sql);

	if ($result->num_rows > 1) {
		// output data of each row
		echo "Fighting for " . $fightlength . " Seconds results in: <br>";

		$rowChamp1 = $result->fetch_assoc();
		$rowChamp2 = $result->fetch_assoc();

		$Champ1DamageOutput = round(($fightlength / $rowChamp1["aspeed"]) * $rowChamp1["adamage"], 1);
		$Champ1EffectiveHealth = round($rowChamp1["healthpoints"] * ((100 + $rowChamp1["armor"]) / 100),1);
		echo  "<strong>" . $rowChamp1["champName"] . "</strong> deals <strong>"  . $Champ1DamageOutput . " Damage</strong> in " . $fightlength .
			 " seconds and has<strong> " . $Champ1EffectiveHealth . " effective Health </strong><br>";
		
		$Champ2DamageOutput = round(($fightlength / $rowChamp2["aspeed"]) * $rowChamp2["adamage"], 1);
		$Champ2EffectiveHealth = round($rowChamp2["healthpoints"] * ((100 + $rowChamp2["armor"]) / 100),1);
		echo "<strong>".$rowChamp2["champName"] . "</strong> deals <strong>"  . $Champ2DamageOutput . " Damage </strong>in " . $fightlength .
			 " seconds and has <strong>" . $Champ2EffectiveHealth . " effective Health</strong> <br>";

		$KillChamp1 = $Champ2DamageOutput - $Champ1EffectiveHealth;
		$KillChamp2 = $Champ1DamageOutput - $Champ2EffectiveHealth;

		if( ($KillChamp1 > 0) and ($KillChamp2 < 0))
		{
			echo  $rowChamp1["champName"] . " has been killed by "  . $rowChamp2["champName"] . ".";
		}
		if( ($KillChamp1 < 0) and ($KillChamp2 > 0))
		{
			echo  $rowChamp2["champName"] . " has been killed by "  . $rowChamp1["champName"] . ".";
		}
		if( ($KillChamp1 < 0) and ($KillChamp2 < 0))
		{
			echo  "Both Champions have survived.";
		}
		if( ($KillChamp1 > 0) and ($KillChamp2 > 0))
		{
			echo  "Both Champions have been potentially killed.";
		}

	} else {
		echo "0 results";
	}

	// need to reQuery, because fetch_assoc() seems to drain?
	$result = $conn->query($sql);	
	// HTML Table Version	
	if ($result->num_rows > 0) {
		echo "<br>";
		echo "<table><tr> <th>ID</th> <th>Champion Name</th> <th>Health Points</th> <th>Attack Damage</th> 
			  <th>Attack Speed</th> <th>Armor Value</th></tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>".$row["id"]."</td> <td>".$row["champName"]."</td> <td>".$row["healthpoints"]."</td> 
				  <td>".$row["adamage"]."</td>  <td>".$row["aspeed"]."</td>  <td>".$row["armor"]."</td></tr>";
		}
		echo "</table>";
	} else {
		echo "0 results";
	}

	$conn->close();
?>