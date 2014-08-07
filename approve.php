<?php
$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
		
$t = $_POST['t'];
$result_explode = explode('/', $t);
$path=$result_explode[0]; 
$unitcode=$result_explode[1]; 
$filename=$result_explode[2]; 


// Insert the data
$query2="UPDATE `unitFile`
SET `fileStatus`=1
WHERE `fileName`='$filename'";
$results2 = mysqli_query($mysqli, $query2);

echo "$t";

?>