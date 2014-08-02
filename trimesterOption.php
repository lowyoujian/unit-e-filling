<?php
$q = $_GET['q'];

$mysqli = new mysqli('localhost', 'root', '', 'team_project');
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
