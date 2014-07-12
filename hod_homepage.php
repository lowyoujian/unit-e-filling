<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

	$stmt=$mysqli->prepare("SELECT unitCode,unitName FROM unitfile WHERE hod =?");
	$stmt->bind_param('s',
		$_SESSION['lecturerid']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$unitname);
	?>
	<form action="result1.php" method="get">
	    <p> Please select the unit that you want to select. </p>
		Unit 
		<select name="unitcodeslist;"select onmouseover="this.size=10;"onmouseout="this.size=5;">
		
<?php 

	while($stmt->fetch()){	
	?> 		
			
		<?php
		 echo "<option value='$unitcode|$unitname'>$unitcode $unitname</option>";	 
		?>
	
<?php		
	}	

?>

	</select>
	<input type="submit" value="Select" onclick="result1.php"/>
	</form>
