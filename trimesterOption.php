<?php
$q = $_GET['q'];
$result_explode = explode(' ', $q);
$unitcodehod=$result_explode[0];
$unitnameho=$result_explode[1];

$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
					
					
	$stmt=$mysqli->prepare("SELECT trimester FROM lecturer WHERE hodunitcode ='".$unitcodehod."'");
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
