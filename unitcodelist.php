<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

	$stmt=$mysqli->prepare("SELECT unitcode,unitdesc FROM lecturer WHERE lecturerID =?");
	$stmt->bind_param('s',
		$_SESSION['lecturerid']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$unitname);
	?>
	<form action="home.php" method="get">
	    <p> Please select the unit that you wish to upload files. </p>
		Unit 
		<select name="unitcodeslist">
		
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
	<input type="submit" value="Next" onclick="home.php"/>
	</form>

