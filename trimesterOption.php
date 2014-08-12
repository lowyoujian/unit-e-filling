<?php
$q = $_GET['q'];
include('database_config.php');
session_start();
$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
					
					
	$stmt=$mysqli->prepare("SELECT trimester FROM mod_and_unit WHERE user_id=?");
	$stmt->bind_param('s',
		$_SESSION['user_id']);
	$stmt->execute();
	$stmt->bind_result($trimester);
?>
<form method="get">
	    <p> Please select the trimester of the unit that you wish to verify files. </p> 
		Trimester :
		<select name="trimesterlist">
		
<?php 
	
	echo "<option value=''> </option>";	
	while($stmt->fetch()){
		echo "<option value='$trimester'>$trimester</option>";
	}
?>
</select>
	<br/>
</form>