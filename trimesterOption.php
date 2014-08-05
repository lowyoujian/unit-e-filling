<?php
$q = $_GET['q'];
include('database_config.php');

$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
					
					
	$stmt=$mysqli->prepare("SELECT trimester FROM hod WHERE unitcode ='".$q."'");
	$stmt->execute();
	$stmt->bind_result($trimester);
?>
<form>
	    <p> Please select the trimester that you wish to select files. </p>
		Unit 
		<select name="trimesterlist">
		
<?php 
	
	while($stmt->fetch()){	
	?> 		
		<?php		
		 echo "<option value='$trimester'>$trimester</option>";	 
		?>	
<?php		
	}	

?>
