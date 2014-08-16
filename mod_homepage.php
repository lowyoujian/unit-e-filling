<?php
session_start();
include('database_config.php');	
?>

	<form method="get" action="linkfile.php">
	    <p> Please provide the unit information that you wish to verify files. </p>
		<table style="width:800px" border="1">
		<tr>
		<th>Department</th>
		<th>Programme</th>
		<th>Unit</th>
		</tr>
		<tr><td><select name='department'>";
<?php 

	
	//Obtain Department table information
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

					
	$stmt2=$mysqli->prepare("SELECT * FROM department");
	$stmt2->execute();
	$stmt2->bind_result($department_id,$department_name);
		while($stmt2->fetch()){	
	
		echo "<option value='$department_name'>$department_name</option>";
		
	}	
?>
	</select></td><td><select name='programme'>
<?php
	//Obtain Programme table information
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

			
	$stmt3=$mysqli->prepare("SELECT * FROM programme");
	$stmt3->execute();
	$stmt3->bind_result($programme_id,$programme_name,$short_code);
		while($stmt3->fetch()){	
		
		echo "<option value='$programme_name'>".$programme_name."</option>";
		
	}	
?>
	</select></td><td><select name='unit'>
<?php

	//Obtain Unit table information	
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

	$stmt=$mysqli->prepare("SELECT unit_code,unit_name FROM mod_and_unit WHERE user_id=?");
	$stmt->bind_param('s',
		$_SESSION['user_id']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$unitname);	
	while($stmt->fetch()){	
		 
		 echo "<option value='$unitcode'>".$unitcode." ".$unitname."</option>"; 
		 
	}	

?>


	</select>
	</td></tr>
	</table>
	<input type="submit" value="Next" onclick="linkfile.php"/>
	</form>
	
